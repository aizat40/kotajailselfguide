@props(['audio', 'sticky' => false])

@if ($sticky)
    <section
        class="sticky-audio rounded-2xl border border-concrete bg-paper-white p-3 shadow-2xl"
        data-audio-player
        data-audio-src="{{ $audio['src'] ?? '' }}"
    >
        <div class="flex items-center gap-3">
            <button type="button" class="audio-btn is-primary h-12 w-12 shrink-0" data-audio-play aria-label="Play sticky audio guide"><x-icon name="play" class="h-5 w-5" /></button>
            <div class="min-w-0 flex-1">
                <p class="text-[0.65rem] font-black uppercase tracking-[0.18em] text-rust">Audio guide</p>
                <h2 class="truncate font-serif text-lg font-semibold text-deep-charcoal">{{ $audio['title'] ?? 'Sample audio guide' }}</h2>
            </div>
            <a href="#audio-guide-main" class="shrink-0 rounded-full border border-concrete px-3 py-2 text-xs font-bold text-rust">Open</a>
        </div>
    </section>
@else
<section
    class="rounded-3xl border border-concrete bg-paper-white p-5 shadow-sm"
    data-audio-player
    data-audio-src="{{ $audio['src'] ?? '' }}"
>
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="section-label">Audio guide</p>
            <h2 class="mt-2 font-serif text-2xl font-semibold text-deep-charcoal">{{ $audio['title'] ?? 'Sample audio guide' }}</h2>
            @unless ($audio['src'] ?? null)
                <p class="mt-2 text-sm leading-6 text-charcoal/70">Audio file not added yet. The transcript and controls remain available as a sample state.</p>
            @endunless
        </div>
        <label class="sr-only" for="audio-language-{{ md5($audio['title'] ?? 'audio') }}">Audio language</label>
        <select id="audio-language-{{ md5($audio['title'] ?? 'audio') }}" class="rounded-full border border-concrete bg-heritage-cream px-3 py-2 text-sm font-semibold text-deep-charcoal focus:border-muted-gold focus:outline-none">
            <option value="en">EN</option>
            <option value="ms">BM</option>
        </select>
    </div>

    <div class="mt-5 flex flex-wrap items-center gap-3">
        <button type="button" class="audio-btn" data-audio-rewind aria-label="Rewind 10 seconds"><x-icon name="rewind" class="h-4 w-4" /></button>
        <button type="button" class="audio-btn is-primary" data-audio-play aria-label="Play audio guide"><x-icon name="play" class="h-5 w-5" /></button>
        <button type="button" class="audio-btn" data-audio-forward aria-label="Forward 10 seconds"><x-icon name="forward" class="h-4 w-4" /></button>
        <label class="ml-auto flex items-center gap-2 text-sm font-semibold text-charcoal">
            Speed
            <select class="rounded-full border border-concrete bg-heritage-cream px-2 py-1 text-sm" data-audio-speed>
                <option value="1">1x</option>
                <option value="1.25">1.25x</option>
                <option value="1.5">1.5x</option>
            </select>
        </label>
    </div>

    <div class="mt-5">
        <div class="flex justify-between text-xs font-semibold uppercase tracking-[0.14em] text-heritage-brown">
            <span data-audio-current>0:00</span>
            <span data-audio-duration>{{ $audio['duration'] ?? '0:00' }}</span>
        </div>
        <input type="range" min="0" max="100" value="0" class="mt-2 w-full accent-rust" data-audio-progress aria-label="Audio progress">
    </div>

    <label class="mt-4 flex items-center gap-3 text-sm font-semibold text-charcoal">
        <span>Volume</span>
        <input type="range" min="0" max="100" value="80" class="w-32 accent-rust" data-audio-volume aria-label="Audio volume">
    </label>

    <button type="button" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-rust hover:underline" data-transcript-toggle aria-expanded="false">
        Show transcript
        <x-icon name="arrow-right" class="h-4 w-4" />
    </button>
    <div class="mt-4 hidden rounded-2xl bg-heritage-cream p-4 text-sm leading-7 text-charcoal" data-transcript>
        {{ $audio['transcript'] ?? 'Transcript content can be added here.' }}
    </div>
</section>
@endif
