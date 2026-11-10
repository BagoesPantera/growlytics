@extends('guest.layouts.master')

@section('title', 'Growlytics — Growtopia Marketplace Price Analytics')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-[#E4EAF0] bg-white p-5 shadow-sm sm:p-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="max-w-2xl">
                    <span class="inline-flex rounded-full bg-[#FFD93D]/20 px-3 py-1 text-xs font-semibold text-[#9A6239]">
                        Growtopia marketplace analytics
                    </span>
                    <h1 class="mt-3 text-2xl font-black tracking-tight text-[#172B44] sm:text-3xl">
                        Explore the Growtopia Marketplace
                    </h1>
                    <p class="mt-2 text-sm leading-6 text-gray-600 sm:text-base">
                        Growlytics collects Growtopia marketplace listings and turns them into price history,
                        buy and sell activity, and weekly item trends.
                    </p>
                </div>

                <div class="w-full md:w-72">
                    <label for="item-search" class="text-xs font-medium text-gray-500">Search items (coming soon)</label>
                    <input
                        id="item-search"
                        type="search"
                        placeholder="Search items (coming soon)"
                        disabled
                        aria-label="Search items (coming soon)"
                        class="mt-1 w-full rounded-xl border border-[#E4EAF0] bg-gray-50 px-4 py-2 text-sm text-[#172B44] outline-none placeholder:text-gray-400 disabled:cursor-not-allowed"
                    >
                    <p class="mt-1 text-xs text-gray-500">Item search will be available in a future release.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="top-items-this-week" class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-xl font-black tracking-tight text-[#172B44] sm:text-2xl">Top Items This Week</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Ranking resets every Monday at 00:00 UTC.
                </p>
            </div>
            <p class="text-xs text-gray-500 sm:text-sm">
                Period: {{ $weekStart->format('D, d M Y H:i') }} UTC to {{ $weekEnd->format('D, d M Y H:i') }} UTC
            </p>
        </div>

        @if ($topItems->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-[#E4EAF0] bg-white p-8 text-center">
                <p class="text-base font-semibold text-[#172B44]">No listings yet this week</p>
                <p class="mt-1 text-sm text-gray-600">
                    Top items will appear here once marketplace listings are recorded during the current UTC week.
                </p>
            </div>
        @else
            <ol class="mt-4 grid gap-3">
                @foreach ($topItems as $index => $item)
                    @php
                        $accentBorder = match (true) {
                            $index === 0 => 'border-[#FFD93D]',
                            $index === 1 => 'border-[#58CC45]',
                            $index === 2 => 'border-[#BBDDEB]',
                            default => 'border-[#E4EAF0]',
                        };
                        $rankBg = match (true) {
                            $index === 0 => 'bg-[#FFD93D] text-[#172B44]',
                            $index === 1 => 'bg-[#58CC45] text-white',
                            $index === 2 => 'bg-[#BBDDEB] text-[#172B44]',
                            default => 'bg-[#F7FAFC] text-[#172B44]',
                        };
                    @endphp
                    <li class="flex flex-col gap-3 rounded-2xl border {{ $accentBorder }} bg-white p-4 shadow-sm transition hover:shadow-md sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $rankBg }} text-sm font-black">
                                {{ $index + 1 }}
                            </span>
                            <div>
                                <h3 class="text-sm font-bold text-[#172B44] sm:text-base">{{ $item['name'] }}</h3>
                                <p class="text-xs text-gray-500">Item #{{ $item['item_id'] }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 text-xs font-medium sm:text-sm">
                            <span class="rounded-full bg-[#172B44] px-3 py-1 text-white">
                                Total {{ number_format($item['total']) }}
                            </span>
                            <span class="rounded-full bg-[#58CC45]/15 px-3 py-1 text-[#2f7a27]">
                                Buy {{ number_format($item['buy_count']) }}
                            </span>
                            <span class="rounded-full bg-[#8584CC]/15 px-3 py-1 text-[#5b5aa3]">
                                Sell {{ number_format($item['sell_count']) }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ol>
        @endif
    </section>
@endsection