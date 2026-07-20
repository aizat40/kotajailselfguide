@extends('layouts.app')

@php
    $title = 'Page Not Found';
    $metaDescription = 'The requested Kota Jail self-guided tour page could not be found.';
    $errorImage = config('kotajail-images.sections.error_404');
@endphp

@section('content')
    <section class="relative grid min-h-screen place-items-center overflow-hidden bg-deep-charcoal px-4 py-32 text-center text-paper-white sm:px-6 lg:px-8">
        <img
            src="{{ asset($errorImage['image']) }}"
            alt="{{ $errorImage['alt'] }}"
            class="absolute inset-0 h-full w-full object-cover"
            style="object-position: {{ $errorImage['position'] }};"
            width="{{ $errorImage['width'] }}"
            height="{{ $errorImage['height'] }}"
        >
        <div class="absolute inset-0 bg-deep-charcoal/85"></div>
        <div class="bar-pattern absolute inset-0 opacity-25"></div>
        <div class="relative mx-auto max-w-3xl">
            <p class="section-label text-muted-gold">404</p>
            <h1 class="mt-4 font-serif text-5xl font-bold sm:text-7xl">This passage is closed.</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-concrete">The page or tour stop you requested could not be found. Return to a public route and continue exploring Kota Jail.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <x-button :href="route('home')" variant="primary" icon="home">Return Home</x-button>
                <x-button :href="route('tour.map')" variant="secondary" icon="map">View Tour Map</x-button>
                <x-button :href="route('locations.index')" variant="secondary" icon="arrow-right">Explore Locations</x-button>
            </div>
        </div>
    </section>
@endsection
