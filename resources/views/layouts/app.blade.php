@php
    $site = $site ?? config('kotajail.site');
    $pageTitle = $title ?? $site['name'];
    $description = $metaDescription ?? $site['description'];
    $ogImage = asset($site['image']);
    $stops = $stops ?? config('kotajail.tour_stops');
    $galleryItems = $galleryItems ?? config('kotajail.gallery');
    $stopsForJs = array_map(fn ($stop) => array_merge($stop, [
        'url' => route('locations.show', $stop['slug']),
        'image_url' => asset($stop['image']),
    ]), $stops);
    $galleryForJs = array_map(fn ($item) => array_merge($item, [
        'image_url' => asset($item['image']),
    ]), $galleryItems);
    $clientData = [
        'stops' => $stopsForJs,
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

    <main id="main-content" class="relative pb-44 md:pb-36 lg:pb-0" tabindex="-1">
        @yield('content')
    </main>

    <x-footer :site="$site" />
    <x-mobile-navigation />

    <button type="button" class="fixed bottom-32 right-4 z-[60] hidden h-12 w-12 place-items-center rounded-full bg-rust text-paper-white shadow-lg shadow-rust/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold sm:right-6 md:bottom-28 lg:bottom-8 grid" data-back-to-top aria-label="Back to top">
        <x-icon name="arrow-left" class="h-5 w-5 rotate-90" />
    </button>

    <div class="fixed bottom-32 left-1/2 z-[80] hidden w-[calc(100%-2rem)] max-w-md -translate-x-1/2 rounded-2xl bg-deep-charcoal px-4 py-3 text-sm font-semibold text-paper-white shadow-2xl md:bottom-28 lg:bottom-8" data-toast role="status" aria-live="polite"></div>

    <script>
        window.KOTA_JAIL = {!! \Illuminate\Support\Js::from($clientData) !!};
    </script>
    @stack('scripts')
</body>
</html>
