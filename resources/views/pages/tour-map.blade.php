@extends('layouts.app')

@php($heroImage = $images['sections']['tour_map_hero'])

@section('content')
    <x-page-hero
        eyebrow="Tour map"
        title="Find each stop and move through the route at your own pace."
        lead="The map is a styled static guide with sample markers. Use the list view when you prefer text navigation or need a simpler accessible alternative."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white" data-map-page>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1fr_340px]">
                <div class="rounded-3xl border border-concrete bg-heritage-cream p-4 shadow-sm">
                    <div class="flex flex-wrap items-center justify-between gap-3 p-2">
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="toggle-chip is-active" data-map-toggle="map">Map</button>
                            <button type="button" class="toggle-chip" data-map-toggle="list">List</button>
                        </div>
                        <div class="grid w-full gap-2 sm:w-auto sm:grid-cols-2">
                            <label class="sr-only" for="map-category">Category filter</label>
                            <select id="map-category" class="field-input w-full sm:min-w-40" data-map-category>
                                <option value="all">All categories</option>
                                @foreach (collect($stops)->pluck('category')->unique()->values() as $category)
                                    <option value="{{ strtolower($category) }}">{{ $category }}</option>
                                @endforeach
                            </select>
                            <label class="sr-only" for="map-route">Route filter</label>
                            <select id="map-route" class="field-input w-full sm:min-w-40" data-map-route>
                                <option value="all">All routes</option>
                                @foreach (config('kotajail.tour_routes') as $route)
                                    <option value="{{ $route['slug'] }}">{{ $route['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="map-board min-h-[420px] sm:min-h-[520px]" data-map-canvas>
                        <div class="map-route-line"></div>
                        @foreach ($stops as $stop)
                            <button
                                type="button"
                                class="map-marker"
                                style="left: {{ $stop['coordinates']['x'] }}%; top: {{ $stop['coordinates']['y'] }}%;"
                                data-map-marker
                                data-stop-slug="{{ $stop['slug'] }}"
                                data-stop-category="{{ strtolower($stop['category']) }}"
                                data-stop-routes="{{ implode(' ', $stop['routes']) }}"
                                aria-label="Open {{ $stop['title'] }}"
                            >
                                {{ $stop['number'] }}
                            </button>
                        @endforeach
                    </div>

                    <div class="hidden p-2" data-map-list>
                        <div class="grid gap-4 md:grid-cols-2">
                            @foreach ($stops as $stop)
                                <x-tour-card :stop="$stop" compact />
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4 p-3 text-sm text-charcoal/75">
                        <div class="flex flex-wrap gap-3">
                            <span class="inline-flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-rust"></span> Stop marker</span>
                            <span class="inline-flex items-center gap-2"><span class="h-3 w-8 rounded-full bg-muted-gold"></span> Suggested route</span>
                            <span class="inline-flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-deep-charcoal"></span> Completed</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="inline-flex min-h-10 items-center gap-2 rounded-full border border-concrete bg-paper-white px-4 py-2 font-semibold text-deep-charcoal hover:border-muted-gold" data-current-location>
                                <x-icon name="pin" class="h-4 w-4" /> Current location
                            </button>
                            <button type="button" class="inline-flex min-h-10 items-center gap-2 rounded-full border border-concrete bg-paper-white px-4 py-2 font-semibold text-deep-charcoal hover:border-muted-gold" data-reset-map>
                                Reset map
                            </button>
                        </div>
                    </div>
                </div>

                <aside class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm lg:sticky lg:top-28 lg:self-start" data-stop-panel>
                    <p class="section-label">Selected stop</p>
                    <img
                        src="{{ asset($stops[0]['image']) }}"
                        alt="{{ $stops[0]['alt'] }}"
                        class="section-image mt-4 aspect-[4/3] rounded-2xl"
                        style="object-position: {{ $stops[0]['image_position'] ?? 'center' }};"
                        width="{{ $stops[0]['image_width'] }}"
                        height="{{ $stops[0]['image_height'] }}"
                        data-panel-image
                    >
                    <x-image-credit :credit="$stops[0]['image_credit'] ?? null" :source="$stops[0]['image_source_url'] ?? null" compact class="mt-3" data-panel-credit />
                    <div class="mt-5 flex items-center gap-2">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-rust text-sm font-black text-paper-white" data-panel-number>{{ $stops[0]['number'] }}</span>
                        <x-status-badge :label="$stops[0]['category']" tone="gold" data-panel-category />
                    </div>
                    <h2 class="mt-4 font-serif text-3xl font-semibold text-deep-charcoal" data-panel-title>{{ $stops[0]['title'] }}</h2>
                    <p class="mt-3 text-sm leading-7 text-charcoal/75" data-panel-excerpt>{{ $stops[0]['excerpt'] }}</p>
                    <p class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-heritage-brown"><x-icon name="clock" class="h-4 w-4" /> <span data-panel-duration>{{ $stops[0]['duration'] }}</span></p>
                    <div class="mt-6 grid gap-3">
                        <x-button :href="route('locations.show', $stops[0]['slug'])" variant="dark" icon="arrow-right" data-panel-link>View Stop</x-button>
                        <button type="button" class="mark-complete-btn inline-flex min-h-11 items-center justify-center rounded-full border border-rust/30 px-5 py-3 text-sm font-semibold text-rust hover:bg-rust hover:text-paper-white" data-complete-toggle data-stop-slug="{{ $stops[0]['slug'] }}" data-panel-complete>
                            Mark Completed
                        </button>
                    </div>
                    <div class="mt-6 rounded-2xl bg-heritage-cream p-4">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-rust">Nearby suggestion</p>
                        <p class="mt-2 text-sm leading-6 text-charcoal/75" data-nearby-suggestion>Begin with {{ $stops[0]['title'] }}, then continue to the next incomplete stop.</p>
                    </div>
                </aside>
            </div>
        </div>

        <div class="fixed inset-x-3 bottom-24 z-30 hidden max-h-[52vh] overflow-y-auto rounded-3xl border border-concrete bg-paper-white p-4 shadow-2xl lg:hidden" data-mobile-stop-sheet>
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-rust">Selected stop</p>
                    <h2 class="mt-1 font-serif text-2xl font-semibold text-deep-charcoal" data-mobile-panel-title>{{ $stops[0]['title'] }}</h2>
                </div>
                <button type="button" class="grid h-10 w-10 place-items-center rounded-full border border-concrete" data-close-stop-sheet aria-label="Close stop details"><x-icon name="close" class="h-5 w-5" /></button>
            </div>
            <p class="mt-2 text-sm leading-6 text-charcoal/70" data-mobile-panel-excerpt>{{ $stops[0]['excerpt'] }}</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <x-button :href="route('locations.show', $stops[0]['slug'])" variant="dark" size="sm" data-mobile-panel-link>View Stop</x-button>
                <button type="button" class="mark-complete-btn rounded-full border border-rust/30 px-4 py-2 text-sm font-semibold text-rust" data-complete-toggle data-stop-slug="{{ $stops[0]['slug'] }}" data-mobile-panel-complete>Complete</button>
            </div>
        </div>
    </section>
@endsection
