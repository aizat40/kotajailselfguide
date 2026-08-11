@extends('layouts.app')

@php
    $sectionImages = $images['sections'];
    $partners = config('kotajail.partners');
@endphp

@section('content')
    <section class="hero-shell relative flex min-h-screen items-center overflow-hidden bg-deep-charcoal pt-28 text-paper-white">
        <img
            src="{{ asset($site['image']) }}"
            alt="{{ $site['alt'] }}"
            class="absolute inset-0 h-full w-full object-cover"
            style="object-position: {{ $site['image_position'] ?? 'center' }};"
            width="{{ $site['image_width'] }}"
            height="{{ $site['image_height'] }}"
            loading="eager"
            fetchpriority="high"
        >
        <div class="absolute inset-0 bg-gradient-to-br from-jail-black/98 via-deep-charcoal/82 to-brick/70"></div>
        <div class="bar-pattern absolute inset-0 opacity-30"></div>
        <div class="relative mx-auto grid w-full max-w-7xl gap-10 px-4 pb-20 pt-20 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
            <div class="max-w-4xl">
                <p class="section-label text-muted-gold">{{ $site['tagline'] }}</p>
                <h1 class="mt-5 font-serif text-5xl font-bold leading-none sm:text-7xl lg:text-8xl">Self-Guide Kota Jail</h1>
                <p class="mt-5 max-w-2xl text-2xl font-black leading-tight text-paper-white sm:text-3xl">Explore the stories behind the walls at Ayer Molek.</p>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-concrete">{{ $site['purpose'] }}</p>
                <div class="mt-8 flex max-w-xl items-center gap-4 rounded-3xl border border-paper-white/15 bg-paper-white/10 p-4 backdrop-blur">
                    <img
                        src="{{ asset($sectionImages['home_features']['image']) }}"
                        alt="Weathered Kota Jail wall with QR visitor signage at Ayer Molek"
                        class="h-14 w-14 shrink-0 rounded-full object-cover"
                        style="object-position: {{ $sectionImages['home_features']['position'] }};"
                        width="{{ $sectionImages['home_features']['width'] }}"
                        height="{{ $sectionImages['home_features']['height'] }}"
                    >
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-muted-gold">Photo and guide credits</p>
                        <p class="mt-1 font-semibold text-paper-white">By {{ $site['credit_name'] }} with {{ $site['collaboration'] }}</p>
                    </div>
                </div>
            </div>

            <aside class="self-end rounded-3xl border border-paper-white/15 bg-deep-charcoal/55 p-5 shadow-2xl backdrop-blur">
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl bg-paper-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Opening hours</p>
                        <p class="mt-2 font-semibold">{{ $site['hours'] }}</p>
                    </div>
                    <div class="rounded-2xl bg-paper-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Location</p>
                        <p class="mt-2 font-semibold">Ayer Molek, Johor Bahru</p>
                    </div>
                    <div class="rounded-2xl bg-paper-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Max duration</p>
                        <p class="mt-2 font-semibold">{{ $site['max_duration'] }}</p>
                    </div>
                    <div class="rounded-2xl bg-paper-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Year opened</p>
                        <p class="mt-2 font-semibold">{{ $site['established'] }}</p>
                    </div>
                </div>
                <x-image-credit :credit="$site['image_credit']" :source="$site['image_source_url']" compact class="mt-4 text-concrete/75" />
            </aside>
        </div>
        <a href="#intro" class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 flex-col items-center gap-2 text-xs font-bold uppercase tracking-[0.24em] text-concrete md:flex">
            <span>Scroll</span>
            <span class="h-10 w-px bg-muted-gold"></span>
        </a>
    </section>

    <section class="bg-jail-black py-10 text-paper-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-5 lg:grid-cols-[0.75fr_1.25fr] lg:items-center">
                <div>
                    <p class="section-label text-muted-gold">In Collaboration With / Bersama Dengan</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold sm:text-4xl">Partners behind the self-guided experience.</h2>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($partners as $partner)
                        <article class="min-h-40 rounded-3xl border border-paper-white/15 bg-paper-white/5 p-5 shadow-sm">
                            <p class="text-[0.68rem] font-black uppercase tracking-[0.22em] text-muted-gold">{{ $partner['label'] }}</p>
                            <p class="mt-4 font-serif text-2xl font-bold leading-tight text-paper-white">{{ $partner['name'] }}</p>
                            <p class="mt-3 text-sm leading-6 text-concrete">{{ $partner['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="intro" class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:gap-14 lg:px-8">
            <div class="relative lg:pb-10 lg:pr-10">
                @php($introImage = $sectionImages['home_intro'])
                <figure class="relative aspect-[4/5] overflow-hidden rounded-[1.75rem] border border-concrete bg-heritage-cream shadow-2xl sm:aspect-[5/4] lg:aspect-[4/5]">
                    <img
                        src="{{ asset($introImage['image']) }}"
                        alt="{{ $introImage['alt'] }}"
                        class="section-image"
                        style="object-position: {{ $introImage['position'] }};"
                        width="{{ $introImage['width'] }}"
                        height="{{ $introImage['height'] }}"
                        loading="lazy"
                    >
                </figure>
                <x-image-credit :credit="$introImage['credit']" :source="$introImage['source_url']" compact class="mt-3 lg:pr-80" />
                <div class="mt-5 rounded-3xl border border-concrete bg-heritage-cream p-5 shadow-sm lg:absolute lg:bottom-0 lg:right-0 lg:mt-0 lg:w-80">
                    <p class="text-sm uppercase tracking-[0.2em] text-rust">Public reference</p>
                    <div class="mt-3 flex items-end gap-4">
                        <p class="font-serif text-5xl font-bold leading-none text-deep-charcoal sm:text-6xl">{{ $site['established'] }}</p>
                        <p class="pb-1 text-sm font-semibold leading-6 text-charcoal/70">Johor Bahru, Johor</p>
                    </div>
                    <p class="mt-4 border-t border-concrete pt-4 text-sm leading-6 text-charcoal/70">Former Ayer Molek Prison site, now interpreted through heritage, architecture, art, and culture.</p>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <x-section-heading
                    eyebrow="Historical orientation"
                    title="A former prison site being reintroduced through heritage, art, and culture."
                    lead="Kota Jail is associated with the former Ayer Molek Prison at Ayer Molek, Johor Bahru. This digital guide exists so visitors can walk independently, scan checkpoint QR codes, understand where they are, and read in-depth historical and navigational context."
                />
                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="border-l-2 border-rust pl-4">
                        <p class="font-bold text-deep-charcoal">Art</p>
                        <p class="mt-2 text-sm leading-6 text-charcoal/70">Current exhibitions and creative reuse.</p>
                    </div>
                    <div class="border-l-2 border-muted-gold pl-4">
                        <p class="font-bold text-deep-charcoal">Heritage</p>
                        <p class="mt-2 text-sm leading-6 text-charcoal/70">Architecture, memory, and conservation.</p>
                    </div>
                    <div class="border-l-2 border-brick pl-4">
                        <p class="font-bold text-deep-charcoal">Culture</p>
                        <p class="mt-2 text-sm leading-6 text-charcoal/70">Community events and public life.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[1fr_420px]">
                <x-section-heading
                    eyebrow="Tour tools"
                    title="Designed for a phone in hand and a careful pace."
                    lead="Every core interaction works without accounts or a database, using static content and browser local storage."
                />
                @php($featureImage = $sectionImages['home_features'])
                <figure class="overflow-hidden rounded-3xl border border-concrete bg-paper-white shadow-sm">
                    <img
                        src="{{ asset($featureImage['image']) }}"
                        alt="{{ $featureImage['alt'] }}"
                        class="section-image aspect-[16/9]"
                        style="object-position: {{ $featureImage['position'] }};"
                        width="{{ $featureImage['width'] }}"
                        height="{{ $featureImage['height'] }}"
                        loading="lazy"
                    >
                    <figcaption class="px-4 pb-4 pt-3">
                        <x-image-credit :credit="$featureImage['credit']" :source="$featureImage['source_url']" compact />
                    </figcaption>
                </figure>
            </div>
            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach (config('kotajail.features') as $feature)
                    <x-info-card :icon="$feature['icon']" :title="$feature['title']" :text="$feature['description']" class="border-concrete bg-paper-white hover:border-muted-gold" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div>
                <x-section-heading
                    eyebrow="Historical timeline"
                    title="A careful timeline with editable interpretation."
                    lead="Only broad, general entries are included where verified detail is not available. Add sourced interpretation here when approved."
                />
                @php($timelineImage = $sectionImages['home_timeline'])
                <figure class="mt-8 overflow-hidden rounded-3xl border border-concrete bg-paper-white shadow-sm">
                    <img
                        src="{{ asset($timelineImage['image']) }}"
                        alt="{{ $timelineImage['alt'] }}"
                        class="section-image aspect-[16/10]"
                        style="object-position: {{ $timelineImage['position'] }};"
                        width="{{ $timelineImage['width'] }}"
                        height="{{ $timelineImage['height'] }}"
                        loading="lazy"
                    >
                    <figcaption class="px-4 pb-4 pt-3">
                        <x-image-credit :credit="$timelineImage['credit']" :source="$timelineImage['source_url']" compact />
                    </figcaption>
                </figure>
            </div>
            <div class="rounded-3xl bg-paper-white p-6 shadow-sm">
                @foreach ($timeline as $item)
                    <x-timeline-item :item="$item" :last="$loop->last" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-[1fr_1.2fr] lg:px-8">
            <div>
                <x-section-heading
                    eyebrow="Plan your visit"
                    title="Practical details before you arrive."
                    lead="Opening hours and contact details are based on public Kota Jail information. Facilities and access details are marked for official verification."
                />
                @php($visitImage = $sectionImages['home_visit'])
                <figure class="mt-8 overflow-hidden rounded-3xl border border-concrete bg-paper-white shadow-sm">
                    <img
                        src="{{ asset($visitImage['image']) }}"
                        alt="{{ $visitImage['alt'] }}"
                        class="section-image aspect-[16/10]"
                        style="object-position: {{ $visitImage['position'] }};"
                        width="{{ $visitImage['width'] }}"
                        height="{{ $visitImage['height'] }}"
                        loading="lazy"
                    >
                    <figcaption class="px-4 pb-4 pt-3">
                        <x-image-credit :credit="$visitImage['credit']" :source="$visitImage['source_url']" compact />
                    </figcaption>
                </figure>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['icon' => 'clock', 'title' => 'Opening hours', 'text' => $site['hours']],
                    ['icon' => 'pin', 'title' => 'Address', 'text' => $site['address']],
                    ['icon' => 'map', 'title' => 'Parking', 'text' => config('kotajail.visitor_info.parking')],
                    ['icon' => 'accessibility', 'title' => 'Accessibility', 'text' => config('kotajail.visitor_info.accessibility')],
                ] as $info)
                    <x-info-card :icon="$info['icon']" :title="$info['title']" :text="$info['text']" class="border-concrete bg-paper-white" />
                @endforeach
                <div class="sm:col-span-2">
                    <x-button :href="route('visitor.info')" variant="dark" icon="arrow-right">View Visitor Information</x-button>
                </div>
            </div>
        </div>
    </section>

@endsection
