@props([
    'title' => 'No results found',
    'text' => 'Try changing your search or filters.',
    'icon' => 'search',
])

<div {{ $attributes->merge(['class' => 'hidden rounded-3xl border border-dashed border-concrete bg-paper-white p-8 text-center']) }} data-empty-state>
    <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-rust/10 text-rust">
        <x-icon :name="$icon" class="h-7 w-7" />
    </div>
    <h2 class="mt-4 font-serif text-2xl font-semibold text-deep-charcoal">{{ $title }}</h2>
    <p class="mt-2 text-sm leading-6 text-charcoal/70">{{ $text }}</p>
</div>
