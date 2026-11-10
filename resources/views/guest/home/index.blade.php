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

                <div class="relative w-full md:w-72" x-data="itemSearch()" @click.outside="close()" @keydown="onKeyDown($event)">
                    <label for="item-search" class="text-xs font-medium text-gray-500">Search items</label>
                    <input
                        id="item-search"
                        x-ref="input"
                        x-model="query"
                        @input="onInput()"
                        @focus="query.trim().length >= 2 ? open = true : null"
                        type="search"
                        placeholder="Search items..."
                        autocomplete="off"
                        role="combobox"
                        aria-autocomplete="list"
                        :aria-expanded="open"
                        aria-controls="item-search-listbox"
                        class="mt-1 w-full rounded-xl border border-[#E4EAF0] bg-white px-4 py-2 text-sm text-[#172B44] outline-none placeholder:text-gray-400"
                    >
                    <p class="mt-1 text-xs text-gray-500">Type at least 2 characters. Search is coming from live data.</p>

                    <div
                        x-show="open"
                        x-transition
                        id="item-search-listbox"
                        x-ref="list"
                        role="listbox"
                        class="absolute z-20 mt-2 w-full overflow-hidden rounded-2xl border border-[#E4EAF0] bg-white shadow-lg"
                    >
                        <div x-show="loading" class="px-4 py-3 text-sm text-gray-500">Loading...</div>
                        <div x-show="!loading && error" class="px-4 py-3 text-sm text-red-500">Search failed. Try again.</div>
                        <div x-show="!loading && !error && searched && results.length === 0" class="px-4 py-3 text-sm text-gray-500">
                            No items found.
                        </div>
                        <template x-for="(item, index) in results" :key="item.id">
                            <a
                                :href="item.url"
                                role="option"
                                :aria-selected="activeIndex === index"
                                :data-index="index"
                                @mouseenter="activeIndex = index"
                                class="block px-4 py-3 text-sm text-[#172B44] transition hover:bg-[#F7FAFC]"
                                :class="activeIndex === index ? 'bg-[#FFD93D]/20' : ''"
                            >
                                <span x-text="item.name"></span>
                            </a>
                        </template>
                    </div>
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
                                <h3 class="text-sm font-bold text-[#172B44] sm:text-base">
                                    <a href="{{ route('items.show', $item['slug'] ?? $item['item_id']) }}" class="hover:text-[#58CC45]">
                                        {{ $item['name'] }}
                                    </a>
                                </h3>
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