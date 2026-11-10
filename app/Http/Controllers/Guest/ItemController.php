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

    public function show(string $item, Request $request)
    {
        $resolved = $this->resolveItem($item);

        abort_if($resolved === null, 404);

        if ($resolved->slug !== null && ctype_digit($item) && $resolved->slug !== $item) {
            return redirect()->route('items.show', $resolved, 301);
        }

        return view('guest.items.show', [
            'item' => $resolved,
            'backUrl' => $this->safeBackUrl($request),
        ]);
    }

    private function safeBackUrl(Request $request): string
    {
        foreach (['from', 'return', 'return_url', 'back', 'redirect', 'previous'] as $key) {
            $candidate = $request->query($key);

            if (is_string($candidate) && $this->isSafeInternalUrl($candidate, $request)) {
                return $candidate;
            }
        }

        $referer = $request->headers->get('referer');

        if (is_string($referer) && $this->isSafeInternalUrl($referer, $request)) {
            return $referer;
        }

        return route('home.index');
    }

    private function isSafeInternalUrl(?string $url, Request $request): bool
    {
        if (! is_string($url) || trim($url) === '') {
            return false;
        }

        $url = trim($url);

        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return true;
        }

        $parsed = parse_url($url);

        if ($parsed === false || empty($parsed['host'])) {
            return false;
        }

        if (! in_array($parsed['scheme'] ?? 'https', ['http', 'https'], true)) {
            return false;
        }

        if ($parsed['host'] !== $request->getHost()) {
            return false;
        }

        return true;
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

    public function priceHistory(string $item, Request $request): JsonResponse
    {
        $resolved = $this->resolveItem($item);

        abort_if($resolved === null, 404);

        $validated = $request->validate([
            'range' => ['nullable', 'string', 'in:24H,7D,30D,90D,1Y'],
        ]);

        $range = $validated['range'] ?? '24H';

        return response()->json($this->priceHistory->history($resolved, $range));
    }

    public function recentWorlds(string $item, Request $request): JsonResponse
    {
        $resolved = $this->resolveItem($item);

        abort_if($resolved === null, 404);

        $validated = $request->validate([
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $page = (int) ($validated['page'] ?? 1);

        return response()->json($this->recentWorlds->recent($resolved, $page));
    }

    private function resolveItem(string $value): ?Item
    {
        $item = Item::query()->where('slug', $value)->first();

        if ($item === null && ctype_digit($value)) {
            $item = Item::query()->find((int) $value);
        }

        return $item;
    }
}
