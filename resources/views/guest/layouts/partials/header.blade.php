<header class="sticky top-0 z-40 border-b border-[#E4EAF0] bg-white/90 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center gap-3 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home.index') }}" class="flex shrink-0 items-center gap-3 font-bold text-[#172B44]">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-[#FFD93D] text-sm font-black text-[#172B44]">G</span>
            <span class="text-lg">Growlytics</span>
        </a>

        <div class="relative min-w-0 flex-1" x-data="itemSearch()" @click.outside="close()" @keydown="onKeyDown($event)">
            <label for="item-search" class="sr-only">Search items</label>
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
                class="w-full rounded-xl border border-[#E4EAF0] bg-white px-4 py-2 text-sm text-[#172B44] outline-none placeholder:text-gray-400 focus:border-[#58CC45]"
            >

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

        <nav class="hidden items-center gap-6 text-sm font-medium md:flex">
            <a href="{{ route('home.index') }}" class="{{ request()->routeIs('home.index') ? 'text-[#58CC45]' : 'text-[#172B44] transition hover:text-[#58CC45]' }}">
                Home
            </a>
            <span class="cursor-not-allowed text-gray-400" aria-disabled="true">
                Items <span class="text-xs">(Coming soon)</span>
            </span>
            <span class="cursor-not-allowed text-gray-400" aria-disabled="true">
                Trends <span class="text-xs">(Coming soon)</span>
            </span>
        </nav>

        <div x-data="{ open: false }" class="md:hidden">
            <button type="button" @click="open = !open" class="inline-flex items-center justify-center rounded-lg border border-[#E4EAF0] p-2 text-[#172B44]" aria-label="Toggle navigation">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav x-show="open" x-transition class="absolute left-0 right-0 top-full border-b border-[#E4EAF0] bg-white px-4 py-4 shadow-lg">
                <div class="flex flex-col gap-3 text-sm font-medium">
                    <a href="{{ route('home.index') }}" class="{{ request()->routeIs('home.index') ? 'text-[#58CC45]' : 'text-[#172B44]' }}">Home</a>
                    <span class="text-gray-400">Items (Coming soon)</span>
                    <span class="text-gray-400">Trends (Coming soon)</span>
                </div>
            </nav>
        </div>
    </div>
</header>