<nav class="fixed inset-x-3 bottom-3 z-40 rounded-3xl border border-deep-charcoal/10 bg-paper-white/95 p-2 shadow-2xl shadow-deep-charcoal/20 backdrop-blur lg:hidden" aria-label="Mobile bottom navigation">
    <div class="grid grid-cols-5 items-end gap-1 text-xs font-semibold text-charcoal">
        <a href="{{ route('home') }}" class="mobile-tab {{ request()->routeIs('home') ? 'is-active' : '' }}">
            <x-icon name="home" class="h-5 w-5" />
            <span>Home</span>
        </a>
        <a href="{{ route('tour.map') }}" class="mobile-tab {{ request()->routeIs('tour.map') ? 'is-active' : '' }}">
            <x-icon name="map" class="h-5 w-5" />
            <span>Map</span>
        </a>
        <button type="button" class="-mt-8 flex flex-col items-center gap-1 text-rust" data-open-scan>
            <span class="grid h-16 w-16 place-items-center rounded-full bg-rust text-paper-white shadow-lg shadow-rust/35">
                <x-icon name="scan" class="h-7 w-7" />
            </span>
            <span>Scan</span>
        </button>
        <a href="{{ route('tour.start') }}" class="mobile-tab {{ request()->routeIs('tour.start') ? 'is-active' : '' }}">
            <x-icon name="route" class="h-5 w-5" />
            <span data-mobile-progress>Tour</span>
        </a>
        <button type="button" class="mobile-tab" data-mobile-toggle aria-label="Open more navigation">
            <x-icon name="more" class="h-5 w-5" />
            <span>More</span>
        </button>
    </div>
</nav>
