@extends('layouts.app')

@php($heroImage = $images['sections']['locations_hero'])

@section('content')
    <x-page-hero
        eyebrow="Locations"
        title="Browse every self-guided tour stop."
        lead="Search by stop name or filter by history, architecture, art, heritage, culture, indoor, outdoor, and accessible tags."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white" data-filter-scope data-filter-type="locations">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-concrete bg-heritage-cream p-5">
                <div class="grid gap-4 lg:grid-cols-[1fr_auto_auto] lg:items-center">
                    <label class="relative block">
                        <span class="sr-only">Search locations</span>
                        <x-icon name="search" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-rust" />
                        <input type="search" class="field-input w-full pl-12" placeholder="Search stops, categories, or features" data-search-input>
                    </label>
                    <label>
                        <span class="sr-only">Filter locations</span>
                        <select class="field-input w-full lg:min-w-56" data-category-filter>
                            <option value="all">All</option>
                            @foreach (['History', 'Architecture', 'Art', 'Heritage', 'Culture', 'Indoor', 'Outdoor', 'Accessible'] as $filter)
                                <option value="{{ strtolower($filter) }}">{{ $filter }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" class="view-toggle is-active" data-view-mode="grid" aria-label="Grid view"><x-icon name="grid" class="h-5 w-5" /></button>
                        <button type="button" class="view-toggle" data-view-mode="list" aria-label="List view"><x-icon name="list" class="h-5 w-5" /></button>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm font-semibold text-charcoal/70">
                    <p><span data-result-count>{{ count($stops) }}</span> locations shown</p>
                    <button type="button" class="text-rust hover:underline" data-clear-filters>Clear filters</button>
                </div>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3" data-results-grid>
                @foreach ($stops as $stop)
                    <x-tour-card :stop="$stop" />
                @endforeach
            </div>

            <x-empty-state class="mt-10" title="No tour stops match" text="Try a broader search, choose All, or open the map view." />
        </div>
    </section>
@endsection
