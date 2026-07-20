<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$attachImage = function (array $item, ?array $image): array {
    if (! $image) {
        return $item;
    }

    $item['image'] = $image['image'];
    $item['alt'] = $image['alt'];
    $item['image_credit'] = $image['credit'] ?? null;
    $item['image_source_name'] = $image['source_name'] ?? null;
    $item['image_source_url'] = $image['source_url'] ?? null;
    $item['image_photographer'] = $image['photographer'] ?? null;
    $item['image_position'] = $image['position'] ?? 'center';
    $item['image_width'] = $image['width'] ?? null;
    $item['image_height'] = $image['height'] ?? null;

    return $item;
};

$siteData = function () use ($attachImage): array {
    return $attachImage(config('kotajail.site'), config('kotajail-images.sections.hero'));
};

$tourStops = function () use ($attachImage): array {
    $images = config('kotajail-images.stops', []);

    return array_map(
        fn (array $stop) => $attachImage($stop, $images[$stop['slug']] ?? null),
        config('kotajail.tour_stops')
    );
};

$eventsData = function () use ($attachImage): array {
    $images = config('kotajail-images.events', []);

    return array_map(
        fn (array $event) => $attachImage($event, $images[$event['slug']] ?? null),
        config('kotajail.events')
    );
};

$galleryData = function (): array {
    $images = config('kotajail-images.gallery', []);

    return array_map(function (array $item) use ($images): array {
        $image = $images[$item['id']] ?? null;

        if (! $image) {
            return $item;
        }

        $item = array_merge($item, $image);
        $item['image_credit'] = $image['credit'] ?? null;
        $item['image_source_name'] = $image['source_name'] ?? null;
        $item['image_source_url'] = $image['source_url'] ?? null;
        $item['image_photographer'] = $image['photographer'] ?? null;
        $item['image_position'] = $image['position'] ?? 'center';
        $item['image_width'] = $image['width'] ?? null;
        $item['image_height'] = $image['height'] ?? null;

        return $item;
    }, config('kotajail.gallery'));
};

$baseData = function (array $data = []) use ($siteData, $tourStops, $eventsData, $galleryData): array {
    return array_merge([
        'images' => config('kotajail-images'),
        'site' => $siteData(),
        'stops' => $tourStops(),
        'events' => $eventsData(),
        'timeline' => config('kotajail.timeline'),
        'galleryItems' => $galleryData(),
    ], $data);
};

$findBySlug = function (array $items, string $slug): ?array {
    foreach ($items as $index => $item) {
        if (($item['slug'] ?? null) === $slug) {
            $item['_index'] = $index;

            return $item;
        }
    }

    return null;
};

Route::get('/', function () use ($baseData) {
    return view('pages.home', $baseData([
        'title' => 'Kota Jail Johor Bahru Self-Guided Tour',
        'metaDescription' => 'Explore Kota Jail Johor Bahru through a respectful self-guided heritage tour with map stops, sample audio guides, events, gallery, and visitor planning tools.',
        'bodyClass' => 'home-page',
    ]));
})->name('home');

Route::get('/about', function () use ($baseData) {
    return view('pages.about', $baseData([
        'title' => 'About Kota Jail',
        'metaDescription' => 'Learn about Kota Jail, the former Ayer Molek Prison in Johor Bahru, and its present-day role in heritage, art, culture, and adaptive reuse.',
    ]));
})->name('about');

Route::get('/start-tour', function () use ($baseData) {
    return view('pages.start-tour', $baseData([
        'title' => 'Start the Kota Jail Self-Guided Tour',
        'metaDescription' => 'Choose your self-guided Kota Jail tour route, language, audio preference, accessibility mode, and estimated visit duration.',
        'routes' => config('kotajail.tour_routes'),
    ]));
})->name('tour.start');

Route::get('/tour-map', function () use ($baseData) {
    return view('pages.tour-map', $baseData([
        'title' => 'Kota Jail Tour Map',
        'metaDescription' => 'Use the Kota Jail tour map to browse self-guided stops, route lines, list view, filters, and completion controls.',
    ]));
})->name('tour.map');

Route::get('/locations', function () use ($baseData) {
    return view('pages.locations', $baseData([
        'title' => 'Kota Jail Tour Locations',
        'metaDescription' => 'Search and filter Kota Jail self-guided tour stops by history, architecture, art, heritage, culture, indoor, outdoor, and accessible categories.',
    ]));
})->name('locations.index');

Route::get('/locations/{slug}', function (string $slug) use ($baseData, $findBySlug, $tourStops, $galleryData) {
    $stops = $tourStops();
    $stop = $findBySlug($stops, $slug);

    abort_if(! $stop, 404);

    $previous = $stop['_index'] > 0 ? $stops[$stop['_index'] - 1] : null;
    $next = $stop['_index'] < count($stops) - 1 ? $stops[$stop['_index'] + 1] : null;

    return view('pages.location-detail', $baseData([
        'title' => $stop['title'].' | Kota Jail Tour Stop',
        'metaDescription' => $stop['excerpt'].' Explore this Kota Jail Johor Bahru self-guided tour stop with map, audio transcript, accessibility notes, and progress controls.',
        'stop' => $stop,
        'previousStop' => $previous,
        'nextStop' => $next,
        'detailGallery' => array_slice($galleryData(), 0, 4),
    ]));
})->name('locations.show');

Route::get('/events', function () use ($baseData) {
    return view('pages.events', $baseData([
        'title' => 'Kota Jail Events',
        'metaDescription' => 'Browse sample current, upcoming, and past Kota Jail events for exhibitions, workshops, heritage, art, culture, community, and guided tours.',
    ]));
})->name('events.index');

Route::get('/events/{slug}/calendar', function (string $slug) use ($findBySlug, $eventsData) {
    $event = $findBySlug($eventsData(), $slug);

    abort_if(! $event, 404);

    $start = str_replace(['-', ':'], '', $event['date'].'T'.$event['start_time'].'00');
    $end = str_replace(['-', ':'], '', $event['date'].'T'.$event['end_time'].'00');
    $uid = Str::slug($event['slug']).'@kotajail.local';
    $description = preg_replace('/\s+/', ' ', $event['description'].' '.$event['registration'].' '.$event['ticket']);
    $ics = implode("\r\n", [
        'BEGIN:VCALENDAR',
        'VERSION:2.0',
        'PRODID:-//Kota Jail//Self Guided Tour//EN',
        'BEGIN:VEVENT',
        'UID:'.$uid,
        'DTSTAMP:'.gmdate('Ymd\THis\Z'),
        'DTSTART:'.$start,
        'DTEND:'.$end,
        'SUMMARY:'.$event['title'],
        'LOCATION:'.$event['venue'],
        'DESCRIPTION:'.$description,
        'END:VEVENT',
        'END:VCALENDAR',
        '',
    ]);

    return response($ics, Response::HTTP_OK, [
        'Content-Type' => 'text/calendar; charset=utf-8',
        'Content-Disposition' => 'attachment; filename="'.Str::slug($event['title']).'.ics"',
    ]);
})->name('events.calendar');

Route::get('/events/{slug}', function (string $slug) use ($baseData, $findBySlug, $eventsData) {
    $events = $eventsData();
    $event = $findBySlug($events, $slug);

    abort_if(! $event, 404);

    $related = array_values(array_filter($events, fn ($item) => $item['slug'] !== $event['slug'] && $item['category'] === $event['category']));
    $related = count($related) ? $related : array_values(array_filter($events, fn ($item) => $item['slug'] !== $event['slug']));

    return view('pages.event-detail', $baseData([
        'title' => $event['title'].' | Kota Jail Event',
        'metaDescription' => $event['excerpt'].' View programme details, venue, registration notes, ticket information, and calendar link.',
        'event' => $event,
        'relatedEvents' => array_slice($related, 0, 3),
    ]));
})->name('events.show');

Route::get('/plan-your-visit', function () use ($baseData) {
    return view('pages.plan-visit', $baseData([
        'title' => 'Plan Your Kota Jail Visit',
        'metaDescription' => 'Plan a Kota Jail Johor Bahru visit with route recommendations based on time, interests, group type, accessibility needs, and language preference.',
        'profiles' => config('kotajail.planner_profiles'),
    ]));
})->name('visit.plan');

Route::get('/visitor-information', function () use ($baseData) {
    return view('pages.visitor-information', $baseData([
        'title' => 'Kota Jail Visitor Information',
        'metaDescription' => 'Find Kota Jail opening hours, address, directions, parking, accessibility, photography, facilities, safety guidance, FAQs, and verification notes.',
        'visitorInfo' => config('kotajail.visitor_info'),
        'faqs' => config('kotajail.faqs'),
    ]));
})->name('visitor.info');

Route::get('/gallery', function () use ($baseData) {
    return view('pages.gallery', $baseData([
        'title' => 'Kota Jail Gallery',
        'metaDescription' => 'Explore a filterable Kota Jail gallery for historical photographs, architecture, art, exhibitions, cultural activities, and visitor experiences.',
    ]));
})->name('gallery');

Route::get('/contact', function () use ($baseData) {
    return view('pages.contact', $baseData([
        'title' => 'Contact Kota Jail',
        'metaDescription' => 'View Kota Jail address, contact details, map guidance, general enquiry form, group visit enquiry form, and event collaboration information.',
    ]));
})->name('contact');
