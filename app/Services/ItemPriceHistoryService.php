<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ItemPriceHistoryService
{
    private const MAX_ROWS = 100000;

    private const SCATTER_LIMIT = 1000;

    private const TTL = [
        '24H' => 120,
        '7D' => 300,
        '30D' => 600,
        '90D' => 900,
        '1Y' => 900,
    ];

    public function history(Item $item, string $range): array
    {
        $range = strtoupper($range);

        if (! array_key_exists($range, self::TTL)) {
            $range = '24H';
        }

        $key = 'item-price-history:'.$item->id.':'.$range.':v1';

        return Cache::remember($key, self::TTL[$range], function () use ($item, $range): array {
            return $this->compute($item, $range);
        });
    }

    private function compute(Item $item, string $range): array
    {
        $end = Carbon::now('UTC');
        [$start, $bucketSeconds] = $this->rangeWindow($range, $end);

        $count = Listing::query()
            ->where('item_id', $item->id)
            ->where('posted_at', '>=', $start->format('Y-m-d H:i:s.v'))
            ->where('posted_at', '<=', $end->format('Y-m-d H:i:s.v'))
            ->count();

        if ($count > self::MAX_ROWS) {
            return [
                'status' => 'unavailable',
                'message' => 'Price history is unavailable because this item has too many listings for exact calculation.',
                'item' => ['id' => $item->id, 'name' => $item->name],
                'range' => $range,
                'generated_at' => $end->toIso8601String(),
                'period' => [
                    'start' => $start->toIso8601String(),
                    'end' => $end->toIso8601String(),
                ],
            ];
        }

        $rows = Listing::query()
            ->where('item_id', $item->id)
            ->where('posted_at', '>=', $start->format('Y-m-d H:i:s.v'))
            ->where('posted_at', '<=', $end->format('Y-m-d H:i:s.v'))
            ->orderBy('posted_at')
            ->get(['side', 'price_wl', 'posted_at']);

        $buckets = $this->initializeBuckets($start, $end, $bucketSeconds);

        $scatterBuy = [];
        $scatterSell = [];
        $allBuyPrices = [];
        $allSellPrices = [];

        foreach ($rows as $row) {
            $postedAt = Carbon::parse($row->posted_at, 'UTC');
            $bucketKey = $this->bucketStart($postedAt, $bucketSeconds)->getTimestamp();

            if (! isset($buckets[$bucketKey])) {
                continue;
            }

            $price = (float) $row->price_wl;
            $side = $row->side === 'buy' ? 'buy' : 'sell';

            $buckets[$bucketKey][$side]['count']++;
            $buckets[$bucketKey][$side.'_prices'][] = $price;
            $buckets[$bucketKey][$side.'_points'][] = [
                (int) $postedAt->getTimestampMs(),
                $price,
            ];

            if ($side === 'buy') {
                $scatterBuy[] = [(int) $postedAt->getTimestampMs(), $price];
                $allBuyPrices[] = $price;
            } else {
                $scatterSell[] = [(int) $postedAt->getTimestampMs(), $price];
                $allSellPrices[] = $price;
            }
        }

        $bucketList = [];

        foreach ($buckets as $bucket) {
            foreach (['buy', 'sell'] as $side) {
                $prices = $bucket[$side.'_prices'];
                sort($prices);

                $bucket[$side]['median'] = $this->median($prices);
                $bucket[$side]['p25'] = $this->percentile($prices, 0.25);
                $bucket[$side]['p75'] = $this->percentile($prices, 0.75);
                $bucket[$side]['min'] = $prices === [] ? null : min($prices);
                $bucket[$side]['max'] = $prices === [] ? null : max($prices);

                unset($bucket[$side.'_prices'], $bucket[$side.'_points']);
            }

            unset($bucket['buy_prices'], $bucket['sell_prices'], $bucket['buy_points'], $bucket['sell_points']);

            $bucketList[] = $bucket;
        }

        sort($allBuyPrices);
        sort($allSellPrices);

        return [
            'status' => 'ok',
            'item' => ['id' => $item->id, 'name' => $item->name],
            'range' => $range,
            'generated_at' => $end->toIso8601String(),
            'period' => [
                'start' => $start->toIso8601String(),
                'end' => $end->toIso8601String(),
            ],
            'bucket_seconds' => $bucketSeconds,
            'summary' => [
                'buy' => [
                    'count' => count($allBuyPrices),
                    'median' => $this->median($allBuyPrices),
                    'p25' => $this->percentile($allBuyPrices, 0.25),
                    'p75' => $this->percentile($allBuyPrices, 0.75),
                    'min' => $allBuyPrices === [] ? null : min($allBuyPrices),
                    'max' => $allBuyPrices === [] ? null : max($allBuyPrices),
                ],
                'sell' => [
                    'count' => count($allSellPrices),
                    'median' => $this->median($allSellPrices),
                    'p25' => $this->percentile($allSellPrices, 0.25),
                    'p75' => $this->percentile($allSellPrices, 0.75),
                    'min' => $allSellPrices === [] ? null : min($allSellPrices),
                    'max' => $allSellPrices === [] ? null : max($allSellPrices),
                ],
            ],
            'buckets' => $bucketList,
            'scatter' => [
                'buy' => $this->sample($scatterBuy),
                'sell' => $this->sample($scatterSell),
            ],
        ];
    }

    private function rangeWindow(string $range, Carbon $end): array
    {
        return match ($range) {
            '24H' => [$end->copy()->subHours(24), 3600],
            '7D' => [$end->copy()->subDays(7), 21600],
            '30D' => [$end->copy()->subDays(30), 86400],
            '90D' => [$end->copy()->subDays(90), 86400],
            '1Y' => [$end->copy()->subYear(), 604800],
            default => [$end->copy()->subHours(24), 3600],
        };
    }

    private function initializeBuckets(Carbon $start, Carbon $end, int $bucketSeconds): array
    {
        $buckets = [];
        $cursor = $this->bucketStart($start, $bucketSeconds);

        while ($cursor <= $end) {
            $next = $cursor->copy()->addSeconds($bucketSeconds);
            $buckets[$cursor->getTimestamp()] = [
                'bucket_start' => $cursor->toIso8601String(),
                'bucket_end' => ($next > $end ? $end : $next)->toIso8601String(),
                'buy' => ['count' => 0, 'median' => null, 'p25' => null, 'p75' => null, 'min' => null, 'max' => null],
                'sell' => ['count' => 0, 'median' => null, 'p25' => null, 'p75' => null, 'min' => null, 'max' => null],
                'buy_prices' => [],
                'sell_prices' => [],
                'buy_points' => [],
                'sell_points' => [],
            ];

            $cursor = $next;
        }

        return $buckets;
    }

    private function bucketStart(Carbon $date, int $bucketSeconds): Carbon
    {
        if ($bucketSeconds >= 604800) {
            return $date->copy()->startOfWeek(Carbon::MONDAY)->startOfDay();
        }

        $timestamp = intdiv($date->getTimestamp(), $bucketSeconds) * $bucketSeconds;

        return Carbon::createFromTimestamp($timestamp, 'UTC');
    }

    private function median(array $sorted): ?float
    {
        $n = count($sorted);

        if ($n === 0) {
            return null;
        }

        if ($n % 2 === 1) {
            return (float) $sorted[(int) ($n / 2)];
        }

        $left = $sorted[($n / 2) - 1];
        $right = $sorted[$n / 2];

        return (float) (($left + $right) / 2);
    }

    private function percentile(array $sorted, float $p): ?float
    {
        $n = count($sorted);

        if ($n === 0) {
            return null;
        }

        if ($n === 1) {
            return (float) $sorted[0];
        }

        $position = ($n - 1) * $p;
        $lower = (int) floor($position);
        $upper = (int) ceil($position);

        if ($lower === $upper) {
            return (float) $sorted[$lower];
        }

        $weight = $position - $lower;

        return (float) ($sorted[$lower] + ($sorted[$upper] - $sorted[$lower]) * $weight);
    }

    private function sample(array $points): array
    {
        $count = count($points);

        if ($count <= self::SCATTER_LIMIT) {
            return $points;
        }

        $stride = (int) ceil($count / self::SCATTER_LIMIT);
        $sampled = [];

        for ($i = 0; $i < $count; $i += $stride) {
            $sampled[] = $points[$i];
        }

        if ($sampled === [] || $sampled[array_key_last($sampled)] !== $points[array_key_last($points)]) {
            $sampled[] = $points[array_key_last($points)];
        }

        return array_slice($sampled, 0, self::SCATTER_LIMIT);
    }
}
