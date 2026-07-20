@props(['name' => 'circle', 'class' => 'h-5 w-5'])

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('map')
            <path d="m3 6 6-3 6 3 6-3v15l-6 3-6-3-6 3V6Z" />
            <path d="M9 3v15" />
            <path d="M15 6v15" />
            @break
        @case('headphones')
            <path d="M4 14v-2a8 8 0 0 1 16 0v2" />
            <path d="M4 14a2 2 0 0 1 2-2h1v7H6a2 2 0 0 1-2-2v-3Z" />
            <path d="M20 14a2 2 0 0 0-2-2h-1v7h1a2 2 0 0 0 2-2v-3Z" />
            @break
        @case('qr-code')
            <path d="M4 4h6v6H4V4Z" />
            <path d="M14 4h6v6h-6V4Z" />
            <path d="M4 14h6v6H4v-6Z" />
            <path d="M14 14h2v2h-2z" />
            <path d="M18 14h2v2h-2z" />
            <path d="M14 18h2v2h-2z" />
            <path d="M18 18h2v2h-2z" />
            @break
        @case('check-circle')
            <circle cx="12" cy="12" r="9" />
            <path d="m8 12 2.5 2.5L16.5 8" />
            @break
        @case('languages')
            <path d="M5 8h8" />
            <path d="M9 4v4" />
            <path d="M4 18 9 8l5 10" />
            <path d="M6 14h6" />
            <path d="M15 5h5" />
            <path d="M17.5 5c0 4 1.5 6 3.5 8" />
            <path d="M20 5c0 4-1.5 6-3.5 8" />
            @break
        @case('accessibility')
            <circle cx="12" cy="4" r="2" />
            <path d="M6 8h12" />
            <path d="M12 6v7" />
            <path d="m9 21 3-8 3 8" />
            <path d="m8 13 4-1 4 1" />
            @break
        @case('home')
            <path d="m3 11 9-8 9 8" />
            <path d="M5 10v10h14V10" />
            <path d="M9 20v-6h6v6" />
            @break
        @case('scan')
            <path d="M4 7V4h3" />
            <path d="M17 4h3v3" />
            <path d="M20 17v3h-3" />
            <path d="M7 20H4v-3" />
            <path d="M7 12h10" />
            @break
        @case('route')
            <circle cx="6" cy="6" r="2" />
            <circle cx="18" cy="18" r="2" />
            <path d="M8 6h5a3 3 0 0 1 0 6h-2a3 3 0 0 0 0 6h5" />
            @break
        @case('more')
            <circle cx="5" cy="12" r="1" />
            <circle cx="12" cy="12" r="1" />
            <circle cx="19" cy="12" r="1" />
            @break
        @case('clock')
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3 2" />
            @break
        @case('pin')
            <path d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11Z" />
            <circle cx="12" cy="10" r="2.5" />
            @break
        @case('calendar')
            <path d="M7 3v4" />
            <path d="M17 3v4" />
            <path d="M4 8h16" />
            <path d="M5 5h14a1 1 0 0 1 1 1v14H4V6a1 1 0 0 1 1-1Z" />
            @break
        @case('search')
            <circle cx="11" cy="11" r="7" />
            <path d="m20 20-3.5-3.5" />
            @break
        @case('play')
            <path d="M8 5v14l11-7-11-7Z" />
            @break
        @case('pause')
            <path d="M8 5v14" />
            <path d="M16 5v14" />
            @break
        @case('rewind')
            <path d="m11 19-8-7 8-7v14Z" />
            <path d="m21 19-8-7 8-7v14Z" />
            @break
        @case('forward')
            <path d="m13 5 8 7-8 7V5Z" />
            <path d="m3 5 8 7-8 7V5Z" />
            @break
        @case('share')
            <circle cx="18" cy="5" r="3" />
            <circle cx="6" cy="12" r="3" />
            <circle cx="18" cy="19" r="3" />
            <path d="m8.6 13.5 6.8 4" />
            <path d="m15.4 6.5-6.8 4" />
            @break
        @case('arrow-right')
            <path d="M5 12h14" />
            <path d="m13 5 7 7-7 7" />
            @break
        @case('arrow-left')
            <path d="M19 12H5" />
            <path d="m11 5-7 7 7 7" />
            @break
        @case('menu')
            <path d="M4 6h16" />
            <path d="M4 12h16" />
            <path d="M4 18h16" />
            @break
        @case('close')
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
            @break
        @case('filter')
            <path d="M4 5h16" />
            <path d="M7 12h10" />
            <path d="M10 19h4" />
            @break
        @case('grid')
            <path d="M4 4h7v7H4z" />
            <path d="M13 4h7v7h-7z" />
            <path d="M4 13h7v7H4z" />
            <path d="M13 13h7v7h-7z" />
            @break
        @case('list')
            <path d="M8 6h13" />
            <path d="M8 12h13" />
            <path d="M8 18h13" />
            <path d="M3 6h.01" />
            <path d="M3 12h.01" />
            <path d="M3 18h.01" />
            @break
        @case('mail')
            <path d="M4 5h16v14H4z" />
            <path d="m4 7 8 6 8-6" />
            @break
        @case('phone')
            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19 19 0 0 1-8.3-3 18.7 18.7 0 0 1-5.8-5.8 19 19 0 0 1-3-8.3A2 2 0 0 1 4.7 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.4 2.1L8.8 9.9a15 15 0 0 0 5.3 5.3l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2Z" />
            @break
        @case('camera')
            <path d="M4 8a2 2 0 0 1 2-2h2l1.5-2h5L16 6h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8Z" />
            <circle cx="12" cy="13" r="4" />
            @break
        @case('alert')
            <path d="M12 9v4" />
            <path d="M12 17h.01" />
            <path d="m10.3 3.9-8.1 14A2 2 0 0 0 3.9 21h16.2a2 2 0 0 0 1.7-3.1l-8.1-14a2 2 0 0 0-3.4 0Z" />
            @break
        @default
            <circle cx="12" cy="12" r="9" />
    @endswitch
</svg>
