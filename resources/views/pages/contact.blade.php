@extends('layouts.app')

@php($heroImage = $images['sections']['contact_hero'])

@section('content')
    <x-page-hero
        eyebrow="Contact"
        title="Reach Kota Jail or plan a group visit."
        lead="This display-only page includes polished form states but does not send email or store data. Backend handling can be added later."
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
                <form class="rounded-3xl border border-concrete bg-heritage-cream p-6 shadow-sm" data-display-form novalidate>
                    @csrf
                    <x-section-heading eyebrow="General enquiry" title="Send a display-only message." lead="The form validates on the front end, prevents real submission, and shows a success message." />
                    <div class="mt-8 grid gap-5 md:grid-cols-2">
                        <label class="field-label">
                            Name
                            <input type="text" name="name" class="field-input" required>
                            <span class="field-error" data-error-for="name"></span>
                        </label>
                        <label class="field-label">
                            Email
                            <input type="email" name="email" class="field-input" required>
                            <span class="field-error" data-error-for="email"></span>
                        </label>
                        <label class="field-label md:col-span-2">
                            Topic
                            <select name="topic" class="field-input" required>
                                <option value="">Select a topic</option>
                                <option>Visitor information</option>
                                <option>Events</option>
                                <option>Media</option>
                                <option>Partnership</option>
                            </select>
                            <span class="field-error" data-error-for="topic"></span>
                        </label>
                        <label class="field-label md:col-span-2">
                            Message
                            <textarea name="message" rows="5" class="field-input" required></textarea>
                            <span class="field-error" data-error-for="message"></span>
                        </label>
                    </div>
                    <!-- Backend email handling can be connected here later. This display-only version intentionally prevents submission. -->
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <x-button type="submit" variant="dark" icon="mail">Preview Send</x-button>
                        <p class="hidden rounded-full bg-rust/10 px-4 py-2 text-sm font-semibold text-rust" data-form-success>Message validated. No email was sent.</p>
                    </div>
                </form>

                <form class="rounded-3xl bg-deep-charcoal p-6 text-paper-white shadow-xl" data-display-form novalidate>
                    @csrf
                    <x-section-heading dark eyebrow="Group visit enquiry" title="Plan a school, community, or private group visit." lead="Use this display form to collect the fields a real backend could later process." />
                    <div class="mt-8 grid gap-5 md:grid-cols-2">
                        <label class="field-label text-paper-white">
                            Organisation
                            <input type="text" name="organisation" class="field-input" required>
                            <span class="field-error" data-error-for="organisation"></span>
                        </label>
                        <label class="field-label text-paper-white">
                            Group size
                            <input type="number" name="group_size" min="1" class="field-input" required>
                            <span class="field-error" data-error-for="group_size"></span>
                        </label>
                        <label class="field-label text-paper-white">
                            Preferred date
                            <input type="date" name="preferred_date" class="field-input" required>
                            <span class="field-error" data-error-for="preferred_date"></span>
                        </label>
                        <label class="field-label text-paper-white">
                            Visit type
                            <select name="visit_type" class="field-input" required>
                                <option value="">Select visit type</option>
                                <option>School visit</option>
                                <option>Community group</option>
                                <option>Architecture walk</option>
                                <option>Event collaboration</option>
                            </select>
                            <span class="field-error" data-error-for="visit_type"></span>
                        </label>
                        <label class="field-label text-paper-white md:col-span-2">
                            Notes
                            <textarea name="notes" rows="4" class="field-input" required></textarea>
                            <span class="field-error" data-error-for="notes"></span>
                        </label>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-4">
                        <x-button type="submit" variant="primary" icon="mail">Validate Enquiry</x-button>
                        <p class="hidden rounded-full bg-paper-white/10 px-4 py-2 text-sm font-semibold text-paper-white" data-form-success>Group enquiry validated. No data was stored.</p>
                    </div>
                </form>

                <section class="rounded-3xl border border-concrete bg-paper-white p-6 shadow-sm">
                    <p class="section-label">Event collaboration</p>
                    <h2 class="mt-3 font-serif text-3xl font-semibold text-deep-charcoal">Host ideas with a heritage-first approach.</h2>
                    <p class="mt-4 text-sm leading-7 text-charcoal/75">Kota Jail can be presented as a place for careful cultural programming, exhibitions, workshops, talks, and community activities. Any collaboration should respect the site history, visitor safety, and conservation requirements.</p>
                </section>
            </div>
        </div>
    </section>
@endsection
