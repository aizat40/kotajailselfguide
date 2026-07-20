@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'image' => 'images/kota-jail/hero/kota-jail-main-interior-hall.jpg',
    'alt' => 'Kota Jail heritage photograph',
    'position' => 'center',
    'width' => null,
    'height' => null,
])

<section class="page-hero relative overflow-hidden bg-deep-charcoal px-4 pb-20 pt-36 text-paper-white sm:px-6 lg:px-8">
    <img
        src="{{ asset($image) }}"
        alt="{{ $alt }}"
        class="absolute inset-0 h-full w-full object-cover"
        style="object-position: {{ $position }};"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
    >
    <div class="absolute inset-0 bg-gradient-to-br from-deep-charcoal/95 via-deep-charcoal/78 to-brick/55"></div>
    <div class="bar-pattern absolute inset-0 opacity-20"></div>
    <div class="relative mx-auto max-w-7xl">
        @if ($eyebrow)
            <p class="section-label text-muted-gold">{!! $eyebrow !!}</p>
        @endif
        <h1 class="mt-4 max-w-5xl font-serif text-4xl font-bold leading-tight sm:text-6xl lg:text-7xl">{{ $title }}</h1>
        @if ($lead)
            <p class="mt-6 max-w-3xl text-lg leading-8 text-concrete">{{ $lead }}</p>
        @endif
        @if (trim((string) $slot) !== '')
            <div class="mt-8">{{ $slot }}</div>
        @endif
    </div>
</section>
