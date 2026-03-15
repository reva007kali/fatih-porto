<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RHN7H3NJS9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-RHN7H3NJS9');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ ($fav = \App\Models\WebsiteSetting::first()?->favicon) ? asset('storage/' . $fav) : asset('/img/logo.png') }}">
    <title>Sofyan Abdul Fatih | Creative Portfolio</title>

    <!-- Fonts: Bebas Neue (display) + DM Sans (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,300&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /* ─────────────────────────────────────────
           DESIGN TOKENS
        ───────────────────────────────────────── */
        :root {
            --bg: #0a0a0a;
            --bg-2: #0f0f0f;
            --bg-3: #141414;
            --white: #ffffff;
            --border: rgba(255, 255, 255, 0.07);
            --border-h: rgba(255, 255, 255, 0.20);
            --text: rgba(255, 255, 255, 0.80);
            --text-2: rgba(255, 255, 255, 0.38);
            --text-3: rgba(255, 255, 255, 0.18);
            --font-sans: 'DM Sans', system-ui, sans-serif;
            --font-disp: 'Bebas Neue', 'Arial Black', sans-serif;
            --nav-h: 64px;
        }

        /* ─────────────────────────────────────────
           RESET & BASE
        ───────────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* Restore cursor on touch / coarse pointer devices */
        @media (pointer: coarse) {

            html,
            body,
            * {
                cursor: auto !important;
            }
        }

        /* ─────────────────────────────────────────
           GRAIN OVERLAY
           KEY FIX: use a single large static SVG
           tile, no step-animation. We move it with
           translate-only (GPU composite) at a slow
           pace so it feels "alive" without causing
           the full-screen flash / repaint glitch
           that happens when background-position
           jumps in steps.
        ───────────────────────────────────────── */
        #grain {
            position: fixed;
            /* Extend 100px beyond every edge so
               the drift animation never exposes
               a gap at the borders */
            inset: -100px;
            z-index: 9990;
            pointer-events: none;
            user-select: none;
            opacity: 0.038;
            will-change: transform;
            /* Static inline SVG noise — no JS, no external file */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.80' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 240px 240px;
            /* Slow, gentle drift — transform only = GPU layer, zero repaint */
            animation: grainDrift 12s linear infinite;
        }

        @keyframes grainDrift {

            /* We shift by exactly one tile (240px) so
               the pattern is seamless at start & end.
               Diagonal movement reads as "live" grain. */
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(240px, 120px);
            }
        }

        /* ─────────────────────────────────────────
           CUSTOM CURSOR
           Architecture:
           • #cur-dot  — snaps to mouse instantly
                         (no transition, set via CSS var)
           • #cur-ring — lags behind via rAF lerp
                         (CSS var updated each frame)
           Both are positioned with transform only
           so the browser composites on the GPU and
           never triggers layout or paint.
        ───────────────────────────────────────── */
        #cur-dot,
        #cur-ring {
            position: fixed;
            top: 0;
            left: 0;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            /* CSS vars updated by JS each frame */
            transform: translate(var(--cx, -200px), var(--cy, -200px)) translate(-50%, -50%);
            will-change: transform;
        }

        /* Dot — tiny, snaps instantly (no transition) */
        #cur-dot {
            width: 5px;
            height: 5px;
            background: var(--white);
            mix-blend-mode: difference;
            transition: width 0.25s ease, height 0.25s ease, opacity 0.25s ease;
        }

        /* Ring — larger, lags (transition only on size/opacity, NOT position) */
        #cur-ring {
            width: 34px;
            height: 34px;
            border: 1px solid rgba(255, 255, 255, 0.40);
            mix-blend-mode: difference;
            /* IMPORTANT: do NOT transition `transform` here —
               that causes the laggy "rubber band" feel.
               Position is driven purely by rAF lerp. */
            transition: width 0.28s ease,
                height 0.28s ease,
                border-color 0.28s ease,
                opacity 0.28s ease;
        }

        /* Hover state: ring expands, dot fades */
        #cur-dot.hovered {
            width: 3px;
            height: 3px;
            opacity: 0.4;
        }

        #cur-ring.hovered {
            width: 52px;
            height: 52px;
            border-color: rgba(255, 255, 255, 0.20);
        }

        /* Click state */
        #cur-ring.clicked {
            width: 22px;
            height: 22px;
            border-color: rgba(255, 255, 255, 0.80);
        }

        /* On mobile/touch: hide completely */
        @media (hover: none),
        (pointer: coarse) {

            #cur-dot,
            #cur-ring {
                display: none;
            }
        }

        /* ─────────────────────────────────────────
           SCROLLBAR
        ───────────────────────────────────────── */
        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.09);
            border-radius: 9999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.20);
        }

        ::selection {
            background: var(--white);
            color: var(--bg);
        }

        /* ─────────────────────────────────────────
           PROSE CHAT (Livewire chatbot)
        ───────────────────────────────────────── */
        .prose-chat ul {
            list-style: disc;
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            color: var(--text-2);
        }

        .prose-chat ol {
            list-style: decimal;
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            color: var(--text-2);
        }

        .prose-chat p {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .prose-chat a {
            color: var(--white);
            text-decoration: underline;
            font-weight: 600;
        }

        .prose-chat a:hover {
            opacity: 0.6;
        }

        [x-cloak] {
            display: none !important;
        }

        /* ─────────────────────────────────────────
           NAVBAR
        ───────────────────────────────────────── */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 500;
            height: var(--nav-h);
            border-bottom: 1px solid transparent;
            transition: background 0.4s ease, border-color 0.4s ease, backdrop-filter 0.4s ease;
            will-change: background;
        }

        #navbar.scrolled {
            background: rgba(10, 10, 10, 0.88);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-color: var(--border);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        /* Logo */
        .nav-logo {
            font-family: var(--font-disp);
            font-size: 1.5rem;
            letter-spacing: 0.05em;
            text-decoration: none;
            line-height: 1;
            flex-shrink: 0;
            transition: opacity 0.2s;
        }

        .nav-logo:hover {
            opacity: 0.5;
        }

        .nav-logo .dot {
            color: rgba(255, 255, 255, 0.22);
        }

        /* Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
            flex: 1;
            justify-content: center;
        }

        .nav-links a {
            font-size: 0.625rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--text-2);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--white);
        }

        /* Dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dd-btn {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.625rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--text-2);
            background: none;
            border: none;
            cursor: none;
            padding: 0;
            transition: color 0.2s;
        }

        .nav-dd-btn:hover {
            color: var(--white);
        }

        .nav-dd-btn svg {
            width: 8px;
            height: 8px;
            stroke: currentColor;
            transition: transform 0.25s;
        }

        .nav-dropdown:hover .nav-dd-btn svg {
            transform: rotate(180deg);
        }

        .nav-dd-panel {
            position: absolute;
            top: calc(100% + 18px);
            left: 0;
            min-width: 175px;
            background: var(--bg-3);
            border: 1px solid var(--border);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.55);
            opacity: 0;
            pointer-events: none;
            transform: translateY(6px);
            transition: opacity 0.2s, transform 0.2s;
            z-index: 510;
        }

        .nav-dropdown:hover .nav-dd-panel {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .nav-dd-panel a {
            display: block;
            padding: 0.7rem 1rem;
            font-size: 0.5625rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--text-2);
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s, background 0.2s;
        }

        .nav-dd-panel a:last-child {
            border-bottom: none;
        }

        .nav-dd-panel a:hover {
            color: var(--white);
            background: rgba(255, 255, 255, 0.04);
        }

        /* CTA */
        .nav-cta {
            flex-shrink: 0;
            font-size: 0.5625rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem 1.125rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: background 0.2s, border-color 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .nav-cta:hover {
            background: var(--white);
            border-color: var(--white);
            color: var(--bg);
        }

        /* Hamburger */
        #menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 38px;
            height: 38px;
            gap: 5px;
            border: 1px solid var(--border);
            background: transparent;
            cursor: none;
            flex-shrink: 0;
        }

        #menu-toggle span {
            display: block;
            width: 17px;
            height: 1px;
            background: var(--white);
            transition: transform 0.35s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.35s;
        }

        /* ─────────────────────────────────────────
           MOBILE MENU
        ───────────────────────────────────────── */
        #mobile-menu {
            position: fixed;
            inset: 0;
            top: var(--nav-h);
            background: var(--bg);
            z-index: 490;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.55s cubic-bezier(0.77, 0, 0.175, 1);
            overflow-y: auto;
            border-top: 1px solid var(--border);
        }

        #mobile-menu.open {
            transform: translateX(0);
        }

        .mob-link {
            display: block;
            font-family: var(--font-disp);
            font-size: clamp(2.25rem, 8vw, 3.5rem);
            letter-spacing: 0.04em;
            line-height: 1;
            color: rgba(255, 255, 255, 0.70);
            text-decoration: none;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }

        .mob-link:hover {
            color: rgba(255, 255, 255, 0.35);
        }

        .mob-children {
            padding-left: 1.25rem;
        }

        .mob-children a {
            display: block;
            font-size: 0.9375rem;
            font-weight: 400;
            color: var(--text-2);
            text-decoration: none;
            padding: 0.55rem 0;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }

        .mob-children a:hover {
            color: var(--white);
        }

        .mob-cta {
            display: inline-block;
            margin-top: 2.5rem;
            font-size: 0.5625rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--white);
            text-decoration: none;
            padding: 0.875rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            align-self: flex-start;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }

        .mob-cta:hover {
            background: var(--white);
            color: var(--bg);
            border-color: var(--white);
        }

        /* ─────────────────────────────────────────
           FOOTER
        ───────────────────────────────────────── */
        #footer {
            background: var(--bg-2);
            border-top: 1px solid var(--border);
            padding-top: 5rem;
            padding-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .footer-wm {
            position: absolute;
            bottom: -2vw;
            left: 50%;
            transform: translateX(-50%);
            font-family: var(--font-disp);
            font-size: 20vw;
            color: rgba(255, 255, 255, 0.018);
            white-space: nowrap;
            user-select: none;
            pointer-events: none;
            line-height: 1;
            letter-spacing: -0.04em;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 5fr 3fr 4fr;
            gap: 4rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 2rem;
        }

        .footer-logo {
            font-family: var(--font-disp);
            font-size: 1.75rem;
            letter-spacing: 0.04em;
            line-height: 1;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            display: block;
            margin-bottom: 1.25rem;
            transition: opacity 0.2s;
        }

        .footer-logo:hover {
            opacity: 0.45;
        }

        .footer-logo .dot {
            color: rgba(255, 255, 255, 0.20);
        }

        .footer-about {
            font-size: 0.9375rem;
            color: var(--text-3);
            line-height: 1.8;
            font-weight: 300;
            max-width: 28rem;
            margin-bottom: 1.75rem;
        }

        .footer-avail {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .footer-avail-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px rgba(74, 222, 128, 0.45);
            animation: pulseGreen 2.4s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes pulseGreen {

            0%,
            100% {
                opacity: 1;
                box-shadow: 0 0 8px rgba(74, 222, 128, 0.45);
            }

            50% {
                opacity: 0.4;
                box-shadow: 0 0 3px rgba(74, 222, 128, 0.15);
            }
        }

        .footer-avail-label {
            font-size: 0.5625rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--text-3);
        }

        .footer-col-h {
            font-size: 0.5rem;
            font-weight: 700;
            letter-spacing: 0.38em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.14);
            margin-bottom: 1.5rem;
        }

        .footer-nav {
            list-style: none;
        }

        .footer-nav li {
            margin-bottom: 0.85rem;
        }

        .footer-nav a {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--text-2);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-nav a:hover {
            color: var(--white);
        }

        .footer-contact-row {
            margin-bottom: 0.625rem;
        }

        .footer-contact-row a {
            font-size: 0.9375rem;
            font-weight: 300;
            color: var(--text-2);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-contact-row a:hover {
            color: var(--white);
        }

        .footer-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .footer-soc-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }

        .footer-soc-btn:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--border-h);
        }

        .footer-soc-btn img {
            width: 15px;
            height: 15px;
            object-fit: contain;
            opacity: 0.40;
            filter: brightness(0) invert(1);
        }

        .footer-soc-btn span {
            font-size: 0.5rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-2);
            letter-spacing: 0.06em;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .footer-copy {
            font-size: 0.5rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.14);
        }

        .footer-legal {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }

        .footer-legal a {
            font-size: 0.5rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.14);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-legal a:hover {
            color: rgba(255, 255, 255, 0.50);
        }

        /* ─────────────────────────────────────────
           RESPONSIVE
        ───────────────────────────────────────── */
        @media (max-width: 1280px) {

            .nav-inner,
            .footer-inner {
                padding: 0 1.5rem;
            }
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .footer-grid>*:first-child {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {

            .nav-links,
            .nav-cta {
                display: none !important;
            }

            #menu-toggle {
                display: flex;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            .footer-grid>*:first-child {
                grid-column: auto;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }

        @media (max-width: 480px) {

            .nav-inner,
            .footer-inner {
                padding: 0 1.25rem;
            }

            #mobile-menu {
                padding: 2.5rem 1.25rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">


    {{-- ══════════════════════════════════════
         CUSTOM CURSOR
    ══════════════════════════════════════ --}}
    <div id="cur-dot" aria-hidden="true"></div>
    <div id="cur-ring" aria-hidden="true"></div>

    {{-- ══════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════ --}}
    @php
        $navItems = \App\Models\NavigationItem::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();
    @endphp

    <nav id="navbar">
        <div class="nav-inner">

            <a href="/"
                class="nav-logo bg-gradient-to-r from-blue-600 via-purple-500 to-indigo-400 text-transparent bg-clip-text font-black">FATIH<span
                    class="dot">.</span></a>

            <ul class="nav-links">
                @forelse ($navItems as $item)
                    @if ($item->children->isNotEmpty())
                        <li class="nav-dropdown" x-data="{}">
                            <button class="nav-dd-btn">
                                {{ $item->label }}
                                <svg viewBox="0 0 10 10" fill="none" stroke-width="1.8">
                                    <path d="M2 3.5l3 3 3-3" />
                                </svg>
                            </button>
                            <div class="nav-dd-panel">
                                @foreach ($item->children as $child)
                                    <a href="{{ $child->url }}">{{ $child->label }}</a>
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li><a href="{{ $item->url }}">{{ $item->label }}</a></li>
                    @endif
                @empty
                    <li><a href="#works">Works</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                @endforelse
            </ul>

            <a href="/#contact"
                class="px-3 hidden md:inline-block py-1 text-xs font-bold uppercase bg-gradient-to-r from-blue-600 via-purple-500 to-indigo-400 rounded-full">Let's
                Talk</a>

            <button id="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

        </div>
    </nav>

    {{-- ══════════════════════════════════════
         MOBILE MENU
    ══════════════════════════════════════ --}}
    <div id="mobile-menu" aria-hidden="true">
        @forelse ($navItems as $item)
            @if ($item->children->isNotEmpty())
                <div x-data="{ expanded: false }">
                    <button @click="expanded = !expanded" class="mob-link"
                        style="width:100%;text-align:left;background:none;border:none;
                               border-bottom:1px solid var(--border);cursor:none;
                               display:flex;align-items:center;justify-content:space-between;">
                        {{ $item->label }}
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor"
                            stroke-width="1.5" :class="expanded ? 'rotate-180' : ''"
                            style="transition:transform 0.3s;flex-shrink:0;">
                            <path d="M3 5.5l4 4 4-4" />
                        </svg>
                    </button>
                    <div x-show="expanded" x-collapse class="mob-children">
                        @foreach ($item->children as $child)
                            <a href="{{ $child->url }}">{{ $child->label }}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $item->url }}" class="mob-link">{{ $item->label }}</a>
            @endif
        @empty
            <a href="#works" class="mob-link">Works</a>
            <a href="#services" class="mob-link">Services</a>
            <a href="#about" class="mob-link">About</a>
        @endforelse

        <a href="/#contact" class="mob-cta">Let's Talk</a>
    </div>

    {{-- ══════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════ --}}
    <main style="">
        {{ $slot }}
    </main>

    {{-- ══════════════════════════════════════
         FOOTER
    ══════════════════════════════════════ --}}
    @php
        $footerSettings = \App\Models\FooterSetting::first();
        $footerDetails = $footerSettings->social_links ?? [];
        $footerSocialLinks = \App\Models\SocialLink::where('is_active', true)->orderBy('sort_order')->get();
    @endphp

    <footer id="footer">
        <div class="footer-wm">{{ $footerDetails['watermark_text'] ?? 'FATIH' }}</div>

        <div class="footer-inner">
            <div class="footer-grid">

                {{-- Brand --}}
                <div>
                    <a href="/" class="footer-logo">FATIH<span class="dot">.</span></a>
                    <p class="footer-about">
                        {{ $footerSettings->about_text ?? 'Transforming concepts into compelling visual narratives through advanced motion graphics and cinematic editing.' }}
                    </p>
                    <div class="footer-avail">
                        <span class="footer-avail-dot"></span>
                        <span class="footer-avail-label">
                            {{ $footerDetails['availability_text'] ?? 'Available for projects' }}
                        </span>
                    </div>
                </div>

                {{-- Navigation --}}
                <div>
                    <p class="footer-col-h">Navigation</p>
                    <ul class="footer-nav">
                        @forelse ($navItems as $item)
                            <li><a href="{{ $item->url }}">{{ $item->label }}</a></li>
                        @empty
                            <li><a href="#works">Works</a></li>
                            <li><a href="#services">Expertise</a></li>
                            <li><a href="#about">My Story</a></li>
                        @endforelse
                    </ul>
                </div>

                {{-- Connect --}}
                <div>
                    <p class="footer-col-h">Connect</p>

                    @if ($footerDetails['email'] ?? false)
                        <div class="footer-contact-row">
                            <a href="mailto:{{ $footerDetails['email'] }}">{{ $footerDetails['email'] }}</a>
                        </div>
                    @endif

                    @if ($footerDetails['phone'] ?? false)
                        <div class="footer-contact-row">
                            <a
                                href="tel:{{ str_replace(' ', '', $footerDetails['phone']) }}">{{ $footerDetails['phone'] }}</a>
                        </div>
                    @endif

                    <div class="footer-socials">
                        @foreach ($footerSocialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener" class="footer-soc-btn">
                                @if ($link->icon)
                                    <img src="{{ asset('storage/' . $link->icon) }}" alt="{{ $link->platform }}">
                                @else
                                    <span>{{ substr($link->platform, 0, 2) }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                <p class="footer-copy">&copy; {{ $footerSettings->copyright_text }}</p>
                <ul class="footer-legal">
                    <li><a href="{{ route('privacy-policy') }}">Privacy</a></li>
                    <li><a href="{{ route('terms-of-service') }}">Terms</a></li>
                </ul>
            </div>
        </div>
    </footer>

    {{-- <livewire:chat-bot /> --}}

    <script>
   
        (function() {
            const dot = document.getElementById('cur-dot');
            const ring = document.getElementById('cur-ring');
            if (!dot || !ring) return;

            // Check for coarse pointer (touch) — bail early
            if (window.matchMedia('(pointer: coarse)').matches) return;

            let mouseX = -200,
                mouseY = -200; // raw mouse position
            let ringX = -200,
                ringY = -200; // ring's current lerped position

            const LERP_FACTOR = 0.12; // 0 = stuck, 1 = instant. 0.12 = silky lag

            function lerp(a, b, t) {
                return a + (b - a) * t;
            }

            // ── Capture mouse, update dot immediately ──
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                // Dot snaps instantly (no rAF needed — mousemove fires per frame anyway)
                dot.style.setProperty('--cx', mouseX + 'px');
                dot.style.setProperty('--cy', mouseY + 'px');
            }, {
                passive: true
            });

            // ── rAF loop for ring only ──
            let rafId;

            function tick() {
                ringX = lerp(ringX, mouseX, LERP_FACTOR);
                ringY = lerp(ringY, mouseY, LERP_FACTOR);
                ring.style.setProperty('--cx', ringX.toFixed(2) + 'px');
                ring.style.setProperty('--cy', ringY.toFixed(2) + 'px');
                rafId = requestAnimationFrame(tick);
            }
            rafId = requestAnimationFrame(tick);

            // ── Hover detection via event delegation ──
            const HOVER_SELECTOR = 'a, button, input, textarea, select, label, [data-cursor-hover]';

            document.addEventListener('mouseover', (e) => {
                if (e.target.closest(HOVER_SELECTOR)) {
                    dot.classList.add('hovered');
                    ring.classList.add('hovered');
                }
            });
            document.addEventListener('mouseout', (e) => {
                if (e.target.closest(HOVER_SELECTOR)) {
                    dot.classList.remove('hovered');
                    ring.classList.remove('hovered');
                }
            });

            // ── Click pulse ──
            document.addEventListener('mousedown', () => {
                ring.classList.add('clicked');
                ring.classList.remove('hovered');
            });
            document.addEventListener('mouseup', () => {
                ring.classList.remove('clicked');
            });

            // ── Hide when leaving window ──
            document.addEventListener('mouseleave', () => {
                dot.style.opacity = '0';
                ring.style.opacity = '0';
            });
            document.addEventListener('mouseenter', () => {
                dot.style.opacity = '';
                ring.style.opacity = '';
            });

            // ── Re-run hover check after Livewire navigation ──
            document.addEventListener('livewire:navigated', () => {
                dot.classList.remove('hovered', 'clicked');
                ring.classList.remove('hovered', 'clicked');
            });
        })();


        /* ════════════════════════════════════════════════
           NAVBAR SCROLL
        ════════════════════════════════════════════════ */
        (function() {
            const navbar = document.getElementById('navbar');
            if (!navbar) return;
            let last = false;
            window.addEventListener('scroll', () => {
                const s = window.scrollY > 30;
                if (s !== last) {
                    last = s;
                    navbar.classList.toggle('scrolled', s);
                }
            }, {
                passive: true
            });
        })();


        /* ════════════════════════════════════════════════
           MOBILE MENU
        ════════════════════════════════════════════════ */
        (function() {
            const toggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('mobile-menu');
            if (!toggle || !menu) return;

            const spans = toggle.querySelectorAll('span');
            let open = false;

            function setOpen(state) {
                open = state;
                menu.classList.toggle('open', state);
                menu.setAttribute('aria-hidden', String(!state));
                toggle.setAttribute('aria-expanded', String(state));
                document.body.style.overflow = state ? 'hidden' : '';

                spans[0].style.transform = state ? 'translateY(6px) rotate(45deg)' : '';
                spans[1].style.opacity = state ? '0' : '';
                spans[2].style.transform = state ? 'translateY(-6px) rotate(-45deg)' : '';
            }

            toggle.addEventListener('click', () => setOpen(!open));

            document.querySelectorAll('#mobile-menu a').forEach(a => {
                a.addEventListener('click', () => setOpen(false));
            });
        })();
    </script>

    @livewireScripts
    @livewireScriptConfig
</body>

</html>
