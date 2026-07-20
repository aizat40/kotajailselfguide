@extends('layouts.app')

@php
    $sectionImages = $images['sections'];
    $aboutHeroImage = $sectionImages['about_hero'];
@endphp

@section('content')
    <x-page-hero
        eyebrow="About Kota Jail"
        title="A heritage place shaped by history, architecture, art, and community reuse."
        lead="Kota Jail is connected with the former Ayer Molek Prison in Johor Bahru. This page is designed as a respectful public introduction with clear space for verified historical research to be added later."
        :image="$aboutHeroImage['image']"
        :alt="$aboutHeroImage['alt']"
        :position="$aboutHeroImage['position']"
        :width="$aboutHeroImage['width']"
        :height="$aboutHeroImage['height']"
    >
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-paper-white/15 bg-paper-white/10 p-4">
                <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Established</p>
                <p class="mt-2 font-serif text-4xl font-bold">{{ $site['established'] }}</p>
            </div>
            <div class="rounded-2xl border border-paper-white/15 bg-paper-white/10 p-4">
                <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Former use</p>
                <p class="mt-2 font-semibold">Ayer Molek Prison</p>
            </div>
            <div class="rounded-2xl border border-paper-white/15 bg-paper-white/10 p-4">
                <p class="text-xs uppercase tracking-[0.22em] text-muted-gold">Today</p>
                <p class="mt-2 font-semibold">Art, heritage, and culture</p>
            </div>
        </div>
    </x-page-hero>

    <section class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div>
                @php($exteriorImage = $sectionImages['about_exterior'])
                <figure>
                    <img
                        src="{{ asset($exteriorImage['image']) }}"
                        alt="{{ $exteriorImage['alt'] }}"
                        class="section-image aspect-[5/4] rounded-3xl shadow-xl lg:aspect-[4/5]"
                        style="object-position: {{ $exteriorImage['position'] }};"
                        width="{{ $exteriorImage['width'] }}"
                        height="{{ $exteriorImage['height'] }}"
                        loading="lazy"
                    >
                    <x-image-credit :credit="$exteriorImage['credit']" :source="$exteriorImage['source_url']" compact class="mt-3" />
                </figure>
            </div>
            <div class="flex flex-col justify-center">
                <x-section-heading
                    eyebrow="Historical introduction"
                    title="From restricted institution to public cultural destination."
                    lead="The site is publicly associated with the former Ayer Molek Prison and the year 1883. This website avoids invented stories, dates, or named spaces and instead provides an editable structure for approved interpretation."
                />
                <div class="mt-8 grid gap-5 sm:grid-cols-2">
                    <x-info-card icon="alert" title="Respectful history" class="border-concrete bg-heritage-cream">
                        Prison history involves real people and difficult institutional experience. The tour uses a calm, educational tone and avoids treating confinement as entertainment.
                    </x-info-card>
                    <x-info-card icon="check-circle" title="Editable content" class="border-concrete bg-heritage-cream">
                        Detailed building uses, archival captions, conservation notes, and event information can be replaced in one static config file.
                    </x-info-card>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-end gap-8 lg:grid-cols-[1fr_420px]">
                <x-section-heading
                    eyebrow="Present-day identity"
                    title="A site for art, heritage, and culture."
                    lead="The visual and content system balances historic material with contemporary public programming, giving visitors enough context to understand the place without overstating unverified details."
                />
                @php($cultureImage = $sectionImages['about_culture'])
                <figure class="overflow-hidden rounded-3xl border border-concrete bg-paper-white shadow-sm">
                    <img
                        src="{{ asset($cultureImage['image']) }}"
                        alt="{{ $cultureImage['alt'] }}"
                        class="section-image aspect-[16/9]"
                        style="object-position: {{ $cultureImage['position'] }};"
                        width="{{ $cultureImage['width'] }}"
                        height="{{ $cultureImage['height'] }}"
                        loading="lazy"
                    >
                    <figcaption class="px-4 pb-4 pt-3">
                        <x-image-credit :credit="$cultureImage['credit']" :source="$cultureImage['source_url']" compact />
                    </figcaption>
                </figure>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <article class="rounded-3xl bg-paper-white p-7 shadow-sm">
                    <p class="section-label">Art</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Contemporary expression</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">Gallery and exhibition spaces can show how creative programmes activate older buildings while keeping their texture visible.</p>
                </article>
                <article class="rounded-3xl bg-paper-white p-7 shadow-sm">
                    <p class="section-label">Heritage</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Careful interpretation</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">Visitors are invited to observe architecture, materials, routes, and archival references with patience and respect.</p>
                </article>
                <article class="rounded-3xl bg-paper-white p-7 shadow-sm">
                    <p class="section-label">Culture</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Community activity</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">Workshops, talks, cultural gatherings, and visitor experiences can bring everyday public life into a heritage setting.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <x-section-heading
                    eyebrow="Architectural character"
                    title="Materials that carry memory."
                    lead="Brick, steel, concrete, timber, repeated openings, and repaired surfaces can help visitors read the site. Exact conservation guidance should be verified with the site team."
                />
                <div class="mt-8 grid gap-4">
                    @foreach (['Concrete and brick surfaces', 'Metal grilles and controlled openings', 'Corridors, courtyards, and thresholds', 'Layered repairs and adaptive reuse details'] as $value)
                        <div class="flex gap-3 rounded-2xl border border-concrete bg-heritage-cream p-4">
                            <x-icon name="check-circle" class="mt-1 h-5 w-5 shrink-0 text-rust" />
                            <p class="font-semibold text-charcoal">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="rounded-3xl bg-deep-charcoal p-6 text-paper-white">
                <p class="section-label text-muted-gold">Before and after</p>
                <h2 class="mt-3 font-serif text-3xl font-semibold">A visual comparison of reuse.</h2>
                <p class="mt-4 text-sm leading-7 text-concrete">These public photographs pair a weathered former-prison view with a reopened visitor exhibition moment, showing how the site has moved into public cultural use.</p>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @php($beforeImage = $sectionImages['about_before'])
                    <figure>
                        <img
                            src="{{ asset($beforeImage['image']) }}"
                            alt="{{ $beforeImage['alt'] }}"
                            class="section-image aspect-[4/5] rounded-2xl"
                            style="object-position: {{ $beforeImage['position'] }};"
                            width="{{ $beforeImage['width'] }}"
                            height="{{ $beforeImage['height'] }}"
                            loading="lazy"
                        >
                        <figcaption class="mt-2 text-xs uppercase tracking-[0.18em] text-muted-gold">Before reopening</figcaption>
                        <x-image-credit :credit="$beforeImage['credit']" :source="$beforeImage['source_url']" compact class="mt-2 text-concrete" />
                    </figure>
                    @php($afterImage = $sectionImages['about_after'])
                    <figure>
                        <img
                            src="{{ asset($afterImage['image']) }}"
                            alt="{{ $afterImage['alt'] }}"
                            class="section-image aspect-[4/5] rounded-2xl"
                            style="object-position: {{ $afterImage['position'] }};"
                            width="{{ $afterImage['width'] }}"
                            height="{{ $afterImage['height'] }}"
                            loading="lazy"
                        >
                        <figcaption class="mt-2 text-xs uppercase tracking-[0.18em] text-muted-gold">Now as a visitor site</figcaption>
                        <x-image-credit :credit="$afterImage['credit']" :source="$afterImage['source_url']" compact class="mt-2 text-concrete" />
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-heritage-cream">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div>
                <x-section-heading
                    eyebrow="Timeline"
                    title="Key public interpretation points."
                    lead="The timeline uses only broad stages until more verified historical material is available."
                />
                @php($timelineImage = $sectionImages['about_timeline'])
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

    <section class="section-pad bg-charcoal text-paper-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-[1fr_1.2fr] lg:px-8">
            <div>
                <x-section-heading
                    dark
                    eyebrow="Heritage values"
                    title="What the tour should help visitors notice."
                    lead="The experience is built around observation, context, care, and continuity."
                />
                @php($valuesImage = $sectionImages['about_values'])
                <figure class="mt-8 overflow-hidden rounded-3xl border border-paper-white/10 bg-paper-white/5 shadow-sm">
                    <img
                        src="{{ asset($valuesImage['image']) }}"
                        alt="{{ $valuesImage['alt'] }}"
                        class="section-image aspect-[16/10]"
                        style="object-position: {{ $valuesImage['position'] }};"
                        width="{{ $valuesImage['width'] }}"
                        height="{{ $valuesImage['height'] }}"
                        loading="lazy"
                    >
                    <figcaption class="px-4 pb-4 pt-3">
                        <x-image-credit :credit="$valuesImage['credit']" :source="$valuesImage['source_url']" compact />
                    </figcaption>
                </figure>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['title' => 'Historical awareness', 'text' => 'Understand the former site identity with restraint and care.'],
                    ['title' => 'Architectural literacy', 'text' => 'Notice materials, scale, light, ventilation, and circulation.'],
                    ['title' => 'Cultural continuity', 'text' => 'See how present-day programmes can activate heritage spaces.'],
                    ['title' => 'Visitor responsibility', 'text' => 'Respect barriers, restricted areas, other visitors, and the site fabric.'],
                ] as $item)
                    <x-info-card icon="check-circle" :title="$item['title']" :text="$item['text']" dark class="border-paper-white/10 bg-paper-white/5" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-paper-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-5xl flex-col items-start justify-between gap-6 rounded-3xl border border-concrete bg-heritage-cream p-8 lg:flex-row lg:items-center">
            <div>
                <p class="section-label">Respectful visit</p>
                <h2 class="mt-2 font-serif text-3xl font-semibold text-deep-charcoal">Continue into the self-guided route.</h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-charcoal/75">Use the route at your own pace, read the notes carefully, and replace sample interpretation with verified site material when it is available.</p>
            </div>
            <x-button :href="route('tour.start')" variant="dark" icon="route">Start Tour</x-button>
        </div>
    </section>
@endsection
