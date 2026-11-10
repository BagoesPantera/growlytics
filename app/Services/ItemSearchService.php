<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ItemSearchService
{
    public function search(string $query, int $limit = 8): Collection
    {
        $term = $this->normalize($query);

        if (mb_strlen($term) < 2) {
            return collect();
        }

        $limit = max(1, min(8, $limit));
        $key = 'item-search:'.md5($term.'|'.$limit);

        $rows = Cache::remember($key, 120, function () use ($term, $limit): array {
            $items = Item::query()
                ->where('normalized_name', 'like', '%'.$term.'%')
                ->orderByRaw('case when normalized_name like ? then 0 else 1 end', [$term.'%'])
                ->orderBy('normalized_name')
                ->limit($limit)
                ->get(['id', 'name', 'slug']);

            return $items->map(fn (Item $item): array => [
                'id' => $item->id,
                'name' => $item->name,
                'url' => route('items.show', $item->slug ?: $item->id),
            ])->all();
        });

        return collect($rows);
    }

    private function normalize(string $value): string
    {
        $value = trim($value);
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return Str::lower($value);
    }
}
