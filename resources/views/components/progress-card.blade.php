@props(['stops'])

<section {{ $attributes->merge(['class' => 'overflow-hidden rounded-3xl border border-muted-gold/30 bg-deep-charcoal p-6 text-paper-white shadow-2xl shadow-deep-charcoal/20']) }} data-progress-card data-total-stops="{{ count($stops) }}">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="section-label">Tour progress</p>
            <h2 class="mt-2 font-serif text-3xl font-semibold">Your walking route</h2>
        </div>
        <span class="grid h-16 w-16 place-items-center rounded-full border border-muted-gold/40 bg-paper-white/5 text-xl font-black text-muted-gold" data-progress-percent>0%</span>
    </div>

    <div class="mt-6 h-3 overflow-hidden rounded-full bg-paper-white/10" aria-hidden="true">
        <div class="h-full rounded-full bg-gradient-to-r from-rust to-muted-gold transition-all duration-500" style="width: 0%" data-progress-bar></div>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl bg-paper-white/5 p-4">
            <p class="text-xs uppercase tracking-[0.2em] text-concrete">Visited</p>
            <p class="mt-2 text-2xl font-black" data-progress-completed>0</p>
        </div>
        <div class="rounded-2xl bg-paper-white/5 p-4">
            <p class="text-xs uppercase tracking-[0.2em] text-concrete">Remaining</p>
            <p class="mt-2 text-2xl font-black" data-progress-remaining>{{ count($stops) }}</p>
        </div>
        <div class="rounded-2xl bg-paper-white/5 p-4">
            <p class="text-xs uppercase tracking-[0.2em] text-concrete">Time left</p>
            <p class="mt-2 text-2xl font-black" data-progress-time>60 min</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-paper-white/10 bg-paper-white/5 p-4">
        <p class="text-xs uppercase tracking-[0.2em] text-concrete">Recommended next stop</p>
        <p class="mt-2 font-serif text-2xl font-semibold text-paper-white" data-progress-next>{{ $stops[0]['title'] ?? 'Main Entrance' }}</p>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
        <x-button :href="route('tour.start')" variant="primary" icon="route" data-resume-tour>Resume Tour</x-button>
        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-full border border-paper-white/20 px-5 py-3 text-sm font-semibold text-paper-white hover:bg-paper-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold" data-reset-progress>
            Reset progress
        </button>
    </div>
</section>
