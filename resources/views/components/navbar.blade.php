@props(['site'])

@php
    $navItems = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Start Tour', 'route' => 'tour.start'],
        ['label' => 'Tour Map', 'route' => 'tour.map'],
        ['label' => 'Locations', 'route' => 'locations.index'],
        ['label' => 'Events', 'route' => 'events.index'],
        ['label' => 'Visitor Info', 'route' => 'visitor.info'],
    ];
@endphp

<header class="site-header fixed inset-x-0 top-0 z-50 transition duration-300" data-site-header>
    <a href="#main-content" class="skip-link">Skip to content</a>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="group flex items-center gap-3 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold" aria-label="Kota Jail home">
            <span class="grid h-11 w-11 place-items-center rounded-full border border-muted-gold/70 bg-deep-charcoal text-sm font-bold tracking-[0.2em] text-muted-gold">KJ</span>
            <span class="leading-tight">
                <span class="block font-serif text-xl font-semibold text-paper-white">Kota Jail</span>
                <span class="block text-xs uppercase tracking-[0.22em] text-concrete">Johor Bahru</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 xl:flex" aria-label="Main navigation">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs($item['route']) ? 'is-active' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 xl:flex">
            <label class="sr-only" for="language-switcher">Language</label>
            <select id="language-switcher" data-language-select class="rounded-full border border-paper-white/20 bg-deep-charcoal/70 px-3 py-2 text-sm text-paper-white focus:border-muted-gold focus:outline-none">
                <option value="en">EN</option>
                <option value="ms">BM</option>
            </select>
            <x-button :href="route('tour.start')" variant="primary" icon="route">Start Tour</x-button>
        </div>

        <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-paper-white/20 bg-deep-charcoal/70 text-paper-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold xl:hidden" data-mobile-toggle aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open menu</span>
            <x-icon name="menu" class="h-5 w-5" />
        </button>
    </div>

    <div id="mobile-menu" class="mobile-drawer fixed inset-y-0 right-0 z-50 w-full max-w-sm translate-x-full overflow-y-auto bg-deep-charcoal px-6 py-6 text-paper-white shadow-2xl transition duration-300 xl:hidden" data-mobile-drawer aria-hidden="true">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-serif text-2xl font-semibold">Kota Jail</p>
                <p class="text-sm text-concrete">Self-guided tour</p>
            </div>
            <button type="button" class="grid h-11 w-11 place-items-center rounded-full border border-paper-white/20 text-paper-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold" data-mobile-close>
                <span class="sr-only">Close menu</span>
                <x-icon name="close" class="h-5 w-5" />
            </button>
        </div>

        <nav class="mt-10 grid gap-2" aria-label="Mobile navigation">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" class="rounded-xl px-4 py-3 text-base font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold">
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ route('visit.plan') }}" class="rounded-xl px-4 py-3 text-base font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold">Plan Your Visit</a>
            <a href="{{ route('gallery') }}" class="rounded-xl px-4 py-3 text-base font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold">Gallery</a>
            <a href="{{ route('contact') }}" class="rounded-xl px-4 py-3 text-base font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold">Contact</a>
        </nav>

        <div class="mt-8 rounded-2xl border border-muted-gold/30 bg-paper-white/5 p-4">
            <p class="text-sm uppercase tracking-[0.22em] text-muted-gold">Visitor note</p>
            <p class="mt-2 text-sm leading-6 text-concrete">{{ $site['hours'] }}</p>
            <x-button :href="route('tour.start')" variant="primary" class="mt-4 w-full" icon="route">Begin Tour</x-button>
        </div>
    </div>
    <div class="fixed inset-0 z-40 hidden bg-deep-charcoal/70 backdrop-blur-sm xl:hidden" data-mobile-overlay></div>
</header>
