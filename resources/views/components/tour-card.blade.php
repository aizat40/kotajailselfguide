@props(['stop', 'compact' => false])

@php
    $tags = implode(' ', $stop['tags'] ?? []);
@endphp

<article
    class="tour-card group flex h-full flex-col overflow-hidden rounded-2xl border border-concrete bg-paper-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
    data-location-card
    data-stop-slug="{{ $stop['slug'] }}"
    data-stop-title="{{ strtolower($stop['title']) }}"
    data-stop-category="{{ strtolower($stop['category']) }}"
    data-stop-tags="{{ strtolower($tags) }}"
    data-stop-routes="{{ implode(' ', $stop['routes'] ?? []) }}"
>
    <div class="relative aspect-[4/3] overflow-hidden bg-charcoal">
        <img
            src="{{ asset($stop['image']) }}"
            alt="{{ $stop['alt'] }}"
            class="section-image transition duration-500 group-hover:scale-105"
            style="object-position: {{ $stop['image_position'] ?? 'center' }};"
            loading="lazy"
            @if (! empty($stop['image_width'])) width="{{ $stop['image_width'] }}" @endif
            @if (! empty($stop['image_height'])) height="{{ $stop['image_height'] }}" @endif
        >
        <div class="absolute inset-0 bg-gradient-to-t from-deep-charcoal/85 via-deep-charcoal/10 to-transparent"></div>
        <div class="absolute left-4 top-4 flex items-center gap-2">
            <span class="grid h-12 w-12 place-items-center rounded-full bg-muted-gold text-sm font-black text-deep-charcoal">#{{ str_pad($stop['number'], 2, '0', STR_PAD_LEFT) }}</span>
            <x-status-badge :label="$stop['category']" tone="dark" />
        </div>
        <span class="completion-pill absolute bottom-4 right-4 hidden rounded-full bg-paper-white px-3 py-1 text-xs font-bold text-rust" data-completion-state>Completed</span>
    </div>

    <div class="flex flex-1 flex-col p-5">
        <div class="flex items-start justify-between gap-4">
            <h3 class="font-serif text-2xl font-semibold leading-tight text-deep-charcoal">{{ $stop['title'] }}</h3>
            <span class="inline-flex shrink-0 items-center gap-1 text-xs font-bold uppercase tracking-[0.16em] text-heritage-brown">
                <x-icon name="clock" class="h-4 w-4" /> {{ $stop['duration'] }}
            </span>
        </div>
        <p class="mt-3 text-sm leading-7 text-charcoal/75">{{ $stop['excerpt'] }}</p>

        @unless ($compact)
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach (array_slice($stop['tags'], 0, 4) as $tag)
                    <span class="rounded-full bg-heritage-cream px-3 py-1 text-xs font-semibold text-heritage-brown">{{ $tag }}</span>
                @endforeach
            </div>
        @endunless

        <div class="mt-5 flex flex-wrap gap-3">
            <x-button :href="route('locations.show', $stop['slug'])" variant="cream" size="sm" icon="arrow-right">Explore Stop</x-button>
            <button type="button" class="mark-complete-btn inline-flex min-h-10 items-center justify-center rounded-full border border-rust/30 px-4 py-2 text-sm font-semibold text-rust hover:bg-rust hover:text-paper-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-complete-toggle data-stop-slug="{{ $stop['slug'] }}">
                Mark completed
            </button>
        </div>
    </div>
</article>
