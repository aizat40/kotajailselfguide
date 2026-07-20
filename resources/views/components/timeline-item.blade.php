@props(['item', 'last' => false])

<div class="relative pl-10">
    <div class="absolute left-0 top-1 grid h-7 w-7 place-items-center rounded-full border border-muted-gold bg-paper-white">
        <span class="h-2.5 w-2.5 rounded-full bg-rust"></span>
    </div>
    @unless ($last)
        <div class="absolute bottom-0 left-3.5 top-8 w-px bg-concrete"></div>
    @endunless
    <p class="text-sm font-bold uppercase tracking-[0.2em] text-rust">{{ $item['year'] }}</p>
    <h3 class="mt-2 font-serif text-2xl font-semibold text-deep-charcoal">{{ $item['title'] }}</h3>
    <p class="mt-3 pb-8 text-sm leading-7 text-charcoal/75">{{ $item['description'] }}</p>
</div>
