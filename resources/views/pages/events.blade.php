@extends('layouts.app')

@php($heroImage = $images['sections']['events_hero'])

@section('content')
    <x-page-hero
        eyebrow="Events"
        title="Art, heritage, culture, and community programmes."
        lead="Browse sample current, upcoming, and past events. Replace these static listings with official Kota Jail programme information when available."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white" data-filter-scope data-filter-type="events">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-concrete bg-heritage-cream p-5">
                <div class="grid gap-4 lg:grid-cols-[1fr_auto_auto] lg:items-center">
                    <label class="relative block">
                        <span class="sr-only">Search events</span>
                        <x-icon name="search" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-rust" />
                        <input type="search" class="field-input w-full pl-12" placeholder="Search event title, category, or venue" data-search-input>
                    </label>
                    <label>
                        <span class="sr-only">Filter event categories</span>
                        <select class="field-input w-full lg:min-w-56" data-category-filter>
                            <option value="all">All categories</option>
                            @foreach (['Exhibition', 'Workshop', 'Heritage', 'Art', 'Culture', 'Community', 'Guided Tour'] as $filter)
                                <option value="{{ strtolower($filter) }}">{{ $filter }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>
                        <span class="sr-only">Filter event status</span>
                        <select class="field-input w-full lg:min-w-44" data-status-filter>
                            <option value="all">All dates</option>
                            <option value="current">Current</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="past">Past</option>
                        </select>
                    </label>
                </div>
                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm font-semibold text-charcoal/70">
                    <p><span data-result-count>{{ count($events) }}</span> events shown</p>
                    <button type="button" class="text-rust hover:underline" data-clear-filters>Clear filters</button>
                </div>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3" data-results-grid>
                @foreach ($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>

            <x-empty-state class="mt-10" title="No events match" text="Try another category, status, or search term." icon="calendar" />
        </div>
    </section>
@endsection
