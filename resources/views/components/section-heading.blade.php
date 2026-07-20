@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'align' => 'left',
    'dark' => false,
])

@php
    $alignClass = $align === 'center' ? 'mx-auto text-center' : '';
    $titleClass = $dark ? 'text-paper-white' : 'text-deep-charcoal';
    $leadClass = $dark ? 'text-concrete' : 'text-charcoal/75';
@endphp

<div {{ $attributes->merge(['class' => 'max-w-3xl '.$alignClass]) }}>
    @if ($eyebrow)
        <p class="section-label">{{ $eyebrow }}</p>
    @endif
    <h2 class="font-serif text-3xl font-semibold leading-tight {{ $titleClass }} sm:text-4xl lg:text-5xl">{{ $title }}</h2>
    @if ($lead)
        <p class="mt-5 text-base leading-8 {{ $leadClass }}">{{ $lead }}</p>
    @endif
</div>
