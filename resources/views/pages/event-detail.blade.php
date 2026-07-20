@extends('layouts.app')

@php
    $date = new DateTime($event['date']);
    $googleCalendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text='.urlencode($event['title']).'&dates='.str_replace(['-', ':'], '', $event['date'].'T'.$event['start_time'].'00').'/'.str_replace(['-', ':'], '', $event['date'].'T'.$event['end_time'].'00').'&location='.urlencode($event['venue']).'&details='.urlencode($event['description']);
@endphp

@section('content')
    <x-page-hero
        eyebrow="{{ $event['category'] }} · {{ $event['status'] }}"
        :title="$event['title']"
        :lead="$event['excerpt']"
        :image="$event['image']"
        :alt="$event['alt']"
        :position="$event['image_position'] ?? 'center'"
        :width="$event['image_width'] ?? null"
        :height="$event['image_height'] ?? null"
    >
        <div class="flex flex-wrap gap-3">
            <x-button :href="$googleCalendarUrl" variant="primary" icon="calendar">Add to Google Calendar</x-button>
            <x-button :href="route('events.calendar', $event['slug'])" variant="secondary" icon="calendar">Download ICS</x-button>
            <button type="button" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-full border border-paper-white/20 bg-paper-white/10 px-5 py-3 text-sm font-semibold text-paper-white hover:bg-paper-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-share-link>
                <x-icon name="share" class="h-4 w-4" />
                Share
            </button>
        </div>
    </x-page-hero>

    <section class="bg-paper-white px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <x-breadcrumb :items="[
                ['label' => 'Events', 'url' => route('events.index')],
                ['label' => $event['title']],
            ]" />
        </div>
    </section>

    <section class="section-pad bg-paper-white pt-6">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:px-8">
            <article class="min-w-0">
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Date</p>
                        <p class="mt-2 text-xl font-black text-deep-charcoal">{{ $date->format('d M Y') }}</p>
                    </div>
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Time</p>
                        <p class="mt-2 text-xl font-black text-deep-charcoal">{{ $event['start_time'] }} - {{ $event['end_time'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-concrete bg-heritage-cream p-5">
                        <p class="section-label">Venue</p>
                        <p class="mt-2 text-xl font-black text-deep-charcoal">{{ $event['venue'] }}</p>
                    </div>
                </div>

                <div class="prose-content mt-10">
                    <h2>Event description</h2>
                    <p>{{ $event['description'] }}</p>
                    <h2>Programme details</h2>
                    <ul>
                        @foreach ($event['programme'] as $programme)
                            <li>{{ $programme }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <x-info-card icon="calendar" title="Registration" class="border-concrete bg-heritage-cream">
                        {{ $event['registration'] }}
                    </x-info-card>
                    <x-info-card icon="check-circle" title="Tickets" class="border-concrete bg-heritage-cream">
                        {{ $event['ticket'] }}
                    </x-info-card>
                    <x-info-card icon="pin" title="Organiser" class="border-concrete bg-heritage-cream">
                        {{ $event['organiser'] }}
                    </x-info-card>
                </div>

                @if (count($relatedEvents))
                    <section class="mt-12">
                        <x-section-heading eyebrow="Related events" title="Continue exploring programmes." lead="Related programme cards use actual Kota Jail event, exhibition, and public-space images." />
                        <div class="mt-6 grid gap-6 md:grid-cols-3">
                            @foreach ($relatedEvents as $related)
                                <x-event-card :event="$related" />
                            @endforeach
                        </div>
                    </section>
                @endif
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                <div class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm">
                    <p class="section-label">Event status</p>
                    <x-status-badge :label="$event['status']" tone="gold" class="mt-4" />
                    <img
                        src="{{ asset($event['image']) }}"
                        alt="{{ $event['alt'] }}"
                        class="section-image mt-5 aspect-[4/3] rounded-2xl"
                        style="object-position: {{ $event['image_position'] ?? 'center' }};"
                        loading="lazy"
                        @if (! empty($event['image_width'])) width="{{ $event['image_width'] }}" @endif
                        @if (! empty($event['image_height'])) height="{{ $event['image_height'] }}" @endif
                    >
                    <x-image-credit :credit="$event['image_credit'] ?? null" :source="$event['image_source_url'] ?? null" compact class="mt-3" />
                    <div class="mt-6 grid gap-3">
                        <x-button :href="$googleCalendarUrl" variant="dark" icon="calendar">Add to Calendar</x-button>
                        <x-button :href="route('events.index')" variant="cream" icon="arrow-left">All Events</x-button>
                    </div>
                </div>
                <div class="rounded-3xl bg-deep-charcoal p-5 text-paper-white">
                    <p class="section-label text-muted-gold">Verification note</p>
                    <p class="mt-3 text-sm leading-7 text-concrete">This is static sample event content. Confirm programme names, admission, venue access, organiser details, and booking rules before publishing.</p>
                </div>
            </aside>
        </div>
    </section>
@endsection
