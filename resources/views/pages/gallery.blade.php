@extends('layouts.app')

@php($heroImage = $images['sections']['gallery_hero'])

@section('content')
    <x-page-hero
        eyebrow="Gallery"
        title="Photographs, textures, exhibitions, and visitor moments."
        lead="A varied local gallery of actual Kota Jail images, including exterior views, interiors, cells, exhibitions, public spaces, and cultural activity."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white" data-filter-scope data-filter-type="gallery">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-concrete bg-heritage-cream p-5">
                <div class="grid gap-4 lg:grid-cols-[1fr_auto] lg:items-center">
                    <label class="relative block">
                        <span class="sr-only">Search gallery</span>
                        <x-icon name="search" class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-rust" />
                        <input type="search" class="field-input w-full pl-12" placeholder="Search captions, categories, or titles" data-search-input>
                    </label>
                    <label>
                        <span class="sr-only">Filter gallery category</span>
                        <select class="field-input w-full lg:min-w-64" data-category-filter>
                            <option value="all">All categories</option>
                            @foreach (collect($galleryItems)->pluck('category')->unique()->values() as $category)
                                <option value="{{ strtolower($category) }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm font-semibold text-charcoal/70">
                    <p><span data-result-count>{{ count($galleryItems) }}</span> images shown</p>
                    <button type="button" class="text-rust hover:underline" data-clear-filters>Clear filters</button>
                </div>
            </div>

            <div class="mt-10 columns-1 gap-6 sm:columns-2 lg:columns-3" data-results-grid>
                @foreach ($galleryItems as $item)
                    <div class="mb-6">
                        <x-gallery-card :item="$item" />
                    </div>
                @endforeach
            </div>

            <x-empty-state class="mt-10" title="No images match" text="Try All categories or a shorter search term." icon="search" />
        </div>

        <div class="fixed inset-0 z-[75] hidden bg-deep-charcoal/90 p-4 backdrop-blur-sm" data-lightbox role="dialog" aria-modal="true" aria-labelledby="lightbox-title">
            <div class="mx-auto flex h-full max-w-6xl flex-col">
                <div class="flex items-center justify-between gap-4 py-4 text-paper-white">
                    <div>
                        <p class="section-label text-muted-gold" data-lightbox-category>Gallery</p>
                        <h2 id="lightbox-title" class="font-serif text-3xl font-semibold" data-lightbox-title>Image title</h2>
                    </div>
                    <button type="button" class="grid h-11 w-11 place-items-center rounded-full border border-paper-white/20 text-paper-white" data-lightbox-close aria-label="Close lightbox">
                        <x-icon name="close" class="h-5 w-5" />
                    </button>
                </div>
                <div class="relative grid min-h-0 flex-1 place-items-center">
                    <button type="button" class="lightbox-arrow left-0" data-lightbox-prev aria-label="Previous image"><x-icon name="arrow-left" class="h-5 w-5" /></button>
                    <img src="" alt="" class="max-h-full max-w-full rounded-3xl object-contain shadow-2xl" data-lightbox-image>
                    <button type="button" class="lightbox-arrow right-0" data-lightbox-next aria-label="Next image"><x-icon name="arrow-right" class="h-5 w-5" /></button>
                </div>
                <p class="py-4 text-center text-sm leading-7 text-concrete" data-lightbox-caption>Caption</p>
            </div>
        </div>
    </section>
@endsection
