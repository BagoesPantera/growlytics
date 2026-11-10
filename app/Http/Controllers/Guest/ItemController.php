<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\ItemPriceHistoryService;
use App\Services\ItemRecentWorldListingsService;
use App\Services\ItemSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(
        private ItemSearchService $search,
        private ItemPriceHistoryService $priceHistory,
        private ItemRecentWorldListingsService $recentWorlds,
    ) {}

    public function show(Item $item)
    {
        return view('guest.items.show', [
            'item' => $item,
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:8'],
        ]);

        $query = trim((string) ($validated['q'] ?? ''));
        $limit = (int) ($validated['limit'] ?? 8);

        return response()->json([
            'data' => $this->search->search($query, $limit),
        ]);
    }

    public function priceHistory(Item $item, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'range' => ['nullable', 'string', 'in:24H,7D,30D,90D,1Y'],
        ]);

        $range = $validated['range'] ?? '24H';

        return response()->json($this->priceHistory->history($item, $range));
    }

    public function recentWorlds(Item $item, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $page = (int) ($validated['page'] ?? 1);

        return response()->json($this->recentWorlds->recent($item, $page));
    }
}
