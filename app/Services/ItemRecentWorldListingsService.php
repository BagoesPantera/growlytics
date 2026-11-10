<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ItemRecentWorldListingsService
{
    public function recent(Item $item, int $page = 1): array
    {
        $page = max(1, $page);
        $key = 'item-recent-worlds:'.$item->id.':page:'.$page.':v1';

        $cached = Cache::remember($key, 60, function () use ($item, $page): array {
            $end = Carbon::now('UTC');
            $start = $end->copy()->subDay();

            $paginator = Listing::query()
                ->where('item_id', $item->id)
                ->where('side', 'sell')
                ->whereNotNull('world')
                ->where('world', '!=', '')
                ->where('posted_at', '>=', $start->format('Y-m-d H:i:s.v'))
                ->where('posted_at', '<=', $end->format('Y-m-d H:i:s.v'))
                ->orderByDesc('posted_at')
                ->orderByDesc('id')
                ->paginate(20, ['*'], 'page', $page);

            $data = $paginator->getCollection()->map(function (Listing $listing): array {
                return [
                    'id' => $listing->id,
                    'world' => $listing->world,
                    'price_wl' => (float) $listing->price_wl,
                    'posted_at' => Carbon::parse($listing->posted_at, 'UTC')->toIso8601String(),
                    'world_verified' => (bool) $listing->world_verified,
                    'url' => $this->safeUrl($listing->url),
                ];
            })->all();

            return [
                'data' => $data,
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'has_more' => $paginator->hasMorePages(),
                'period' => [
                    'start' => $start->toIso8601String(),
                    'end' => $end->toIso8601String(),
                ],
            ];
        });

        $cached['server_now'] = Carbon::now('UTC')->toIso8601String();

        return $cached;
    }

    private function safeUrl(?string $url): ?string
    {
        if ($url === null || trim($url) === '') {
            return null;
        }

        $url = trim($url);

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);

        if (! in_array($scheme, ['http', 'https'], true)) {
            return null;
        }

        return $url;
    }
}
