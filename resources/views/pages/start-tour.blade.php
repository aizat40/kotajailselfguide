@extends('layouts.app')

@php($heroImage = $images['sections']['start_tour_hero'])

@section('content')
    <x-page-hero
        eyebrow="Start tour"
        title="Choose the route that fits your visit today."
        lead="Set language, duration, audio, accessibility, and interests. Your preferences and tour progress stay in this browser only."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    >
        <div class="flex flex-wrap gap-3">
            <x-button href="#tour-options" variant="primary" icon="route">Choose Route</x-button>
            <x-button :href="route('tour.map')" variant="secondary" icon="map">Open Map</x-button>
        </div>
    </x-page-hero>

    <section id="tour-options" class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <aside class="self-start rounded-3xl border border-concrete bg-heritage-cream p-6 lg:sticky lg:top-28">
                <p class="section-label">Saved tour</p>
                <h2 class="mt-2 font-serif text-3xl font-semibold text-deep-charcoal">Resume from where you left off.</h2>
                <x-progress-card :stops="$stops" class="mt-6" />
            </aside>

            <form class="grid gap-8" data-tour-preferences>
                @csrf
                <section class="rounded-3xl border border-concrete bg-paper-white p-6 shadow-sm">
                    <x-section-heading
                        eyebrow="Route length"
                        title="Select a self-guided route."
                        lead="All routes use static sample stop data and can be edited in the configuration file."
                    />
                    <div class="mt-8 grid gap-4 md:grid-cols-2">
                        @foreach ($routes as $route)
                            <label class="route-option cursor-pointer rounded-2xl border border-concrete bg-heritage-cream p-5 transition hover:border-muted-gold">
                                <input type="radio" name="route" value="{{ $route['slug'] }}" class="sr-only peer" @checked($loop->first)>
                                <span class="flex items-start justify-between gap-4">
                                    <span>
                                        <span class="block font-serif text-2xl font-semibold text-deep-charcoal">{{ $route['name'] }}</span>
                                        <span class="mt-2 block text-sm leading-6 text-charcoal/70">{{ $route['description'] }}</span>
                                    </span>
                                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-rust/30 text-sm font-black text-rust peer-checked:bg-rust peer-checked:text-paper-white">{{ $route['stops'] }}</span>
                                </span>
                                <span class="mt-4 grid gap-2 text-sm font-semibold text-charcoal sm:grid-cols-3">
                                    <span>{{ $route['duration'] }}</span>
                                    <span>{{ $route['difficulty'] }}</span>
                                    <span>{{ $route['distance'] }}</span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-3xl border border-concrete bg-heritage-cream p-6">
                    <x-section-heading
                        eyebrow="Tour preferences"
                        title="Make the guide more comfortable."
                        lead="These settings are stored locally and can be changed any time."
                    />
                    <div class="mt-8 grid gap-5 md:grid-cols-2">
                        <label class="field-label">
                            Language
                            <select name="language" data-pref-field class="field-input">
                                <option value="en">English</option>
                                <option value="ms">Bahasa Malaysia</option>
                            </select>
                        </label>
                        <label class="field-label">
                            Tour theme
                            <select name="theme" data-pref-field class="field-input">
                                <option value="balanced">Balanced heritage route</option>
                                <option value="art">Art and culture</option>
                                <option value="architecture">Architecture and history</option>
                                <option value="family">Family-friendly highlights</option>
                            </select>
                        </label>
                        <label class="field-label">
                            Preferred duration
                            <select name="duration" data-pref-field class="field-input">
                                <option value="30">30 minutes</option>
                                <option value="60" selected>60 minutes</option>
                                <option value="90">90 minutes</option>
                            </select>
                        </label>
                        <label class="field-label">
                            Walking pace
                            <select name="pace" data-pref-field class="field-input">
                                <option value="slow">Slow and reflective</option>
                                <option value="steady" selected>Steady</option>
                                <option value="quick">Highlights only</option>
                            </select>
                        </label>
                    </div>
                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <label class="flex min-h-14 items-center justify-between gap-4 rounded-2xl border border-concrete bg-paper-white p-4 font-semibold text-charcoal">
                            <span>Audio enabled</span>
                            <input type="checkbox" name="audio" data-pref-field class="h-5 w-5 accent-rust" checked>
                        </label>
                        <label class="flex min-h-14 items-center justify-between gap-4 rounded-2xl border border-concrete bg-paper-white p-4 font-semibold text-charcoal">
                            <span>Accessibility mode</span>
                            <input type="checkbox" name="accessibility" data-pref-field class="h-5 w-5 accent-rust">
                        </label>
                    </div>
                </section>

                <section class="rounded-3xl bg-deep-charcoal p-6 text-paper-white">
                    <p class="section-label text-muted-gold">Safety reminders</p>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        @foreach ([
                            'Stay within public visitor areas and follow on-site barriers.',
                            'Use care around uneven floors, steps, older surfaces, and outdoor heat.',
                            'Pause audio or lower volume when moving through crowded areas.',
                            'Respect restricted spaces, event setups, and other visitors.',
                        ] as $reminder)
                            <div class="flex gap-3 rounded-2xl bg-paper-white/5 p-4 text-sm leading-6 text-concrete">
                                <x-icon name="alert" class="mt-1 h-5 w-5 shrink-0 text-muted-gold" />
                                <span>{{ $reminder }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <x-button :href="route('tour.map')" variant="primary" icon="route" data-save-preferences>Begin Tour</x-button>
                        <x-button :href="route('locations.index')" variant="secondary" icon="arrow-right" data-resume-tour>Resume Saved Tour</x-button>
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-full border border-paper-white/20 px-5 py-3 text-sm font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-reset-progress>
                            Reset Progress
                        </button>
                    </div>
                </section>
            </form>
        </div>
    </section>
@endsection
