@extends('layouts.app')

@php
    $detailGallery = $detailGallery ?? array_slice($galleryItems ?? [], 0, 4);
@endphp

@section('content')
    <x-page-hero
        eyebrow="Stop {{ str_pad($stop['number'], 2, '0', STR_PAD_LEFT) }} &middot; {{ $stop['category'] }}"
        :title="$stop['title']"
        :lead="$stop['excerpt']"
        :image="$stop['image']"
        :alt="$stop['alt']"
        :position="$stop['image_position'] ?? 'center'"
        :width="$stop['image_width'] ?? null"
        :height="$stop['image_height'] ?? null"
    >
        <div class="flex flex-wrap gap-3">
            <x-button :href="route('tour.map')" variant="primary" icon="map">Show on Map</x-button>
            <button type="button" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-paper-white/20 bg-paper-white/10 px-5 py-3 text-sm font-semibold text-paper-white hover:bg-paper-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-complete-toggle data-stop-slug="{{ $stop['slug'] }}">
                <x-icon name="check-circle" class="h-4 w-4" />
                Mark as Completed
            </button>
            <button type="button" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-paper-white/20 bg-paper-white/10 px-5 py-3 text-sm font-semibold text-paper-white hover:bg-paper-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-share-link>
                <x-icon name="share" class="h-4 w-4" />
                Share
            </button>
        </div>
    </x-page-hero>

    <section class="bg-paper-white px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumb :items="[
                ['label' => 'Locations', 'url' => route('locations.index')],
                ['label' => $stop['title']],
            ]" />
        </div>
    </section>

    <section class="section-pad bg-paper-white pt-6">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:px-8">
            <article class="min-w-0">
                <div class="grid gap-5 sm:grid-cols-3">
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Visit time</p>
                        <p class="mt-2 text-2xl font-black text-deep-charcoal">{{ $stop['duration'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Reading</p>
                        <p class="mt-2 text-2xl font-black text-deep-charcoal">{{ $stop['reading_time'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Stop number</p>
                        <p class="mt-2 text-2xl font-black text-deep-charcoal">#{{ str_pad($stop['number'], 2, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <div class="prose-content mt-10">
                    <h2>Short introduction</h2>
                    <p>{{ $stop['detail'] }}</p>
                    <h2>Historical context</h2>
                    <p>{{ $stop['context'] }}</p>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-2">
                    <x-info-card icon="alert" title="Original function" class="border-concrete bg-heritage-cream">
                        {{ $stop['original_function'] }}
                    </x-info-card>
                    <x-info-card icon="check-circle" title="Current function" class="border-concrete bg-heritage-cream">
                        {{ $stop['current_function'] }}
                    </x-info-card>
                </div>

                <section class="mt-12">
                    <x-section-heading
                        eyebrow="Architectural features"
                        title="What to notice here."
                        lead="Use these prompts as a visitor-friendly observation checklist. Replace them with verified site-specific notes when available."
                    />
                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        @foreach ($stop['features'] as $feature)
                            <div class="rounded-2xl border border-concrete bg-paper-white p-5 shadow-sm">
                                <x-icon name="check-circle" class="h-6 w-6 text-rust" />
                                <p class="mt-4 font-semibold text-deep-charcoal">{{ $feature }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="mt-12 rounded-3xl bg-deep-charcoal p-6 text-paper-white">
                    <p class="section-label text-muted-gold">Did you know?</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold">{{ $stop['did_you_know'] }}</h2>
                    <ul class="mt-6 grid gap-3 text-sm leading-7 text-concrete">
                        @foreach ($stop['facts'] as $fact)
                            <li class="flex gap-3"><x-icon name="check-circle" class="mt-1 h-5 w-5 shrink-0 text-muted-gold" /> {{ $fact }}</li>
                        @endforeach
                    </ul>
                </section>

                <section class="mt-12">
                    <x-section-heading eyebrow="Image gallery" title="Visual references for this stop." lead="Actual Kota Jail photographs provide context for the route, materials, visitor areas, and present-day cultural reuse." />
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        @foreach ($detailGallery as $item)
                            <figure class="overflow-hidden rounded-2xl border border-concrete bg-paper-white">
                                <img
                                    src="{{ asset($item['image']) }}"
                                    alt="{{ $item['alt'] }}"
                                    class="section-image aspect-[4/3]"
                                    style="object-position: {{ $item['image_position'] ?? 'center' }};"
                                    loading="lazy"
                                    @if (! empty($item['image_width'])) width="{{ $item['image_width'] }}" @endif
                                    @if (! empty($item['image_height'])) height="{{ $item['image_height'] }}" @endif
                                >
                                <figcaption class="p-4 text-sm leading-6 text-charcoal/70">
                                    {{ $item['caption'] }}
                                    <x-image-credit :credit="$item['image_credit'] ?? $item['credit'] ?? null" :source="$item['image_source_url'] ?? $item['source_url'] ?? null" compact class="mt-3" />
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </section>

                <section id="audio-guide-main" class="mt-12">
                    <x-audio-player :audio="$stop['audio']" />
                </section>

                <section class="mt-12 rounded-3xl border border-concrete bg-heritage-cream p-6">
                    <p class="section-label">Accessibility information</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Plan this stop with care.</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">{{ $stop['accessibility'] }}</p>
                </section>

                <nav class="mt-12 grid gap-4 md:grid-cols-2" aria-label="Previous and next stops">
                    @if ($previousStop)
                        <a href="{{ route('locations.show', $previousStop['slug']) }}" class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm hover:border-muted-gold">
                            <span class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-[0.18em] text-rust"><x-icon name="arrow-left" class="h-4 w-4" /> Previous stop</span>
                            <span class="mt-3 block font-serif text-2xl font-semibold text-deep-charcoal">{{ $previousStop['title'] }}</span>
                        </a>
                    @endif
                    @if ($nextStop)
                        <a href="{{ route('locations.show', $nextStop['slug']) }}" class="rounded-3xl border border-concrete bg-paper-white p-5 text-right shadow-sm hover:border-muted-gold md:col-start-2">
                            <span class="inline-flex items-center justify-end gap-2 text-sm font-bold uppercase tracking-[0.18em] text-rust">Next stop <x-icon name="arrow-right" class="h-4 w-4" /></span>
                            <span class="mt-3 block font-serif text-2xl font-semibold text-deep-charcoal">{{ $nextStop['title'] }}</span>
                        </a>
                    @endif
                </nav>
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                <x-progress-card :stops="$stops" />
                <div class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm">
                    <p class="section-label">Tags</p>
                    <img
                        src="{{ asset($stop['image']) }}"
                        alt="{{ $stop['alt'] }}"
                        class="section-image mt-5 aspect-[4/3] rounded-2xl"
                        style="object-position: {{ $stop['image_position'] ?? 'center' }};"
                        loading="lazy"
                        @if (! empty($stop['image_width'])) width="{{ $stop['image_width'] }}" @endif
                        @if (! empty($stop['image_height'])) height="{{ $stop['image_height'] }}" @endif
                    >
                    <x-image-credit :credit="$stop['image_credit'] ?? null" :source="$stop['image_source_url'] ?? null" compact class="mt-3" />
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($stop['tags'] as $tag)
                            <span class="rounded-full bg-heritage-cream px-3 py-1 text-xs font-bold text-heritage-brown">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-6 grid gap-3">
                        <x-button :href="route('tour.map')" variant="dark" icon="map">Show on Map</x-button>
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-full border border-rust/30 px-5 py-3 text-sm font-semibold text-rust hover:bg-rust hover:text-paper-white" data-complete-toggle data-stop-slug="{{ $stop['slug'] }}">
                            Mark as Completed
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <div class="lg:hidden">
        <x-audio-player :audio="$stop['audio']" sticky />
    </div>
@endsection
