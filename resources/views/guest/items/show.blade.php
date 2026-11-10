@extends('guest.layouts.master')

@section('title', $item->name.' — Growlytics')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ $backUrl ?? route('home.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#E4EAF0] bg-white px-4 py-2 text-sm font-semibold text-[#172B44] transition hover:border-[#58CC45] hover:text-[#58CC45] focus:outline-none focus:ring-2 focus:ring-[#58CC45] focus:ring-offset-2">
                <span aria-hidden="true">←</span>
                Back to Items
            </a>
        </div>
        <nav class="text-sm text-gray-500">
            <a href="{{ route('home.index') }}" class="hover:text-[#58CC45]">Home</a>
            <span class="mx-2">/</span>
            <span class="text-[#172B44]">{{ $item->name }}</span>
        </nav>

        <div class="mt-4 rounded-3xl border border-[#E4EAF0] bg-white p-5 shadow-sm sm:p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-[#172B44] sm:text-3xl">{{ $item->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Advertised marketplace prices, not confirmed transactions.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach (['24H', '7D', '30D', '90D', '1Y'] as $range)
                        <button
                            type="button"
                            data-range="{{ $range }}"
                            class="rounded-full border border-[#E4EAF0] px-3 py-1 text-xs font-semibold text-[#172B44] transition hover:border-[#FFD93D]"
                        >
                            {{ $range }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-[#E4EAF0] bg-[#F7FAFC] p-4">
                    <p class="text-xs font-medium text-gray-500">Buy listings</p>
                    <p id="summary-buy-count" class="mt-1 text-xl font-black text-[#172B44]">—</p>
                    <p id="summary-buy-median" class="text-xs text-gray-500">Median —</p>
                </div>
                <div class="rounded-2xl border border-[#E4EAF0] bg-[#F7FAFC] p-4">
                    <p class="text-xs font-medium text-gray-500">Sell listings</p>
                    <p id="summary-sell-count" class="mt-1 text-xl font-black text-[#172B44]">—</p>
                    <p id="summary-sell-median" class="text-xs text-gray-500">Median —</p>
                </div>
                <div class="rounded-2xl border border-[#E4EAF0] bg-[#F7FAFC] p-4">
                    <p class="text-xs font-medium text-gray-500">Buy range</p>
                    <p id="summary-buy-range" class="mt-1 text-sm font-bold text-[#172B44]">—</p>
                </div>
                <div class="rounded-2xl border border-[#E4EAF0] bg-[#F7FAFC] p-4">
                    <p class="text-xs font-medium text-gray-500">Sell range</p>
                    <p id="summary-sell-range" class="mt-1 text-sm font-bold text-[#172B44]">—</p>
                </div>
            </div>

            <div class="relative mt-6">
                <div id="chart-loading" class="absolute inset-0 z-10 flex items-center justify-center rounded-2xl bg-white/80 text-sm text-gray-500">
                    Loading price history...
                </div>
                <div id="chart-empty" class="hidden absolute inset-0 z-10 flex items-center justify-center rounded-2xl bg-white/80 text-sm text-gray-500">
                    No listings in this range.
                </div>
                <div id="chart-error" class="hidden absolute inset-0 z-10 flex items-center justify-center rounded-2xl bg-white/80 text-sm text-red-500">
                    Failed to load price history.
                </div>
                <div id="chart-unavailable" class="hidden absolute inset-0 z-10 flex items-center justify-center rounded-2xl bg-white/80 text-sm text-gray-500">
                    Price history is unavailable for this range.
                </div>
                <div
                    id="item-price-chart"
                    data-item-id="{{ $item->id }}"
                    class="h-[420px] w-full rounded-2xl border border-[#E4EAF0] bg-white"
                ></div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Scatter points are sampled for display only; median and percentiles use all valid listings.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-[#E4EAF0] bg-white p-5 shadow-sm sm:p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-black tracking-tight text-[#172B44]">Recent Sell Listings by World</h2>
                <p class="text-xs text-gray-500">Rolling 24 hours UTC</p>
            </div>

            <div id="recent-worlds" class="mt-4 grid gap-3"></div>

            <div class="mt-4 flex justify-center">
                <button
                    id="load-more-worlds"
                    type="button"
                    class="hidden rounded-full border border-[#E4EAF0] px-4 py-2 text-sm font-semibold text-[#172B44] transition hover:border-[#FFD93D]"
                >
                    Load more
                </button>
            </div>
        </div>
    </section>
@endsection