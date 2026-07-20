@props(['item'])

<figure
    class="gallery-card group break-inside-avoid overflow-hidden rounded-2xl border border-concrete bg-paper-white shadow-sm"
    data-gallery-card
    data-gallery-title="{{ strtolower($item['title']) }}"
    data-gallery-category="{{ strtolower($item['category']) }}"
    data-gallery-index="{{ $item['id'] - 1 }}"
    data-gallery-credit="{{ $item['image_credit'] ?? $item['credit'] ?? '' }}"
    data-gallery-source="{{ $item['image_source_url'] ?? $item['source_url'] ?? '' }}"
>
    <button type="button" class="block w-full text-left focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold" data-lightbox-open>
        <span class="block overflow-hidden bg-charcoal">
            <img
                src="{{ asset($item['image']) }}"
                alt="{{ $item['alt'] }}"
                class="h-auto w-full object-cover transition duration-500 group-hover:scale-105"
                style="object-position: {{ $item['image_position'] ?? 'center' }};"
                loading="lazy"
                @if (! empty($item['image_width'])) width="{{ $item['image_width'] }}" @endif
                @if (! empty($item['image_height'])) height="{{ $item['image_height'] }}" @endif
            >
        </span>
        <figcaption class="p-4">
            <span class="text-xs font-bold uppercase tracking-[0.18em] text-rust">{{ $item['category'] }}</span>
            <h3 class="mt-2 font-serif text-xl font-semibold text-deep-charcoal">{{ $item['title'] }}</h3>
            <p class="mt-2 text-sm leading-6 text-charcoal/70">{{ $item['caption'] }}</p>
            <x-image-credit :credit="$item['image_credit'] ?? $item['credit'] ?? null" :source="$item['image_source_url'] ?? $item['source_url'] ?? null" compact />
        </figcaption>
    </button>
</figure>
