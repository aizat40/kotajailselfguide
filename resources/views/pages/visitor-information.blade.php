@extends('layouts.app')

@php($heroImage = $images['sections']['visitor_hero'])

@section('content')
    <x-page-hero
        eyebrow="Visitor information"
        title="Everything to check before walking Kota Jail."
        lead="Opening hours and contact details are shown with practical visitor guidance. Items that need official confirmation are clearly marked in the content."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div class="rounded-3xl bg-deep-charcoal p-6 text-paper-white">
                <p class="section-label text-muted-gold">Location</p>
                <h2 class="mt-3 font-serif text-4xl font-semibold">Kota Jail, Johor Bahru</h2>
                <p class="mt-4 text-sm leading-7 text-concrete">{{ $visitorInfo['address'] }}</p>
                <div class="mt-6 overflow-hidden rounded-3xl border border-white/10 bg-stone-200 shadow-2xl shadow-black/20">
                    <div class="relative aspect-[4/3] w-full overflow-hidden">
                        <iframe
                            src="{{ config('kotajail.visitor_info.google_maps_embed_url') }}"
                            class="absolute inset-0 h-full w-full"
                            style="border: 0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Google Maps location of Kota Jail Johor Bahru">
                        </iframe>
                    </div>
                </div>
                <div class="mt-6 grid gap-3">
                    <x-button :href="route('tour.map')" variant="primary" icon="map">Open Tour Map</x-button>
                    <x-button :href="route('contact')" variant="secondary" icon="mail">Contact Page</x-button>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['icon' => 'clock', 'title' => 'Opening hours', 'text' => $visitorInfo['opening_hours']],
                    ['icon' => 'pin', 'title' => 'Address', 'text' => $visitorInfo['address']],
                    ['icon' => 'map', 'title' => 'Directions', 'text' => $visitorInfo['public_transport']],
                    ['icon' => 'map', 'title' => 'Parking', 'text' => $visitorInfo['parking']],
                    ['icon' => 'check-circle', 'title' => 'Admission', 'text' => $visitorInfo['admission']],
                    ['icon' => 'accessibility', 'title' => 'Accessibility', 'text' => $visitorInfo['accessibility']],
                ] as $item)
                    <x-info-card :icon="$item['icon']" :title="$item['title']" :text="$item['text']" class="border-concrete bg-heritage-cream" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-section-heading
                eyebrow="Facilities and guidance"
                title="Plan for comfort, safety, and respect."
                lead="These cards cover visitor needs while making verification status clear."
            />
            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach ([
                    ['icon' => 'check-circle', 'title' => 'Toilets', 'text' => $visitorInfo['toilets']],
                    ['icon' => 'check-circle', 'title' => 'Prayer room', 'text' => $visitorInfo['prayer_room']],
                    ['icon' => 'check-circle', 'title' => 'Food and beverage', 'text' => $visitorInfo['food']],
                    ['icon' => 'check-circle', 'title' => 'Rest areas', 'text' => $visitorInfo['rest_areas']],
                    ['icon' => 'camera', 'title' => 'Photography', 'text' => $visitorInfo['photography']],
                    ['icon' => 'alert', 'title' => 'Safety', 'text' => $visitorInfo['safety']],
                    ['icon' => 'alert', 'title' => 'Restricted areas', 'text' => 'Follow all barriers, locked gates, event setup limits, and staff instructions.'],
                    ['icon' => 'alert', 'title' => 'Weather', 'text' => $visitorInfo['weather']],
                    ['icon' => 'languages', 'title' => 'Group visits', 'text' => $visitorInfo['groups']],
                    ['icon' => 'phone', 'title' => 'Emergency contact', 'text' => $visitorInfo['emergency']],
                ] as $item)
                    <x-info-card :icon="$item['icon']" :title="$item['title']" :text="$item['text']" class="border-concrete bg-paper-white" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
            <x-section-heading
                eyebrow="Frequently asked questions"
                title="Quick answers before the walk."
                lead="The FAQ uses keyboard-accessible accordion controls and can be edited in the static config file."
            />
            <div class="space-y-3" data-accordion-group>
                @foreach ($faqs as $faq)
                    <article class="rounded-2xl border border-concrete bg-heritage-cream">
                        <button type="button" class="flex w-full items-center justify-between gap-4 p-5 text-left font-serif text-xl font-semibold text-deep-charcoal focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-accordion-trigger aria-expanded="false">
                            <span>{{ $faq['question'] }}</span>
                            <x-icon name="arrow-right" class="h-5 w-5 transition" />
                        </button>
                        <div class="hidden px-5 pb-5 text-sm leading-7 text-charcoal/75" data-accordion-panel>
                            {{ $faq['answer'] }}
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
