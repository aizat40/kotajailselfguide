@props(['label', 'tone' => 'rust'])

@php
    $tones = [
        'rust' => 'bg-rust/10 text-rust ring-rust/20',
        'gold' => 'bg-muted-gold/15 text-heritage-brown ring-muted-gold/30',
        'dark' => 'bg-deep-charcoal text-paper-white ring-deep-charcoal/20',
        'cream' => 'bg-heritage-cream text-heritage-brown ring-concrete',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] ring-1 '.($tones[$tone] ?? $tones['rust'])]) }}>
    {{ $label }}
</span>
