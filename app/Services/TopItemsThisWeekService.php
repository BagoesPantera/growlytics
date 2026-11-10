<?php

namespace App\Services;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class TopItemsThisWeekService
{
    /**
     * @return array{start: Carbon, end: Carbon}
     */
    public function currentPeriod(): array
    {
        $end = Carbon::now('UTC');

        return [
            'start' => $end->copy()->startOfWeek(Carbon::MONDAY),
            'end' => $end,
        ];
    }

    /**
     * Cache key includes the UTC Monday identity of the current week.
     */
    public function cacheKey(): string
    {
        return 'top-items-this-week:'.$this->currentPeriod()['start']->format('Y-m-d');
    }

    /**
     * Effective TTL is the smaller of 60 seconds and the time left
     * until the next UTC Monday 00:00 boundary.
     */
    public function cacheTtlSeconds(): int
    {
        $weekStart = $this->currentPeriod()['start'];
        $nextMonday = $weekStart->copy()->addWeek();
        $secondsUntilBoundary = max(0, $nextMonday->getTimestamp() - Carbon::now('UTC')->getTimestamp());

        return min(60, $secondsUntilBoundary);
    }

    /**
     * @return Collection<int, array{
     *     item_id: int,
     *     name: string,
     *     slug: string|null,
     *     total: int,
     *     buy_count: int,
     *     sell_count: int
     * }>
     */
    public function topItemsThisWeek(): Collection
    {
        $period = $this->currentPeriod();
        $key = $this->cacheKey();
        $ttl = $this->cacheTtlSeconds();

        $rows = Cache::remember($key, $ttl, function () use ($period): array {
            return Listing::query()
                ->join('items', 'items.id', '=', 'listings.item_id')
                ->where('listings.posted_at', '>=', $period['start']->format('Y-m-d H:i:s.v'))
                ->where('listings.posted_at', '<=', $period['end']->format('Y-m-d H:i:s.v'))
                ->groupBy('listings.item_id', 'items.name', 'items.slug')
                ->selectRaw(
                    'listings.item_id as item_id, items.name as name, items.slug as slug, COUNT(*) as total, '.
                    'SUM(CASE WHEN listings.side = ? THEN 1 ELSE 0 END) as buy_count, '.
                    'SUM(CASE WHEN listings.side = ? THEN 1 ELSE 0 END) as sell_count',
                    ['buy', 'sell']
                )
                ->orderByDesc('total')
                ->orderBy('listings.item_id')
                ->limit(10)
                ->get()
                ->map(fn (object $row): array => [
                    'item_id' => (int) $row->item_id,
                    'name' => (string) $row->name,
                    'slug' => $row->slug !== null ? (string) $row->slug : null,
                    'total' => (int) $row->total,
                    'buy_count' => (int) $row->buy_count,
                    'sell_count' => (int) $row->sell_count,
                ])
                ->all();
        });

        return collect($rows);
    }
}
