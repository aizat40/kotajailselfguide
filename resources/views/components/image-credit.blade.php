@props([
    'credit' => null,
    'source' => null,
    'compact' => false,
])

@if ($credit)
    <p {{ $attributes->merge(['class' => ($compact ? 'image-credit image-credit--compact' : 'image-credit')]) }}>
        Image:
        @if ($source)
            <a href="{{ $source }}" target="_blank" rel="noopener noreferrer">{{ $credit }}</a>
        @else
            {{ $credit }}
        @endif
    </p>
@endif
