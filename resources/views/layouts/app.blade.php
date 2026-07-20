@php
    $site = $site ?? config('kotajail.site');
    $pageTitle = $title ?? $site['name'];
    $description = $metaDescription ?? $site['description'];
    $ogImage = asset($site['image']);
    $stops = $stops ?? config('kotajail.tour_stops');
    $events = $events ?? config('kotajail.events');
    $galleryItems = $galleryItems ?? config('kotajail.gallery');
    $stopsForJs = array_map(fn ($stop) => array_merge($stop, [
        'url' => route('locations.show', $stop['slug']),
        'image_url' => asset($stop['image']),
    ]), $stops);
    $eventsForJs = array_map(fn ($event) => array_merge($event, [
        'url' => route('events.show', $event['slug']),
        'image_url' => asset($event['image']),
    ]), $events);
    $galleryForJs = array_map(fn ($item) => array_merge($item, [
        'image_url' => asset($item['image']),
    ]), $galleryItems);
    $clientData = [
        'stops' => $stopsForJs,
        'events' => $eventsForJs,
        'gallery' => $galleryForJs,
        'plannerProfiles' => config('kotajail.planner_profiles'),
        'routes' => config('kotajail.tour_routes'),
    ];
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }} | {{ $site['name'] }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $site['keywords'] }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper-white font-sans text-charcoal antialiased {{ $bodyClass ?? '' }}" data-page="{{ Route::currentRouteName() }}">
    <x-navbar :site="$site" />

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <x-footer :site="$site" />
    <x-mobile-navigation />

    <button type="button" class="fixed bottom-28 right-4 z-40 hidden h-12 w-12 place-items-center rounded-full bg-rust text-paper-white shadow-lg shadow-rust/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold lg:bottom-8" data-back-to-top aria-label="Back to top">
        <x-icon name="arrow-left" class="h-5 w-5 rotate-90" />
    </button>

    <div class="fixed inset-0 z-[70] hidden items-center justify-center bg-deep-charcoal/75 p-4 backdrop-blur-sm" data-scan-modal role="dialog" aria-modal="true" aria-labelledby="scan-title">
        <div class="w-full max-w-md rounded-3xl bg-paper-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="section-label">QR checkpoint</p>
                    <h2 id="scan-title" class="mt-2 font-serif text-3xl font-semibold text-deep-charcoal">Scan a stop code</h2>
                </div>
                <button type="button" class="grid h-11 w-11 place-items-center rounded-full border border-concrete text-deep-charcoal" data-close-scan aria-label="Close scan modal">
                    <x-icon name="close" class="h-5 w-5" />
                </button>
            </div>
            <div class="mt-6 rounded-2xl border border-dashed border-rust/40 bg-heritage-cream p-6 text-center">
                <div class="mx-auto grid h-20 w-20 place-items-center rounded-2xl bg-deep-charcoal text-muted-gold">
                    <x-icon name="qr-code" class="h-10 w-10" />
                </div>
                <p class="mt-5 text-base leading-7 text-charcoal">Scan a Kota Jail QR code at a tour stop to open its digital guide.</p>
                <p class="mt-3 text-sm leading-6 text-charcoal/70">Camera scanning is intentionally left as a future enhancement for this display-only version.</p>
            </div>
            <x-button :href="route('locations.index')" variant="dark" class="mt-6 w-full" icon="arrow-right">Browse tour stops</x-button>
        </div>
    </div>

    <div class="fixed bottom-28 left-1/2 z-[80] hidden w-[calc(100%-2rem)] max-w-md -translate-x-1/2 rounded-2xl bg-deep-charcoal px-4 py-3 text-sm font-semibold text-paper-white shadow-2xl lg:bottom-8" data-toast role="status" aria-live="polite"></div>

    <script>
        window.KOTA_JAIL = {!! \Illuminate\Support\Js::from($clientData) !!};
    </script>
    @stack('scripts')
</body>
</html>
