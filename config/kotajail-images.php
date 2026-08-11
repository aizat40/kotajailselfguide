<?php

$credit = 'Image by Self-Guide Kota Jail Team';
$sourceName = 'Self-Guide Kota Jail Team';

$photos = [
    'corridor' => [
        'image' => 'img_update/gambar1.jpg',
        'alt' => 'Historic corridor inside Kota Jail at Ayer Molek with barred cell doors, aged plaster walls, and a central stair.',
        'position' => 'center 50%',
        'width' => 1080,
        'height' => 720,
    ],
    'gate' => [
        'image' => 'img_update/gambar2.jpg',
        'alt' => 'Original arched doorway at Kota Jail with black metal grillework and warm light across the old threshold.',
        'position' => 'center 46%',
        'width' => 607,
        'height' => 1080,
    ],
    'justice-display' => [
        'image' => 'img_update/gambar3.jpg',
        'alt' => 'Educational display inside Kota Jail explaining the criminal justice system beside a preserved former cell door.',
        'position' => 'center 46%',
        'width' => 607,
        'height' => 1080,
    ],
    'exhibition-room' => [
        'image' => 'img_update/gambar4.jpg',
        'alt' => 'Preserved exhibition room at Kota Jail with weathered walls, historical objects, and interpretive displays.',
        'position' => 'center 50%',
        'width' => 1080,
        'height' => 607,
    ],
    'qr-wall' => [
        'image' => 'img_update/gambar5.jpg',
        'alt' => 'Weathered exterior wall at Kota Jail with visitor QR signage and plants along the Ayer Molek walking route.',
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
        'photographer' => 'Self-Guide Kota Jail Team',
        'position' => $position ?? $photos[$key]['position'],
        'width' => $photos[$key]['width'],
        'height' => $photos[$key]['height'],
    ];
};

return [
    'sections' => [
        'hero' => $image('corridor', 'Kota Jail corridor hero', 'Long historic corridor inside Kota Jail, Ayer Molek, showing barred cell doors, weathered walls, and the building passage visitors encounter on the route.', 'center 52%'),
        'home_intro' => $image('gate', 'Kota Jail barred doorway', 'Arched barred doorway inside Kota Jail, showing the original threshold and metal grillework of the former Ayer Molek prison site.', 'center 45%'),
        'home_features' => $image('qr-wall', 'Kota Jail QR checkpoint wall', 'Weathered Kota Jail exterior wall with QR signage, showing how visitors connect the physical route with the digital guide.', 'center 48%'),
        'home_timeline' => $image('justice-display', 'Kota Jail justice display', 'Educational justice-system display inside Kota Jail, placed beside preserved cell-door details from the old prison setting.', 'center 45%'),
        'home_visit' => $image('gate', 'Kota Jail visitor doorway', 'Warmly lit barred doorway at Kota Jail, marking a strong visitor threshold within the Ayer Molek heritage route.', 'center 45%'),
        'cta' => $image('exhibition-room', 'Kota Jail closing exhibition room', 'Preserved exhibition room at Kota Jail with aged walls and interpretive displays, used as a quiet closing image for the route.', 'center 50%'),
        'about_hero' => $image('corridor', 'Kota Jail corridor heritage view', 'Long Kota Jail corridor with barred doors and worn interior surfaces that communicate the building history of the Ayer Molek site.', 'center 52%'),
        'start_tour_hero' => $image('qr-wall', 'Kota Jail route starting point', 'Exterior QR checkpoint wall at Kota Jail where visitors can begin the Ayer Molek self-guided route.', 'center 48%'),
        'tour_map_hero' => $image('gate', 'Kota Jail tour route gateway', 'Arched barred gateway inside Kota Jail, representing the transition from orientation into the self-guided route.', 'center 45%'),
        'locations_hero' => $image('corridor', 'Kota Jail route corridor', 'Historic Kota Jail corridor used to introduce the stop-by-stop route through the old Ayer Molek prison grounds.', 'center 50%'),
        'gallery_hero' => $image('exhibition-room', 'Kota Jail visual archive room', 'Preserved room inside Kota Jail with exhibition displays, weathered walls, and historical objects for visual archive browsing.', 'center 50%'),
        'visitor_hero' => $image('gate', 'Kota Jail visitor information gateway', 'Barred doorway and warm interior light at Kota Jail, used to introduce practical visitor information.', 'center 45%'),
        'plan_visit_hero' => $image('qr-wall', 'Kota Jail planning and QR wall', 'Weathered Kota Jail route wall with QR signage, helping visitors plan their self-guided walk through Ayer Molek.', 'center 48%'),
        'contact_hero' => $image('gate', 'Kota Jail contact gateway', 'Arched metal gate inside Kota Jail, used as a welcoming contact-page image for the Ayer Molek site.', 'center 45%'),
        'about_exterior' => $image('qr-wall', 'Kota Jail weathered exterior wall', 'Original peeling exterior wall at Kota Jail showing age, route signage, and public access along the heritage walkway.', 'center 48%'),
        'about_culture' => $image('exhibition-room', 'Kota Jail exhibition culture room', 'Preserved Kota Jail room adapted for interpretation, with historical objects and marked wall surfaces visible.', 'center 50%'),
        'about_before' => $image('corridor', 'Kota Jail former corridor memory', 'Interior corridor at Kota Jail showing barred cells, older surfaces, and the memory of the former prison layout.', 'center 50%'),
        'about_after' => $image('justice-display', 'Kota Jail current interpretation display', 'Current interpretive display inside Kota Jail beside a preserved cell door, showing education layered into the old building.', 'center 45%'),
        'about_timeline' => $image('corridor', 'Kota Jail timeline corridor', 'Kota Jail corridor with repeated cell openings, used to support the historical timeline of the Ayer Molek site.', 'center 50%'),
        'about_values' => $image('gate', 'Kota Jail grille and doorway detail', 'Metal grillework and arched doorway inside Kota Jail, highlighting preserved architectural details.', 'center 45%'),
        'error_404' => $image('corridor', 'Kota Jail corridor background', 'Historic Kota Jail corridor background with barred cells and aged interior surfaces.', 'center 52%'),
        'error_500' => $image('gate', 'Kota Jail barred doorway background', 'Kota Jail arched barred doorway background showing preserved grillework and old interior light.', 'center 45%'),
    ],

    'stops' => [
        'main-entrance' => $image('qr-wall', 'Start point QR checkpoint', 'Weathered Kota Jail wall with QR signage marking the start of the self-guided route at Ayer Molek.', 'center 48%'),
        'administration-building' => $image('gate', 'Administrative threshold', 'Arched barred doorway at Kota Jail showing a controlled threshold within the former institutional building.', 'center 45%'),
        'former-prison-corridor' => $image('corridor', 'Former prison corridor', 'Long corridor inside Kota Jail with barred cell doors, worn walls, and a central stair showing the old circulation route.', 'center 50%'),
        'former-cell' => $image('corridor', 'Former cell block', 'Former Kota Jail cell block with open barred doors and aged plaster walls preserved inside the Ayer Molek site.', 'center 50%'),
        'central-courtyard' => $image('qr-wall', 'Courtyard and QR route edge', 'Outdoor route edge at Kota Jail with peeling heritage walls, plants, and QR guidance for visitors.', 'center 48%'),
        'historical-exhibition' => $image('justice-display', 'Historical justice display', 'Interpretive justice-system panel inside Kota Jail beside an old numbered cell door.', 'center 45%'),
        'art-gallery' => $image('exhibition-room', 'Exhibition and gallery room', 'Preserved room inside Kota Jail with historical objects, display furniture, and worn wall textures.', 'center 50%'),
        'cultural-space' => $image('exhibition-room', 'Adaptive reuse room', 'Kota Jail interior display room showing how the former prison setting can support careful cultural interpretation.', 'center 50%'),
        'heritage-architecture-zone' => $image('gate', 'Architectural gate detail', 'Arched doorway and black metal grille inside Kota Jail, showing original architectural form and controlled access.', 'center 45%'),
        'final-reflection-area' => $image('justice-display', 'Final memory point', 'Kota Jail interpretive display and preserved cell door, providing a quiet final point for reflection.', 'center 45%'),
    ],

    'gallery' => [
        1 => $image('corridor', 'Corridor Memory', 'Atmospheric Kota Jail corridor with barred cells, a stair, and aged wall surfaces.', 'center 50%') + [
            'id' => 1,
            'category' => 'Historical Photographs',
            'caption' => 'Historic Kota Jail corridor showing barred cell doors, worn plaster, and the controlled movement of the former Ayer Molek prison layout.',
        ],
        2 => $image('gate', 'Barred Gateway', 'Tall arched doorway and metal grille inside Kota Jail.', 'center 45%') + [
            'id' => 2,
            'category' => 'Architecture',
            'caption' => 'Original arched threshold with metal grillework, showing how light, scale, and enclosure shape the visitor experience.',
        ],
        3 => $image('justice-display', 'Justice Display', 'Criminal justice system display beside a former Kota Jail cell door.', 'center 45%') + [
            'id' => 3,
            'category' => 'Exhibitions',
            'caption' => 'Educational display beside a preserved cell door, connecting the former prison site with justice-system interpretation.',
        ],
        4 => $image('exhibition-room', 'Preserved Room Display', 'Kota Jail exhibition room with preserved objects and marked historical surfaces.', 'center 50%') + [
            'id' => 4,
            'category' => 'Visual Archives',
            'caption' => 'Preserved exhibition room where historical objects and aged wall surfaces support careful interpretation of the site.',
        ],
        5 => $image('qr-wall', 'QR Checkpoint Wall', 'Weathered Kota Jail exterior wall with a QR sign and route-side plants.', 'center 48%') + [
            'id' => 5,
            'category' => 'Visitor Experiences',
            'caption' => 'Visitor QR checkpoint on a weathered Kota Jail wall, linking the physical route to the self-guided digital experience.',
        ],
        6 => $image('corridor', 'Cell Door Rhythm', 'Kota Jail corridor emphasizing repeated barred openings and worn textures.', 'center 48%') + [
            'id' => 6,
            'category' => 'Architecture',
            'caption' => 'Repeated barred openings and worn wall surfaces reveal the rhythm of the former cell corridor.',
        ],
        7 => $image('gate', 'Light Through Grille', 'Warm light above a barred Kota Jail doorway.', 'center 40%') + [
            'id' => 7,
            'category' => 'Heritage Details',
            'caption' => 'Warm light passing through the old grillework highlights the preserved threshold and its architectural weight.',
        ],
        8 => $image('justice-display', 'Cell Door Number', 'Kota Jail cell door and interpretive display with number marking.', 'center 52%') + [
            'id' => 8,
            'category' => 'Historical Photographs',
            'caption' => 'Cell numbering, layered paint, and interpretive signage help visitors notice the details left in the building fabric.',
        ],
        9 => $image('exhibition-room', 'Object Display', 'Preserved object display inside a weathered Kota Jail room.', 'center 52%') + [
            'id' => 9,
            'category' => 'Exhibitions',
            'caption' => 'Historical objects inside a preserved room invite visitors to connect material traces with the wider Kota Jail story.',
        ],
        10 => $image('qr-wall', 'Outdoor Route Texture', 'Kota Jail exterior wall with peeling paint, plants, and visitor route signage.', 'center 48%') + [
            'id' => 10,
            'category' => 'Visitor Experiences',
            'caption' => 'Peeling exterior walls, route signage, and plants show how the old prison grounds now support public movement.',
        ],
        11 => $image('corridor', 'Long View', 'Wide Kota Jail corridor with central stair and cell doors.', 'center 50%') + [
            'id' => 11,
            'category' => 'Visual Archives',
            'caption' => 'A long interior view anchors the tour in the physical experience of walking through the former prison corridor.',
        ],
        12 => $image('gate', 'Threshold Detail', 'Arched threshold and metal grille inside Kota Jail.', 'center 48%') + [
            'id' => 12,
            'category' => 'Heritage Details',
            'caption' => 'A final doorway detail for comparing the route thresholds, grillework, and preserved interior character.',
        ],
    ],
];
