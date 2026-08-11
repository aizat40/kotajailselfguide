@extends('layouts.app')

@php($heroImage = $images['sections']['contact_hero'])
@php($whatsappUrl = 'https://wa.me/'.preg_replace('/\D+/', '', $site['phone']))

@section('content')
    <x-page-hero
        eyebrow="Contact"
        title="Reach Kota Jail or plan a group visit."
        lead="Use the address, map, email, and WhatsApp details to plan a respectful self-guided visit to Kota Jail at Ayer Molek."
        :image="$heroImage['image']"
        :alt="$heroImage['alt']"
        :position="$heroImage['position']"
        :width="$heroImage['width']"
        :height="$heroImage['height']"
    />

    <section class="section-pad bg-paper-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
            <aside class="space-y-5">
                <x-info-card icon="pin" title="Address" class="border-concrete bg-heritage-cream">
                    {{ $site['address'] }}
                </x-info-card>
                <x-info-card icon="mail" title="Email" class="border-concrete bg-heritage-cream">
                    <a href="mailto:{{ $site['email'] }}" class="font-semibold text-rust hover:underline">{{ $site['email'] }}</a>
                </x-info-card>
                <x-info-card icon="phone" title="Phone or WhatsApp" class="border-concrete bg-heritage-cream">
                    <span class="font-semibold">{{ $site['phone'] }}</span>
                    <span class="mt-2 block text-xs uppercase tracking-[0.18em] text-heritage-brown">WhatsApp preferred</span>
                </x-info-card>
                <div class="rounded-3xl bg-deep-charcoal p-5 text-paper-white">
                    <p class="section-label text-muted-gold">Social links</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        @foreach ($site['social'] as $label => $url)
                            <a href="{{ $url }}" class="rounded-full border border-paper-white/15 px-4 py-2 text-sm font-semibold hover:border-muted-gold hover:text-muted-gold">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="overflow-hidden rounded-[2rem] border border-concrete bg-stone-200 shadow-sm">
                    <div class="relative aspect-[4/3] w-full sm:aspect-[16/11] lg:aspect-[4/3]">
                        <iframe
                            src="{{ config('kotajail.visitor_info.google_maps_contact_embed_url') }}"
                            class="absolute inset-0 h-full w-full"
                            style="border: 0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Google Maps location of Kota Jail Johor Bahru">
                        </iframe>
                    </div>

                    <div class="space-y-4 bg-heritage-cream p-5 sm:p-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-rust">Visit Kota Jail</p>
                            <h3 class="mt-2 font-serif text-2xl font-semibold text-deep-charcoal">Kota Jail, Johor Bahru</h3>
                            <p class="mt-2 text-sm leading-6 text-charcoal/70">{{ $site['address'] }}</p>
                        </div>

                        <a
                            href="{{ config('kotajail.visitor_info.google_maps_search_url') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-full bg-rust px-5 py-3 text-sm font-bold text-paper-white transition hover:bg-brick focus:outline-none focus:ring-2 focus:ring-rust focus:ring-offset-2">
                            Open in Google Maps
                        </a>
                    </div>
                </div>
            </aside>

            <div class="grid gap-8">
                <section class="rounded-3xl border border-concrete bg-heritage-cream p-6 shadow-sm">
                    <x-section-heading eyebrow="Direct contact" title="Use the active channels." lead="These actions open your email app, WhatsApp, or Google Maps directly, without inactive form controls or stored messages." />
                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <a href="mailto:{{ $site['email'] }}?subject=Self-Guide%20Kota%20Jail%20Enquiry" class="rounded-2xl border border-concrete bg-paper-white p-5 transition hover:border-rust">
                            <x-icon name="mail" class="h-6 w-6 text-rust" />
                            <span class="mt-4 block font-serif text-2xl font-semibold text-deep-charcoal">Email</span>
                            <span class="mt-2 block text-sm leading-6 text-charcoal/70">{{ $site['email'] }}</span>
                        </a>
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="rounded-2xl border border-concrete bg-paper-white p-5 transition hover:border-rust">
                            <x-icon name="phone" class="h-6 w-6 text-rust" />
                            <span class="mt-4 block font-serif text-2xl font-semibold text-deep-charcoal">WhatsApp</span>
                            <span class="mt-2 block text-sm leading-6 text-charcoal/70">{{ $site['phone'] }}</span>
                        </a>
                    </div>
                </section>

                <section class="rounded-3xl bg-deep-charcoal p-6 text-paper-white shadow-xl">
                    <x-section-heading dark eyebrow="Group visits" title="Share the details that help the team prepare." lead="For school, community, or private visits, include the preferred date, group size, age range, accessibility needs, and the learning purpose of the visit." />
                    <div class="mt-8 grid gap-4 md:grid-cols-2">
                        @foreach ([
                            ['icon' => 'calendar', 'title' => 'Preferred date', 'text' => 'Include one or two possible dates and arrival times.'],
                            ['icon' => 'users', 'title' => 'Group size', 'text' => 'Share the estimated number of visitors and accompanying staff.'],
                            ['icon' => 'accessibility', 'title' => 'Access needs', 'text' => 'Mention mobility, seating, shade, or reading-support needs.'],
                            ['icon' => 'check-circle', 'title' => 'Visit purpose', 'text' => 'Briefly state whether the visit is for learning, heritage, media, or collaboration.'],
                        ] as $item)
                            <div class="rounded-2xl border border-paper-white/10 bg-paper-white/5 p-5">
                                <x-icon :name="$item['icon']" class="h-6 w-6 text-muted-gold" />
                                <h3 class="mt-4 font-serif text-2xl font-semibold">{{ $item['title'] }}</h3>
                                <p class="mt-3 text-sm leading-6 text-concrete">{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <x-button :href="'mailto:'.$site['email'].'?subject=Kota%20Jail%20Group%20Visit%20Enquiry'" variant="primary" icon="mail">Email Group Visit Details</x-button>
                        <x-button :href="$whatsappUrl" variant="secondary" icon="phone">WhatsApp First</x-button>
                    </div>
                </section>

                <section class="rounded-3xl border border-concrete bg-paper-white p-6 shadow-sm">
                    <p class="section-label">Collaboration</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Plan with a heritage-first approach.</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">Collaboration proposals should respect the site history, visitor safety, conservation needs, and the self-guided educational purpose of the Kota Jail experience.</p>
                    <p class="mt-4 text-sm font-semibold text-rust">In collaboration with Polytechnic Alumni and the Self-Guide Kota Jail Team.</p>
                </section>
            </div>
        </div>
    </section>
@endsection
