@props([
    'icon' => 'circle',
    'title',
    'text' => null,
    'dark' => false,
])

<article {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl border p-6 transition duration-300']) }}>
    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-rust via-muted-gold to-transparent"></div>
    <div class="flex h-12 w-12 items-center justify-center rounded-full {{ $dark ? 'bg-paper-white/10 text-muted-gold' : 'bg-rust/10 text-rust' }}">
        <x-icon :name="$icon" class="h-6 w-6" />
    </div>
    <h3 class="mt-5 font-serif text-2xl font-semibold {{ $dark ? 'text-paper-white' : 'text-deep-charcoal' }}">{{ $title }}</h3>
    @if ($text)
        <p class="mt-3 text-sm leading-7 {{ $dark ? 'text-concrete' : 'text-charcoal/75' }}">{{ $text }}</p>
    @else
        <div class="mt-3 text-sm leading-7 {{ $dark ? 'text-concrete' : 'text-charcoal/75' }}">{{ $slot }}</div>
    @endif
</article>
