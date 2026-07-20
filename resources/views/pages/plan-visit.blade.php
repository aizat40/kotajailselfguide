@extends('layouts.app')

@php($heroImage = $images['sections']['plan_visit_hero'])

@section('content')
    <x-page-hero
        eyebrow="Plan your visit"
        title="Build a route that fits your time, interests, and access needs."
        lead="Use the planning controls to generate a simple recommendation. All logic runs in the browser and uses static route profiles."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white" data-visit-planner>
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <form class="rounded-3xl border border-concrete bg-heritage-cream p-6 shadow-sm">
                @csrf
                <x-section-heading
                    eyebrow="Route builder"
                    title="Tell the guide what matters today."
                    lead="The recommendation updates instantly and can be changed at any time."
                />
                <div class="mt-8 grid gap-5">
                    <label class="field-label">
                        Available time
                        <select class="field-input" name="time" data-planner-field>
                            <option value="30">About 30 minutes</option>
                            <option value="60" selected>About 60 minutes</option>
                            <option value="90">90 minutes or more</option>
                        </select>
                    </label>
                    <label class="field-label">
                        Main interest
                        <select class="field-input" name="interest" data-planner-field>
                            <option value="first-time">First-time overview</option>
                            <option value="families">Family-friendly pace</option>
                            <option value="architecture">Architecture</option>
                            <option value="art">Art and culture</option>
                            <option value="short">Short route</option>
                        </select>
                    </label>
                    <label class="field-label">
                        Group type
                        <select class="field-input" name="group" data-planner-field>
                            <option value="solo">Solo or pair</option>
                            <option value="family">Family</option>
                            <option value="group">Small group</option>
                            <option value="school">School or learning group</option>
                        </select>
                    </label>
                    <label class="field-label">
                        Accessibility requirements
                        <select class="field-input" name="accessibility" data-planner-field>
                            <option value="standard">Standard route</option>
                            <option value="accessible">Prioritise accessible stops</option>
                            <option value="rest">Prefer more rest points</option>
                        </select>
                    </label>
                    <label class="field-label">
                        Language preference
                        <select class="field-input" name="language" data-planner-field>
                            <option value="en">English</option>
                            <option value="ms">Bahasa Malaysia</option>
                        </select>
                    </label>
                </div>
            </form>

            <div class="space-y-6">
                <section class="rounded-3xl bg-deep-charcoal p-6 text-paper-white shadow-xl" data-planner-result>
                    <p class="section-label text-muted-gold">Recommended route</p>
                    <h2 class="mt-3 font-serif text-4xl font-semibold" data-planner-title>{{ $profiles[0]['name'] }}</h2>
                    <p class="mt-3 text-lg font-semibold text-muted-gold" data-planner-route>{{ $profiles[0]['route'] }}</p>
                    <p class="mt-4 text-sm leading-7 text-concrete" data-planner-description>{{ $profiles[0]['description'] }}</p>
                    <div class="mt-6 grid gap-3 sm:grid-cols-2" data-planner-stops>
                        @foreach ($profiles[0]['stops'] as $stop)
                            <span class="rounded-2xl bg-paper-white/5 px-4 py-3 text-sm font-semibold text-paper-white">{{ $stop }}</span>
                        @endforeach
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <x-button :href="route('tour.start')" variant="primary" icon="route">Save Tour Preferences</x-button>
                        <x-button :href="route('tour.map')" variant="secondary" icon="map">Open Map</x-button>
                    </div>
                </section>

                <section class="grid gap-4 md:grid-cols-2">
                    @foreach ($profiles as $profile)
                        <article class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm" data-profile-card data-profile-name="{{ strtolower($profile['name']) }}">
                            <p class="section-label">{{ $profile['route'] }}</p>
                            <h3 class="mt-2 font-serif text-2xl font-semibold text-deep-charcoal">{{ $profile['name'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-charcoal/75">{{ $profile['description'] }}</p>
                        </article>
                    @endforeach
                </section>
            </div>
        </div>
    </section>
@endsection
