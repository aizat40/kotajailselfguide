@props(['event'])

@php
    $date = new DateTime($event['date']);
@endphp

<article
    class="event-card group flex h-full flex-col overflow-hidden rounded-2xl border border-concrete bg-paper-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
    data-event-card
    data-event-title="{{ strtolower($event['title']) }}"
    data-event-category="{{ strtolower($event['category']) }}"
    data-event-status="{{ strtolower($event['status']) }}"
>
    <div class="relative aspect-[16/10] overflow-hidden bg-charcoal">
        <img
            src="{{ asset($event['image']) }}"
            alt="{{ $event['alt'] }}"
            class="section-image transition duration-500 group-hover:scale-105"
            style="object-position: {{ $event['image_position'] ?? 'center' }};"
            loading="lazy"
            @if (! empty($event['image_width'])) width="{{ $event['image_width'] }}" @endif
            @if (! empty($event['image_height'])) height="{{ $event['image_height'] }}" @endif
        >
        <div class="absolute inset-0 bg-gradient-to-t from-deep-charcoal/80 to-transparent"></div>
        <div class="absolute left-4 top-4 flex flex-wrap gap-2">
            <x-status-badge :label="$event['category']" tone="dark" />
            <x-status-badge :label="$event['status']" tone="gold" />
        </div>
    </div>
    <div class="flex flex-1 flex-col p-5">
        <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm font-semibold text-heritage-brown">
            <span class="inline-flex items-center gap-2"><x-icon name="calendar" class="h-4 w-4" /> {{ $date->format('d M Y') }}</span>
            <span class="inline-flex items-center gap-2"><x-icon name="clock" class="h-4 w-4" /> {{ $event['start_time'] }} - {{ $event['end_time'] }}</span>
        </div>
        <h3 class="mt-4 font-serif text-2xl font-semibold leading-tight text-deep-charcoal">{{ $event['title'] }}</h3>
        <p class="mt-3 text-sm leading-7 text-charcoal/75">{{ $event['excerpt'] }}</p>
        <p class="mt-3 inline-flex items-start gap-2 text-sm font-semibold text-charcoal"><x-icon name="pin" class="mt-0.5 h-4 w-4 shrink-0 text-rust" /> {{ $event['venue'] }}</p>
        <div class="mt-5">
            <x-button :href="route('events.show', $event['slug'])" variant="cream" size="sm" icon="arrow-right">View Event</x-button>
        </div>
    </div>
</article>
