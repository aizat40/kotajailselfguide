<nav class="fixed inset-x-0 bottom-0 z-50 w-full border-t border-paper-white/10 bg-deep-charcoal/95 px-4 pb-[calc(env(safe-area-inset-bottom)+0.75rem)] pt-2 shadow-2xl shadow-deep-charcoal/40 backdrop-blur lg:hidden" aria-label="Mobile bottom navigation">
    <div class="mx-auto grid max-w-md grid-cols-3 items-center gap-2 text-xs font-semibold text-paper-white">
        <a href="{{ route('home') }}" class="mobile-tab {{ request()->routeIs('home') ? 'is-active' : '' }}">
            <x-icon name="home" class="h-5 w-5" />
            <span>Home</span>
        </a>
        <a href="{{ route('tour.map') }}" class="mobile-tab {{ request()->routeIs('tour.map') ? 'is-active' : '' }}">
            <x-icon name="map" class="h-5 w-5" />
            <span>Map</span>
        </a>
        <a href="{{ route('tour.start') }}" class="mobile-tab {{ request()->routeIs('tour.start') ? 'is-active' : '' }}">
            <x-icon name="route" class="h-5 w-5" />
            <span data-mobile-progress>Tour</span>
        </a>
    </div>
</nav>
