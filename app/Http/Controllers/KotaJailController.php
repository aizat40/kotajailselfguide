<?php

namespace App\Http\Controllers;

class KotaJailController extends Controller
{
    public function home()
    {
        return view('pages.home', $this->baseData([
            'title' => 'Kota Jail Johor Bahru Self-Guided Tour',
            'metaDescription' => 'Explore Kota Jail Johor Bahru through a respectful self-guided heritage website with historical context, visual archives, and visitor planning information.',
            'bodyClass' => 'home-page',
        ]));
    }

    public function about()
    {
        return view('pages.about', $this->baseData([
            'title' => 'About Kota Jail',
            'metaDescription' => 'Learn about Kota Jail, the former Ayer Molek Prison in Johor Bahru, and its present-day role in heritage, art, culture, and adaptive reuse.',
        ]));
    }

    public function startTour()
    {
        return view('pages.start-tour', $this->baseData([
            'title' => 'Start the Kota Jail Self-Guided Tour',
            'metaDescription' => 'Choose your Kota Jail self-guided route, reading pace, accessibility mode, visual archive mode, and estimated visit duration.',
            'routes' => config('kotajail.tour_routes'),
        ]));
    }

    public function tourMap()
    {
        return view('pages.tour-map', $this->baseData([
            'title' => 'Kota Jail Tour Map',
            'metaDescription' => 'Use the Kota Jail tour map to browse self-guided stops, route lines, list view, filters, and completion controls.',
        ]));
    }

    public function locations()
    {
        return view('pages.locations', $this->baseData([
            'title' => 'Kota Jail Tour Locations',
            'metaDescription' => 'Search and filter Kota Jail self-guided tour stops by history, architecture, art, heritage, culture, indoor, outdoor, and accessible categories.',
        ]));
    }

    public function locationDetail(string $slug)
    {
        $stops = $this->tourStops();
        $stop = $this->findBySlug($stops, $slug);

        abort_if(! $stop, 404);

        $previous = $stop['_index'] > 0 ? $stops[$stop['_index'] - 1] : null;
        $next = $stop['_index'] < count($stops) - 1 ? $stops[$stop['_index'] + 1] : null;

        return view('pages.location-detail', $this->baseData([
            'title' => $stop['title'].' | Kota Jail Tour Stop',
            'metaDescription' => $stop['excerpt'].' Explore this Kota Jail Johor Bahru self-guided tour stop with map context, accessibility notes, visual references, and progress controls.',
            'stop' => $stop,
            'previousStop' => $previous,
            'nextStop' => $next,
            'detailGallery' => array_slice($this->galleryData(), 0, 4),
        ]));
    }

    public function planVisit()
    {
        return view('pages.plan-visit', $this->baseData([
            'title' => 'Plan Your Kota Jail Visit',
            'metaDescription' => 'Plan a Kota Jail Johor Bahru visit with route recommendations based on time, interests, group type, and accessibility needs.',
            'profiles' => config('kotajail.planner_profiles'),
        ]));
    }

    public function visitorInfo()
    {
        return view('pages.visitor-information', $this->baseData([
            'title' => 'Kota Jail Visitor Information',
            'metaDescription' => 'Find Kota Jail opening hours, address, directions, parking, accessibility, photography, facilities, safety guidance, FAQs, and verification notes.',
            'visitorInfo' => config('kotajail.visitor_info'),
            'faqs' => config('kotajail.faqs'),
        ]));
    }

    public function gallery()
    {
        return view('pages.gallery', $this->baseData([
            'title' => 'Kota Jail Gallery',
            'metaDescription' => 'Explore a filterable Kota Jail gallery for historical photographs, architecture, art, exhibitions, cultural activities, and visitor experiences.',
        ]));
    }

    public function contact()
    {
        return view('pages.contact', $this->baseData([
            'title' => 'Contact Kota Jail',
            'metaDescription' => 'View Kota Jail address, contact details, map guidance, general enquiry form, group visit enquiry form, and event collaboration information.',
        ]));
    }

    private function attachImage(array $item, ?array $image): array
    {
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
    }

    private function siteData(): array
    {
        return $this->attachImage(config('kotajail.site'), config('kotajail-images.sections.hero'));
    }

    private function tourStops(): array
    {
        $images = config('kotajail-images.stops', []);

        return array_map(
            fn (array $stop) => $this->attachImage($stop, $images[$stop['slug']] ?? null),
            config('kotajail.tour_stops')
        );
    }

    private function galleryData(): array
    {
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
    }

    private function baseData(array $data = []): array
    {
        return array_merge([
            'images' => config('kotajail-images'),
            'site' => $this->siteData(),
            'stops' => $this->tourStops(),
            'timeline' => config('kotajail.timeline'),
            'galleryItems' => $this->galleryData(),
        ], $data);
    }

    private function findBySlug(array $items, string $slug): ?array
    {
        foreach ($items as $index => $item) {
            if (($item['slug'] ?? null) === $slug) {
                $item['_index'] = $index;

                return $item;
            }
        }

        return null;
    }
}
