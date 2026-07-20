@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex min-h-11 items-center justify-center gap-2 rounded-full font-semibold transition duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold disabled:cursor-not-allowed disabled:opacity-60';
    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-6 py-4 text-base',
    ];
    $variants = [
        'primary' => 'bg-rust text-paper-white shadow-lg shadow-rust/20 hover:bg-brick',
        'secondary' => 'border border-muted-gold/60 bg-paper-white/10 text-paper-white backdrop-blur hover:bg-muted-gold hover:text-deep-charcoal',
        'cream' => 'border border-concrete bg-heritage-cream text-deep-charcoal hover:border-muted-gold hover:bg-paper-white',
        'dark' => 'bg-deep-charcoal text-paper-white hover:bg-charcoal',
        'ghost' => 'text-rust hover:bg-rust/10',
        'text' => 'min-h-0 rounded-none px-0 py-0 text-rust underline-offset-4 hover:underline',
    ];
    $classes = $base.' '.($sizes[$size] ?? $sizes['md']).' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" class="h-4 w-4" />
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" class="h-4 w-4" />
        @endif
        <span>{{ $slot }}</span>
    </button>
@endif
