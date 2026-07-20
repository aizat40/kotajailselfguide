@props(['site'])

@php
    $columns = [
        'Explore' => [
            ['label' => 'About Kota Jail', 'route' => 'about'],
            ['label' => 'Start Tour', 'route' => 'tour.start'],
            ['label' => 'Tour Map', 'route' => 'tour.map'],
            ['label' => 'Locations', 'route' => 'locations.index'],
        ],
        'Visit' => [
            ['label' => 'Plan Your Visit', 'route' => 'visit.plan'],
            ['label' => 'Visitor Information', 'route' => 'visitor.info'],
            ['label' => 'Events', 'route' => 'events.index'],
            ['label' => 'Gallery', 'route' => 'gallery'],
        ],
        'Support' => [
            ['label' => 'Contact', 'route' => 'contact'],
            ['label' => 'Privacy Policy', 'route' => 'contact'],
            ['label' => 'Terms', 'route' => 'contact'],
        ],
    ];
@endphp

<footer class="relative overflow-hidden bg-deep-charcoal pb-24 pt-16 text-paper-white lg:pb-10">
    <div class="heritage-pattern absolute inset-0 opacity-20"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1.2fr_2fr]">
            <div>
                <div class="flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-full border border-muted-gold/70 text-sm font-bold tracking-[0.2em] text-muted-gold">KJ</span>
                    <div>
                        <p class="font-serif text-2xl font-semibold">Kota Jail</p>
                        <p class="text-sm uppercase tracking-[0.22em] text-concrete">Art, Heritage, Culture</p>
                    </div>
                </div>
                <p class="mt-6 max-w-md text-sm leading-7 text-concrete">{{ $site['description'] }}</p>
                <div class="mt-6 flex flex-wrap gap-3">
                    @foreach ($site['social'] as $label => $url)
                        <a href="{{ $url }}" class="rounded-full border border-paper-white/15 px-4 py-2 text-sm font-semibold text-paper-white hover:border-muted-gold hover:text-muted-gold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-muted-gold">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-8 sm:grid-cols-3">
                @foreach ($columns as $heading => $links)
                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-[0.22em] text-muted-gold">{{ $heading }}</h2>
                        <ul class="mt-5 grid gap-3 text-sm text-concrete">
                            @foreach ($links as $link)
                                <li><a href="{{ route($link['route']) }}" class="hover:text-paper-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-muted-gold">{{ $link['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-12 grid gap-6 border-t border-paper-white/10 pt-8 text-sm text-concrete lg:grid-cols-[1fr_auto] lg:items-center">
            <div class="grid gap-2">
                <p>{{ $site['address'] }}</p>
                <p><a href="mailto:{{ $site['email'] }}" class="hover:text-paper-white">{{ $site['email'] }}</a> · WhatsApp only: {{ $site['phone'] }}</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <label for="footer-language" class="sr-only">Language</label>
                <select id="footer-language" data-language-select class="rounded-full border border-paper-white/20 bg-charcoal px-3 py-2 text-paper-white focus:border-muted-gold focus:outline-none">
                    <option value="en">English</option>
                    <option value="ms">Bahasa Malaysia</option>
                </select>
                <p>© {{ date('Y') }} Kota Jail. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
