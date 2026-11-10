<footer class="border-t border-[#E4EAF0] bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-3 font-bold text-[#172B44]">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-[#FFD93D] text-sm font-black text-[#172B44]">G</span>
                    <span class="text-lg">Growlytics</span>
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600">
                    Growtopia marketplace price analytics built from historical listing data.
                </p>
            </div>

            <nav class="text-sm font-medium text-[#172B44]">
                <p class="mb-3 font-semibold">Navigate</p>
                <ul class="space-y-2">
                    <li><a href="{{ route('home.index') }}" class="transition hover:text-[#58CC45]">Home</a></li>
                    <li><a href="#top-items-this-week" class="transition hover:text-[#58CC45]">Top Items This Week</a></li>
                </ul>
            </nav>

            <div class="text-sm leading-6 text-gray-600">
                <p class="font-semibold text-[#172B44]">Data note</p>
                <p class="mt-3">
                    Statistics are based on marketplace listings and advertised prices, not confirmed transactions.
                </p>
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Growlytics. All rights reserved.
        </p>
    </div>
</footer>
