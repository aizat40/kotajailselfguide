@props(['items' => []])

<nav {{ $attributes->merge(['class' => 'text-sm font-semibold text-charcoal/70']) }} aria-label="Breadcrumb">
    <ol class="flex flex-wrap items-center gap-2">
        <li><a href="{{ route('home') }}" class="text-rust hover:underline">Home</a></li>
        @foreach ($items as $item)
            <li aria-hidden="true">/</li>
            <li>
                @if (! empty($item['url']))
                    <a href="{{ $item['url'] }}" class="text-rust hover:underline">{{ $item['label'] }}</a>
                @else
                    <span aria-current="page">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
