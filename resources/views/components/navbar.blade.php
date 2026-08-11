@props(['site'])

@php
    $navItems = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Start Tour', 'route' => 'tour.start'],
        ['label' => 'Tour Map', 'route' => 'tour.map'],
        ['label' => 'Locations', 'route' => 'locations.index'],
        ['label' => 'Gallery', 'route' => 'gallery'],
        ['label' => 'Visitor Info', 'route' => 'visitor.info'],
    ];
@endphp

<header class="site-header fixed inset-x-0 top-0 z-50 transition duration-300" data-site-header>
    <a href="#main-content" class="skip-link">Skip to content</a>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="group flex items-center gap-3 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold" aria-label="Kota Jail home">
            <span class="grid h-11 w-11 place-items-center rounded-full border border-muted-gold/70 bg-deep-charcoal text-sm font-bold tracking-[0.2em] text-muted-gold">SG</span>
            <span class="leading-tight">
                <span class="block font-serif text-xl font-semibold text-paper-white">Self-Guide Kota Jail</span>
                <span class="block text-xs uppercase tracking-[0.22em] text-concrete">Ayer Molek</span>
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
            <x-button :href="route('tour.start')" variant="primary" icon="route">Start Tour</x-button>
        </div>

    </div>
</header>
