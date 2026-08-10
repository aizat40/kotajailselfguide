<?php

$credit = 'By Self-Guide Kota Jail team, local img_update field photo';
$sourceName = 'img_update local assets';

$photos = [
    'corridor' => [
        'image' => 'images/kota-jail/img_update/gambar1.jpg',
        'alt' => 'Atmospheric Kota Jail corridor with barred cell doors, aged walls, graffiti, and a central stair.',
        'position' => 'center 50%',
        'width' => 1080,
        'height' => 720,
    ],
    'gate' => [
        'image' => 'images/kota-jail/img_update/gambar2.jpg',
        'alt' => 'Tall arched Kota Jail doorway with black metal grille and warm overhead light.',
        'position' => 'center 46%',
        'width' => 607,
        'height' => 1080,
    ],
    'justice-display' => [
        'image' => 'images/kota-jail/img_update/gambar3.jpg',
        'alt' => 'Kota Jail interior display about the criminal justice system beside an old cell door.',
        'position' => 'center 46%',
        'width' => 607,
        'height' => 1080,
    ],
    'exhibition-room' => [
        'image' => 'images/kota-jail/img_update/gambar4.jpg',
        'alt' => 'Kota Jail exhibition room with weathered walls, interpretive display, and preserved historical objects.',
        'position' => 'center 50%',
        'width' => 1080,
        'height' => 607,
    ],
    'qr-wall' => [
        'image' => 'images/kota-jail/img_update/gambar5.jpg',
        'alt' => 'Weathered Kota Jail exterior wall with visitor QR signage and plants along the walkway.',
        'position' => 'center 48%',
        'width' => 810,
        'height' => 1080,
    ],
];

$image = function (string $key, string $title, ?string $alt = null, ?string $position = null) use ($photos, $credit, $sourceName): array {
    return [
        'title' => $title,
        'image' => $photos[$key]['image'],
        'alt' => $alt ?? $photos[$key]['alt'],
        'credit' => $credit,
        'source_name' => $sourceName,
        'source_url' => null,
        'photographer' => 'Self-Guide Kota Jail team',
        'position' => $position ?? $photos[$key]['position'],
        'width' => $photos[$key]['width'],
        'height' => $photos[$key]['height'],
    ];
};

return [
    'sections' => [
        'hero' => $image('corridor', 'Kota Jail corridor hero', 'Main atmospheric Kota Jail corridor used as the first landing-page visual.', 'center 52%'),
        'home_intro' => $image('gate', 'Kota Jail barred doorway', 'Arched barred doorway at Kota Jail, Ayer Molek, Johor Bahru.', 'center 45%'),
        'home_features' => $image('qr-wall', 'Kota Jail QR checkpoint wall', 'Kota Jail exterior wall with QR signage used for checkpoint guidance.', 'center 48%'),
        'home_timeline' => $image('justice-display', 'Kota Jail justice display', 'Interpretive justice-system display inside Kota Jail beside a former cell door.', 'center 45%'),
        'home_visit' => $image('gate', 'Kota Jail visitor doorway', 'Warm lit barred doorway at Kota Jail for visitor orientation.', 'center 45%'),
        'cta' => $image('exhibition-room', 'Kota Jail closing exhibition room', 'Kota Jail exhibition room used for the final tour call to action.', 'center 50%'),
        'about_hero' => $image('corridor', 'Kota Jail corridor heritage view', 'Long Kota Jail corridor with barred doors and historic weathered surfaces.', 'center 52%'),
        'start_tour_hero' => $image('qr-wall', 'Kota Jail route starting point', 'Kota Jail wall with QR sign marking a visitor checkpoint and route start.', 'center 48%'),
        'tour_map_hero' => $image('gate', 'Kota Jail tour route gateway', 'Arched barred gateway inside Kota Jail used as the tour-map hero image.', 'center 45%'),
        'locations_hero' => $image('corridor', 'Kota Jail route corridor', 'Atmospheric Kota Jail corridor representing the stop-by-stop route.', 'center 50%'),
        'events_hero' => $image('exhibition-room', 'Kota Jail programme room', 'Kota Jail exhibition room showing current interpretive reuse.', 'center 50%'),
        'gallery_hero' => $image('exhibition-room', 'Kota Jail visual archive room', 'Kota Jail exhibition room for visual archive and gallery browsing.', 'center 50%'),
        'visitor_hero' => $image('gate', 'Kota Jail visitor information gateway', 'Barred doorway and warm light at Kota Jail for visitor information.', 'center 45%'),
        'plan_visit_hero' => $image('qr-wall', 'Kota Jail planning and QR wall', 'Kota Jail exterior QR wall used for planning the self-guided visit.', 'center 48%'),
        'contact_hero' => $image('gate', 'Kota Jail contact gateway', 'Kota Jail arched gate used for the contact page hero.', 'center 45%'),
        'about_exterior' => $image('qr-wall', 'Kota Jail weathered exterior wall', 'Weathered Kota Jail exterior wall with signage and visitor route detail.', 'center 48%'),
        'about_culture' => $image('exhibition-room', 'Kota Jail exhibition culture room', 'Kota Jail exhibition room showing adaptive reuse and interpretive display.', 'center 50%'),
        'about_before' => $image('corridor', 'Kota Jail former corridor memory', 'Historic-feeling Kota Jail corridor with aged surfaces and cell doors.', 'center 50%'),
        'about_after' => $image('justice-display', 'Kota Jail current interpretation display', 'Current Kota Jail interpretive display beside a former cell door.', 'center 45%'),
        'about_timeline' => $image('corridor', 'Kota Jail timeline corridor', 'Kota Jail corridor used to support the historical timeline.', 'center 50%'),
        'about_values' => $image('gate', 'Kota Jail grille and doorway detail', 'Metal grille and arched doorway detail inside Kota Jail.', 'center 45%'),
        'error_404' => $image('corridor', 'Kota Jail corridor background', 'Kota Jail corridor background for the not-found page.', 'center 52%'),
        'error_500' => $image('gate', 'Kota Jail barred doorway background', 'Kota Jail barred doorway background for the error page.', 'center 45%'),
    ],

    'stops' => [
        'main-entrance' => $image('qr-wall', 'Start point QR checkpoint', 'Kota Jail exterior QR signage where visitors can begin the self-guided route.', 'center 48%'),
        'administration-building' => $image('gate', 'Administrative threshold', 'Kota Jail arched barred doorway representing official movement through the former site.', 'center 45%'),
        'former-prison-corridor' => $image('corridor', 'Former prison corridor', 'Long Kota Jail corridor with cell doors, graffiti, and a central stair.', 'center 50%'),
        'former-cell' => $image('corridor', 'Former cell block', 'Former Kota Jail cell corridor with barred doors and aged plaster walls.', 'center 50%'),
        'central-courtyard' => $image('qr-wall', 'Courtyard and QR route edge', 'Weathered Kota Jail wall and walkway near a QR checkpoint.', 'center 48%'),
        'historical-exhibition' => $image('justice-display', 'Historical justice display', 'Kota Jail display explaining the criminal justice system near an old cell door.', 'center 45%'),
        'art-gallery' => $image('exhibition-room', 'Exhibition and gallery room', 'Kota Jail exhibition room with preserved objects and aged interior surfaces.', 'center 50%'),
        'cultural-space' => $image('exhibition-room', 'Adaptive reuse room', 'Kota Jail interior room showing an interpretive display and cultural reuse potential.', 'center 50%'),
        'heritage-architecture-zone' => $image('gate', 'Architectural gate detail', 'Kota Jail arched doorway and metal grille for architecture observation.', 'center 45%'),
        'final-reflection-area' => $image('justice-display', 'Final memory point', 'Kota Jail interpretive wall and cell door used for the closing reflection stop.', 'center 45%'),
    ],

    'events' => [
        'heritage-night-walk' => $image('gate', 'Route after dark mood study', 'Warm lit Kota Jail barred doorway with atmospheric interior light.', 'center 45%'),
        'creative-reuse-exhibition' => $image('exhibition-room', 'Creative reuse exhibition', 'Kota Jail exhibition room with interpretive objects and heritage surfaces.', 'center 50%'),
        'architecture-sketch-session' => $image('corridor', 'Architecture observation corridor', 'Kota Jail corridor with repeated arches and metal cell doors for architecture study.', 'center 50%'),
        'community-culture-market' => $image('qr-wall', 'Visitor route wall', 'Kota Jail exterior wall and walkway used for visitor programme orientation.', 'center 48%'),
        'past-art-open-studio' => $image('exhibition-room', 'Archive exhibition room', 'Kota Jail interior display used as a visual archive reference.', 'center 50%'),
    ],

    'gallery' => [
        1 => $image('corridor', 'Corridor Memory', 'Atmospheric Kota Jail corridor with barred cells, a stair, and aged wall surfaces.', 'center 50%') + [
            'id' => 1,
            'category' => 'Historical Photographs',
            'caption' => 'A corridor view for reading circulation, confinement, material age, and historical memory.',
        ],
        2 => $image('gate', 'Barred Gateway', 'Tall arched doorway and metal grille inside Kota Jail.', 'center 45%') + [
            'id' => 2,
            'category' => 'Architecture',
            'caption' => 'A strong architectural threshold showing metalwork, scale, and filtered light.',
        ],
        3 => $image('justice-display', 'Justice Display', 'Criminal justice system display beside a former Kota Jail cell door.', 'center 45%') + [
            'id' => 3,
            'category' => 'Exhibitions',
            'caption' => 'Interpretive signage connects the former site to civic and historical learning.',
        ],
        4 => $image('exhibition-room', 'Preserved Room Display', 'Kota Jail exhibition room with preserved objects and marked historical surfaces.', 'center 50%') + [
            'id' => 4,
            'category' => 'Visual Archives',
            'caption' => 'A room-scale display for understanding preservation, memory, and careful interpretation.',
        ],
        5 => $image('qr-wall', 'QR Checkpoint Wall', 'Weathered Kota Jail exterior wall with a QR sign and route-side plants.', 'center 48%') + [
            'id' => 5,
            'category' => 'Visitor Experiences',
            'caption' => 'A QR checkpoint image showing how visitors can connect physical signage with the digital guide.',
        ],
        6 => $image('corridor', 'Cell Door Rhythm', 'Kota Jail corridor emphasizing repeated barred openings and worn textures.', 'center 48%') + [
            'id' => 6,
            'category' => 'Architecture',
            'caption' => 'Repeated doors and openings make the corridor legible as a historical route.',
        ],
        7 => $image('gate', 'Light Through Grille', 'Warm light above a barred Kota Jail doorway.', 'center 40%') + [
            'id' => 7,
            'category' => 'Heritage Details',
            'caption' => 'Light and grillework create a strong sense of place without adding theatrical effects.',
        ],
        8 => $image('justice-display', 'Cell Door Number', 'Kota Jail cell door and interpretive display with number marking.', 'center 52%') + [
            'id' => 8,
            'category' => 'Historical Photographs',
            'caption' => 'Numbering, paint layers, and signage help visitors notice small historical traces.',
        ],
        9 => $image('exhibition-room', 'Object Display', 'Preserved object display inside a weathered Kota Jail room.', 'center 52%') + [
            'id' => 9,
            'category' => 'Exhibitions',
            'caption' => 'Object displays should be read with care and official interpretive context.',
        ],
        10 => $image('qr-wall', 'Outdoor Route Texture', 'Kota Jail exterior wall with peeling paint, plants, and visitor route signage.', 'center 48%') + [
            'id' => 10,
            'category' => 'Visitor Experiences',
            'caption' => 'The exterior route carries both practical visitor guidance and the texture of the old site.',
        ],
        11 => $image('corridor', 'Long View', 'Wide Kota Jail corridor with central stair and cell doors.', 'center 50%') + [
            'id' => 11,
            'category' => 'Visual Archives',
            'caption' => 'A long interior view anchors the tour in the physical experience of moving through the building.',
        ],
        12 => $image('gate', 'Threshold Detail', 'Arched threshold and metal grille inside Kota Jail.', 'center 48%') + [
            'id' => 12,
            'category' => 'Heritage Details',
            'caption' => 'A final threshold detail for visitors to compare with what they saw on the route.',
        ],
    ],
];
