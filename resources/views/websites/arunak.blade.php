{{-- resources/views/real-estate-cinematic.blade.php --}}
<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NOCTURNE ESTATES — Cinematic Luxury Real Estate</title>
  <meta name="description" content="Dark cinematic modern luxury real estate website (static dummy data). Swiss grid, refined typography, premium spacing." />

  {{-- Tailwind CDN for single-file demo --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['Space Grotesk', 'ui-sans-serif', 'system-ui'],
            sans: ['Inter', 'ui-sans-serif', 'system-ui'],
          },
          colors: {
            cine: {
              bg: '#070B14',        // deep charcoal blue
              panel: '#0C1324',     // panel
              panel2: '#0A1020',    // deeper panel
              line: 'rgba(243,242,238,.10)',
              text: '#F3F2EE',      // soft off-white
              muted: 'rgba(243,242,238,.72)',
              teal: '#2A6F73',      // desaturated teal
              amber: '#D6A25F',     // warm amber accents
              ink: '#0B1222'
            }
          },
          boxShadow: {
            luxe: '0 18px 60px rgba(0,0,0,.45)',
            lift: '0 14px 40px rgba(0,0,0,.35)',
            hair: '0 0 0 1px rgba(243,242,238,.10)',
          },
          letterSpacing: {
            luxe: '.18em'
          }
        }
      }
    }
  </script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

  <style>
    /* ---- Theme tokens (default = cinematic dark) ---- */
    :root{
      --bg: 7 11 20;                 /* #070B14 */
      --panel: 12 19 36;             /* #0C1324 */
      --panel2: 10 16 32;            /* #0A1020 */
      --text: 243 242 238;           /* #F3F2EE */
      --muted: 243 242 238 / .72;
      --line: 243 242 238 / .10;
      --teal: 42 111 115;            /* #2A6F73 */
      --amber: 214 162 95;           /* #D6A25F */
      --glass: 255 255 255 / .06;
      --glass2: 255 255 255 / .03;
      --focus: 0 0 0 3px rgba(214,162,95,.22);
    }

    /* Optional light mode (kept premium + minimal; toggle button provided) */
    html[data-theme="light"]{
      --bg: 246 247 251;
      --panel: 255 255 255;
      --panel2: 248 249 252;
      --text: 10 16 28;
      --muted: 10 16 28 / .70;
      --line: 10 16 28 / .12;
      --glass: 10 16 28 / .05;
      --glass2: 10 16 28 / .03;
      --focus: 0 0 0 3px rgba(42,111,115,.20);
    }

    body{
      background:
        radial-gradient(1200px 700px at 15% -10%, rgb(var(--teal) / .20), transparent 60%),
        radial-gradient(900px 600px at 100% 0%, rgb(var(--amber) / .10), transparent 58%),
        linear-gradient(180deg, rgb(var(--bg)), rgb(var(--bg)));
      color: rgb(var(--text));
    }

    /* Subtle cinematic grain */
    .grain:before{
      content:"";
      position:absolute; inset:0;
      pointer-events:none;
      background-image: url("https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?auto=format&fit=crop&w=1200&q=40");
      opacity:.06;
      mix-blend-mode: overlay;
      filter: grayscale(1) contrast(1.1);
    }

    .ringline{ box-shadow: 0 0 0 1px rgb(var(--line)); }
    .hairline{ border-color: rgb(var(--line)); }
    .muted{ color: rgb(var(--muted)); }
    .panel{ background: rgb(var(--panel)); }
    .panel2{ background: rgb(var(--panel2)); }

    .glass{
      background: linear-gradient(180deg, rgb(var(--glass)), rgb(var(--glass2)));
      backdrop-filter: blur(10px);
    }

    .focusable:focus-visible{ outline:none; box-shadow: var(--focus); }
    .no-scrollbar::-webkit-scrollbar{ display:none; }
    .no-scrollbar{ -ms-overflow-style:none; scrollbar-width:none; }

    /* Swiss grid feel: consistent gutters + max width */
    .wrap{ max-width: 1180px; margin: 0 auto; padding: 0 1rem; }

    /* Hero overlay (cool exterior + warm interior glow) */
    .hero-overlay{
      background:
        radial-gradient(900px 600px at 70% 40%, rgb(var(--amber) / .16), transparent 55%),
        radial-gradient(850px 520px at 25% 15%, rgb(var(--teal) / .24), transparent 62%),
        linear-gradient(180deg, rgba(0,0,0,.62), rgba(0,0,0,.55) 40%, rgba(0,0,0,.70));
    }
    html[data-theme="light"] .hero-overlay{
      background:
        radial-gradient(900px 600px at 70% 40%, rgba(214,162,95,.18), transparent 55%),
        radial-gradient(850px 520px at 25% 15%, rgba(42,111,115,.16), transparent 62%),
        linear-gradient(180deg, rgba(255,255,255,.18), rgba(255,255,255,.06) 45%, rgba(255,255,255,.22));
    }

    /* Wet-ground reflection vibe (subtle) */
    .reflection{
      background:
        linear-gradient(180deg, rgba(255,255,255,0), rgba(255,255,255,.04)),
        radial-gradient(700px 120px at 50% 0%, rgba(214,162,95,.14), transparent 60%);
      opacity:.7;
    }

    /* Clamp hero headline */
    .hero-h1{
      font-size: clamp(2.1rem, 3.2vw + 1rem, 4.1rem);
      line-height: 1.0;
      letter-spacing: .06em;
      text-transform: uppercase;
    }

    /* Modal */
    .modal-backdrop{ background: rgba(0,0,0,.62); }
  </style>
</head>

@php
  $brand = [
    'name' => 'NOCTURNE ESTATES',
    'tagline' => 'Modern Luxury • Architectural Representation',
    'phone' => '+1 (212) 555-0189',
    'email' => 'private@nocturne-estates.test',
    'address' => '1180 Meridian Ave, New York, NY',
  ];

  $services = [
    ['n'=>'01', 'title'=>'Private Acquisition', 'desc'=>'Off-market sourcing and discreet negotiation.', 'img'=>'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=1400&q=80'],
    ['n'=>'02', 'title'=>'Architectural Curation', 'desc'=>'Modern builds, signature materials, timeless lines.', 'img'=>'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1400&q=80'],
    ['n'=>'03', 'title'=>'Investment Advisory', 'desc'=>'Yield-focused guidance with long-term value strategy.', 'img'=>'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1400&q=80'],
    ['n'=>'04', 'title'=>'Staging & Visuals', 'desc'=>'Cinematic photography and premium presentation.', 'img'=>'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1400&q=80'],
  ];

  $listings = [
    [
      'name'=>'Glassridge Residence',
      'loc'=>'Pacific Heights',
      'price'=>'$8.90M',
      'meta'=>['5 Beds','6 Baths','6,120 sqft'],
      'img'=>'https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?auto=format&fit=crop&w=2400&q=80',
      'accent'=>'amber'
    ],
    [
      'name'=>'Courtyard Atrium Home',
      'loc'=>'West Chelsea',
      'price'=>'$5.40M',
      'meta'=>['4 Beds','4 Baths','3,980 sqft'],
      'img'=>'https://images.unsplash.com/photo-1501183638710-841dd1904471?auto=format&fit=crop&w=2400&q=80',
      'accent'=>'teal'
    ],
    [
      'name'=>'Duskline Penthouse',
      'loc'=>'Tribeca',
      'price'=>'$12.75M',
      'meta'=>['3 Beds','4 Baths','4,450 sqft'],
      'img'=>'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=2400&q=80',
      'accent'=>'amber'
    ],
  ];

  $gallery = [
    'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1505692952047-1a78307da8f2?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1600&q=80',
  ];

  $team = [
    ['name'=>'Sloane Mercer', 'role'=>'Principal Broker', 'img'=>'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80'],
    ['name'=>'Elliot Vaughn', 'role'=>'Architectural Advisor', 'img'=>'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=1200&q=80'],
    ['name'=>'Amara Lin', 'role'=>'Client Concierge', 'img'=>'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80'],
  ];

  $pricing = [
    ['name'=>'Essentials', 'price'=>'1.5%', 'desc'=>'For select purchases with direct representation.', 'items'=>['Shortlist & tours','Offer strategy','Closing support']],
    ['name'=>'Signature', 'price'=>'2.5%', 'desc'=>'Full-service acquisition with architecture-led curation.', 'items'=>['Off-market sourcing','Due diligence pack','Renovation roadmap']],
    ['name'=>'Black Label', 'price'=>'Custom', 'desc'=>'Discreet portfolio handling for multi-asset clients.', 'items'=>['Private channels','Cross-market search','Family-office reporting']],
  ];

  $faq = [
    ['q'=>'Do you work with off-market listings?', 'a'=>'Yes. A significant portion of our inventory is private. We operate through vetted networks, architects, and discreet introductions. (Dummy copy)'],
    ['q'=>'Can you support international buyers?', 'a'=>'Yes. We coordinate legal, tax, and finance partners and provide remote walkthroughs and documentation. (Dummy copy)'],
    ['q'=>'How do private viewings work?', 'a'=>'Request a time window. We confirm availability, provide NDAs when needed, and arrange a quiet, curated tour. (Dummy copy)'],
    ['q'=>'What makes your selection different?', 'a'=>'We prioritize architectural integrity: proportion, material honesty, light, privacy, and long-term value. (Dummy copy)'],
  ];

  $testimonials = [
    ['name'=>'Client A.', 'role'=>'Founder, Tech', 'quote'=>'A calm, authoritative process. The curation was exact—nothing noisy, nothing wasted.'],
    ['name'=>'Client B.', 'role'=>'Investor', 'quote'=>'Discreet, precise, and visually impeccable. The presentation alone felt museum-grade.'],
    ['name'=>'Client C.', 'role'=>'Creative Director', 'quote'=>'The warm interior glow, the cool exterior—every viewing felt cinematic. We found our home quickly.'],
  ];

  $posts = [
    ['title'=>'Quiet Luxury: The New Modern Estate', 'date'=>'Jun 2026', 'img'=>'https://images.unsplash.com/photo-1460317442991-0ec209397118?auto=format&fit=crop&w=1600&q=80'],
    ['title'=>'Glass, Light, and Privacy: A Modern Balance', 'date'=>'May 2026', 'img'=>'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80'],
    ['title'=>'Materials That Age Well (and Why It Matters)', 'date'=>'Apr 2026', 'img'=>'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1600&q=80'],
  ];
@endphp

<body class="font-sans">
  {{-- NAV --}}
  <header class="sticky top-0 z-50">
    <div class="border-b hairline bg-[rgb(var(--bg)/.65)] backdrop-blur">
      <div class="wrap">
        <div class="flex items-center justify-between py-4 gap-3">
          <a href="#top" class="flex items-center gap-3 focusable rounded-xl">
            <div class="h-10 w-10 rounded-2xl ringline grid place-items-center glass shadow-hair">
              <span class="font-display font-semibold tracking-wide text-[rgb(var(--text))]">NE</span>
            </div>
            <div class="leading-tight hidden sm:block">
              <div class="font-display font-semibold tracking-[.16em] text-sm uppercase">
                {{ $brand['name'] }}
              </div>
              <div class="text-xs muted">{{ $brand['tagline'] }}</div>
            </div>
          </a>

          <nav class="hidden lg:flex items-center gap-7">
            @foreach(['Listings'=>'#listings','Services'=>'#services','Plans'=>'#plans','Gallery'=>'#gallery','Team'=>'#team','Pricing'=>'#pricing','Contact'=>'#contact'] as $label => $href)
              <a href="{{ $href }}"
                 class="text-[11px] font-medium uppercase tracking-[.22em] muted hover:text-[rgb(var(--text))] transition focusable rounded-lg">
                {{ $label }}
              </a>
            @endforeach
          </nav>

          <div class="flex items-center gap-2">
            <button type="button"
              class="hidden sm:inline-flex px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-medium hover:shadow-luxe transition focusable"
              data-theme-toggle>
              Theme
            </button>

            <a href="#contact"
              class="px-4 py-2 rounded-xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable">
              Request Viewing
            </a>

            <button type="button"
              class="lg:hidden px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-medium focusable"
              data-mobile-toggle aria-expanded="false" aria-controls="mobileMenu">
              Menu
            </button>
          </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden pb-4" data-mobile-menu>
          <div class="grid gap-2">
            @foreach(['Listings'=>'#listings','Services'=>'#services','Plans'=>'#plans','Gallery'=>'#gallery','Team'=>'#team','Pricing'=>'#pricing','Contact'=>'#contact'] as $label => $href)
              <a href="{{ $href }}"
                 class="px-4 py-3 rounded-2xl ringline glass text-[11px] uppercase tracking-[.22em] font-medium hover:shadow-luxe transition focusable"
                 data-mobile-link>
                {{ $label }}
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- HERO --}}
  <section id="top" class="relative">
    <div class="relative min-h-screen lg:min-h-[88vh] overflow-hidden">
      {{-- Hero image (contemporary glass house at dusk) --}}
      <div class="absolute inset-0 bg-center bg-cover"
           style="background-image:url('https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?auto=format&fit=crop&w=2600&q=80');">
      </div>

      {{-- Cool cinematic overlay + warm amber glow --}}
      <div class="absolute inset-0 hero-overlay"></div>

      {{-- Subtle grain --}}
      <div class="absolute inset-0 grain"></div>

      {{-- Content --}}
      <div class="relative wrap pt-16 lg:pt-24 pb-16">
        <div class="grid grid-cols-12 gap-6 lg:gap-10 items-end">
          <div class="col-span-12 lg:col-span-10 lg:col-start-2 text-center">
            <p class="text-[11px] uppercase tracking-[.28em] muted">
              Modern Architectural Representation • Private Listings • Discreet Acquisition
            </p>

            <h1 class="hero-h1 font-display font-semibold mt-4 text-[rgb(var(--text))]">
              CINEMATIC MODERN LUXURY REAL ESTATE
            </h1>

            <p class="mt-5 text-sm md:text-base muted max-w-3xl mx-auto">
              Calm authority, quiet luxury, and architectural minimalism — presented with Swiss-grid precision and refined spacing.
              (Static dummy content.)
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
              <a href="#listings"
                 class="px-6 py-3 rounded-2xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable">
                Explore Listings
              </a>
              <a href="#plans"
                 class="px-6 py-3 rounded-2xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold hover:shadow-luxe transition focusable">
                View House Plans
              </a>
            </div>
          </div>

          {{-- Reflection strip --}}
          <div class="col-span-12 lg:col-span-10 lg:col-start-2 mt-10">
            <div class="rounded-3xl ringline overflow-hidden shadow-luxe">
              <div class="glass p-5 md:p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 text-left">
                  @foreach([
                    ['k'=>'Curated Homes','v'=>'36'],
                    ['k'=>'Avg. Days to Close','v'=>'21'],
                    ['k'=>'Private Network','v'=>'240+'],
                    ['k'=>'Client Satisfaction','v'=>'4.9/5'],
                  ] as $stat)
                    <div class="rounded-2xl panel2 ringline p-4">
                      <div class="text-[10px] uppercase tracking-[.24em] muted">{{ $stat['k'] }}</div>
                      <div class="mt-2 text-xl md:text-2xl font-display font-semibold">{{ $stat['v'] }}</div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="h-10 reflection"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- MAIN --}}
  <main class="wrap py-16 lg:py-20 space-y-16 lg:space-y-20">

    {{-- FEATURED LISTINGS (modular cards, generous negative space) --}}
    <section id="listings" class="space-y-7">
      <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
          <p class="text-[11px] uppercase tracking-[.28em] muted">Selected</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Featured Listings
          </h2>
        </div>
        <div class="text-[11px] uppercase tracking-[.22em] muted">
          Deep charcoal • Desaturated teal • Soft off-white • Amber glow
        </div>
      </div>

      <div class="grid grid-cols-12 gap-5 lg:gap-6">
        @foreach($listings as $i => $l)
          <article class="col-span-12 lg:col-span-4 rounded-3xl overflow-hidden ringline shadow-lift panel">
            <div class="relative h-56">
              <img src="{{ $l['img'] }}" alt="{{ $l['name'] }}" class="absolute inset-0 w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-black/0"></div>

              <div class="absolute top-4 left-4">
                <span class="px-3 py-1.5 rounded-full ringline glass text-[10px] uppercase tracking-[.22em] font-medium">
                  Private • {{ $l['loc'] }}
                </span>
              </div>

              <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-3">
                <div>
                  <div class="font-display font-semibold text-lg">{{ $l['name'] }}</div>
                  <div class="text-xs muted">{{ $l['loc'] }}</div>
                </div>
                <div class="text-right">
                  <div class="text-[10px] uppercase tracking-[.22em] muted">From</div>
                  <div class="font-display font-semibold text-lg">{{ $l['price'] }}</div>
                </div>
              </div>
            </div>

            <div class="p-5">
              <div class="flex flex-wrap gap-2">
                @foreach($l['meta'] as $m)
                  <span class="px-3 py-2 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[11px] uppercase tracking-[.18em] font-medium">
                    {{ $m }}
                  </span>
                @endforeach
              </div>

              <div class="mt-4 flex items-center justify-between gap-3">
                <button type="button"
                        class="px-4 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold hover:shadow-luxe transition focusable"
                        data-open-listing
                        data-title="{{ $l['name'] }}"
                        data-location="{{ $l['loc'] }}"
                        data-price="{{ $l['price'] }}"
                        data-image="{{ $l['img'] }}">
                  Preview
                </button>
                <a href="#contact"
                   class="text-[11px] uppercase tracking-[.22em] font-semibold text-[rgb(var(--text))] hover:opacity-90 focusable rounded-lg">
                  Request details →
                </a>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    {{-- SERVICES (4 columns with numbered labels + thumbnails) --}}
    <section id="services" class="space-y-7">
      <div class="grid grid-cols-12 gap-6 items-end">
        <div class="col-span-12 lg:col-span-6">
          <p class="text-[11px] uppercase tracking-[.28em] muted">Services</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Discreet, Architectural, Precise
          </h2>
        </div>
        <div class="col-span-12 lg:col-span-6 muted text-sm">
          A structured four-part offering: acquisition, curation, advisory, and presentation —
          executed with quiet confidence. (Dummy copy.)
        </div>
      </div>

      <div class="grid grid-cols-12 gap-5 lg:gap-6">
        @foreach($services as $s)
          <div class="col-span-12 md:col-span-6 xl:col-span-3 rounded-3xl ringline panel overflow-hidden shadow-lift">
            <div class="relative h-40">
              <img src="{{ $s['img'] }}" alt="{{ $s['title'] }}" class="absolute inset-0 w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-black/10"></div>
              <div class="absolute top-4 left-4 flex items-center gap-2">
                <span class="font-display font-semibold text-[12px] tracking-[.22em] uppercase">{{ $s['n'] }}</span>
                <span class="h-[1px] w-10 bg-white/30"></span>
              </div>
            </div>
            <div class="p-5">
              <h3 class="font-display font-semibold text-lg">{{ $s['title'] }}</h3>
              <p class="mt-1 muted text-sm">{{ $s['desc'] }}</p>
              <p class="mt-4 text-[10px] uppercase tracking-[.26em] muted">
                Refined minimal caption • Architectural thumbnail
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- HOUSE PLAN (dark panel + “3D top view floor plan render” + glow highlights) --}}
    <section id="plans" class="rounded-[28px] ringline shadow-luxe overflow-hidden">
      <div class="panel2">
        <div class="grid grid-cols-12 gap-6 lg:gap-10 p-6 md:p-8 lg:p-10 items-center">
          <div class="col-span-12 lg:col-span-5">
            <p class="text-[11px] uppercase tracking-[.28em] muted">House Plan</p>
            <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
              Top-View Layout — Balanced Symmetry
            </h2>
            <p class="mt-3 muted text-sm">
              A modern plan presentation with soft glow highlights and generous spacing. Replace this dummy render with your real 3D plan.
            </p>

            <div class="mt-6 grid grid-cols-2 gap-3">
              @foreach([
                ['k'=>'Total Area','v'=>'6,120 sqft'],
                ['k'=>'Bedrooms','v'=>'5'],
                ['k'=>'Ceiling Height','v'=>'3.2m'],
                ['k'=>'Outdoor','v'=>'Pool + Courtyard'],
              ] as $x)
                <div class="rounded-2xl ringline bg-[rgb(var(--panel))] p-4">
                  <div class="text-[10px] uppercase tracking-[.24em] muted">{{ $x['k'] }}</div>
                  <div class="mt-2 font-display font-semibold">{{ $x['v'] }}</div>
                </div>
              @endforeach
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
              <a href="#contact"
                 class="px-5 py-3 rounded-2xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable">
                Request plan pack
              </a>
              <a href="#gallery"
                 class="px-5 py-3 rounded-2xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold hover:shadow-luxe transition focusable">
                View interiors
              </a>
            </div>
          </div>

          <div class="col-span-12 lg:col-span-7">
            <div class="relative rounded-3xl ringline overflow-hidden shadow-lift">
              {{-- Use a “plan-like” render; swap with your real 3D top view --}}
              <img
                src="https://images.unsplash.com/photo-1623298317883-6b70254edf31?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="3D top-view floor plan render (placeholder)"
                class="w-full h-[360px] md:h-[420px] object-cover"
              />

              {{-- Glow highlights overlay --}}
              <div class="absolute inset-0"
                   style="background:
                    radial-gradient(420px 240px at 30% 40%, rgba(214,162,95,.18), transparent 60%),
                    radial-gradient(380px 220px at 75% 55%, rgba(42,111,115,.18), transparent 62%),
                    linear-gradient(180deg, rgba(0,0,0,.28), rgba(0,0,0,.18), rgba(0,0,0,.32));">
              </div>

              <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between gap-3">
                <span class="px-3 py-2 rounded-2xl ringline glass text-[10px] uppercase tracking-[.26em] font-medium">
                  Render • Top view • Placeholder
                </span>
                <span class="px-3 py-2 rounded-2xl ringline glass text-[10px] uppercase tracking-[.26em] font-medium">
                  Soft glow • Quiet contrast
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- GALLERY (Swiss grid + negative space) --}}
    <section id="gallery" class="space-y-7">
      <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
          <p class="text-[11px] uppercase tracking-[.28em] muted">Gallery</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Architectural Photography
          </h2>
        </div>
        <button type="button"
          class="px-4 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold hover:shadow-luxe transition focusable"
          data-open-lightbox-first>
          Open preview
        </button>
      </div>

      <div class="grid grid-cols-12 gap-4 lg:gap-5">
        @foreach($gallery as $idx => $img)
          <button type="button"
                  class="col-span-12 sm:col-span-6 lg:col-span-4 rounded-3xl overflow-hidden ringline shadow-lift panel focusable"
                  data-gallery-item
                  data-src="{{ $img }}"
                  data-title="Gallery Frame {{ str_pad($idx+1, 2, '0', STR_PAD_LEFT) }}">
            <div class="relative h-56">
              <img src="{{ $img }}" alt="Gallery image {{ $idx+1 }}" class="absolute inset-0 w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-black/0"></div>
              <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-[.26em] font-medium muted">Frame</span>
                <span class="text-[10px] uppercase tracking-[.26em] font-medium text-[rgb(var(--text))]">
                  {{ str_pad($idx+1, 2, '0', STR_PAD_LEFT) }}
                </span>
              </div>
            </div>
          </button>
        @endforeach
      </div>
    </section>

    {{-- TEAM --}}
    <section id="team" class="space-y-7">
      <div class="grid grid-cols-12 gap-6 items-end">
        <div class="col-span-12 lg:col-span-6">
          <p class="text-[11px] uppercase tracking-[.28em] muted">Team</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Calm Authority, Human Precision
          </h2>
        </div>
        <div class="col-span-12 lg:col-span-6 muted text-sm">
          A small team designed for premium throughput: fewer touches, higher clarity. (Dummy copy.)
        </div>
      </div>

      <div class="grid grid-cols-12 gap-5 lg:gap-6">
        @foreach($team as $m)
          <article class="col-span-12 md:col-span-6 xl:col-span-4 rounded-3xl ringline panel overflow-hidden shadow-lift">
            <div class="h-52 bg-center bg-cover" style="background-image:url('{{ $m['img'] }}')"></div>
            <div class="p-5">
              <div class="font-display font-semibold text-lg">{{ $m['name'] }}</div>
              <div class="text-sm muted mt-1">{{ $m['role'] }}</div>
              <div class="mt-4 flex items-center justify-between">
                <span class="text-[10px] uppercase tracking-[.26em] muted">Verified</span>
                <span class="text-[10px] uppercase tracking-[.26em] text-[rgb(var(--amber))]">Private Network</span>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    {{-- PRICING --}}
    <section id="pricing" class="space-y-7">
      <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
          <p class="text-[11px] uppercase tracking-[.28em] muted">Pricing</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Representation Tiers
          </h2>
        </div>
        <div class="text-[11px] uppercase tracking-[.22em] muted">Dummy pricing • Replace with real terms</div>
      </div>

      <div class="grid grid-cols-12 gap-5 lg:gap-6">
        @foreach($pricing as $i => $p)
          <div class="col-span-12 lg:col-span-4 rounded-3xl ringline panel shadow-lift overflow-hidden">
            <div class="p-6">
              <div class="flex items-baseline justify-between gap-4">
                <div>
                  <div class="text-[11px] uppercase tracking-[.28em] muted">Tier {{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</div>
                  <div class="mt-2 font-display font-semibold text-xl">{{ $p['name'] }}</div>
                </div>
                <div class="text-right">
                  <div class="text-[10px] uppercase tracking-[.26em] muted">Fee</div>
                  <div class="font-display font-semibold text-xl" style="color: rgb(var(--amber));">{{ $p['price'] }}</div>
                </div>
              </div>

              <p class="mt-3 muted text-sm">{{ $p['desc'] }}</p>

              <div class="mt-5 grid gap-2">
                @foreach($p['items'] as $it)
                  <div class="flex items-center justify-between rounded-2xl ringline bg-[rgb(var(--panel2))] px-4 py-3">
                    <span class="text-[11px] uppercase tracking-[.18em] font-medium">{{ $it }}</span>
                    <span class="h-1.5 w-1.5 rounded-full" style="background: rgb(var(--teal));"></span>
                  </div>
                @endforeach
              </div>

              <a href="#contact"
                 class="mt-6 inline-flex w-full justify-center px-5 py-3 rounded-2xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable">
                Inquire
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- TESTIMONIALS + FAQ (Swiss grid, negative space) --}}
    <section class="grid grid-cols-12 gap-5 lg:gap-6">
      <div class="col-span-12 lg:col-span-7 rounded-3xl ringline panel shadow-lift p-6 md:p-7">
        <div class="flex items-end justify-between gap-4">
          <div>
            <p class="text-[11px] uppercase tracking-[.28em] muted">Testimonials</p>
            <h2 class="font-display text-2xl font-semibold tracking-tight">Client Notes</h2>
          </div>
          <div class="flex gap-2">
            <button class="px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold focusable" data-t-prev>Prev</button>
            <button class="px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold focusable" data-t-next>Next</button>
          </div>
        </div>

        <div class="mt-5 rounded-3xl ringline bg-[rgb(var(--panel2))] p-6">
          <p class="font-display text-xl md:text-2xl font-medium leading-snug" data-t-quote></p>
          <div class="mt-5 flex items-center justify-between">
            <div>
              <div class="text-[11px] uppercase tracking-[.26em] muted">Client</div>
              <div class="mt-1 font-display font-semibold" data-t-name></div>
              <div class="text-sm muted" data-t-role></div>
            </div>
            <div class="text-[rgb(var(--amber))] font-display font-semibold tracking-[.08em]">★★★★★</div>
          </div>
        </div>
      </div>

      <div class="col-span-12 lg:col-span-5 rounded-3xl ringline panel shadow-lift p-6 md:p-7">
        <p class="text-[11px] uppercase tracking-[.28em] muted">FAQ</p>
        <h2 class="font-display text-2xl font-semibold tracking-tight">Questions</h2>

        <div class="mt-5 grid gap-3" data-accordion>
          @foreach($faq as $f)
            <button type="button"
                    class="text-left rounded-2xl ringline glass px-4 py-4 focusable"
                    data-acc-btn aria-expanded="false">
              <div class="flex items-center justify-between gap-3">
                <span class="font-display font-semibold">{{ $f['q'] }}</span>
                <span class="font-display font-semibold" style="color: rgb(var(--amber));" data-acc-icon>+</span>
              </div>
              <div class="mt-2 muted text-sm hidden" data-acc-panel>
                {{ $f['a'] }}
              </div>
            </button>
          @endforeach
        </div>
      </div>
    </section>

    {{-- BLOG --}}
    <section class="space-y-7">
      <div class="flex items-end justify-between gap-6 flex-wrap">
        <div>
          <p class="text-[11px] uppercase tracking-[.28em] muted">Journal</p>
          <h2 class="font-display text-2xl md:text-3xl font-semibold tracking-tight">
            Notes on Modern Living
          </h2>
        </div>
        <a href="#contact" class="text-[11px] uppercase tracking-[.22em] muted hover:text-[rgb(var(--text))] focusable rounded-lg">
          Request a private brief →
        </a>
      </div>

      <div class="grid grid-cols-12 gap-5 lg:gap-6">
        @foreach($posts as $p)
          <article class="col-span-12 md:col-span-6 xl:col-span-4 rounded-3xl ringline panel shadow-lift overflow-hidden">
            <div class="relative h-44">
              <img src="{{ $p['img'] }}" alt="{{ $p['title'] }}" class="absolute inset-0 w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-black/0"></div>
              <div class="absolute bottom-4 left-4">
                <span class="px-3 py-1.5 rounded-full ringline glass text-[10px] uppercase tracking-[.26em] font-medium">
                  {{ $p['date'] }}
                </span>
              </div>
            </div>
            <div class="p-5">
              <h3 class="font-display font-semibold text-lg leading-snug">{{ $p['title'] }}</h3>
              <p class="mt-2 muted text-sm">A short cinematic editorial snippet for layout realism. (Dummy content.)</p>
              <a href="#" class="mt-4 inline-flex text-[11px] uppercase tracking-[.22em] font-semibold"
                 style="color: rgb(var(--teal));">
                Read (dummy) →
              </a>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    {{-- CONTACT + MAP + NEWSLETTER --}}
    <section id="contact" class="grid grid-cols-12 gap-5 lg:gap-6">
      <div class="col-span-12 lg:col-span-5 rounded-3xl ringline panel shadow-lift p-6 md:p-7">
        <p class="text-[11px] uppercase tracking-[.28em] muted">Contact</p>
        <h2 class="font-display text-2xl font-semibold tracking-tight">
          Request a Private Viewing
        </h2>
        <p class="mt-3 muted text-sm">
          Share your budget range, preferred neighborhoods, and timeline. (Static demo: no backend.)
        </p>

        <form class="mt-6 grid gap-3" data-contact-form novalidate>
          <div class="grid sm:grid-cols-2 gap-3">
            <div>
              <label class="text-[11px] uppercase tracking-[.22em] muted">Name</label>
              <input name="name" required minlength="2"
                     class="mt-1 w-full px-4 py-3 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[rgb(var(--text))] focusable"
                     placeholder="Your name" />
              <p class="mt-1 text-sm text-red-400 min-h-[1.25rem]" data-err="name"></p>
            </div>
            <div>
              <label class="text-[11px] uppercase tracking-[.22em] muted">Email</label>
              <input name="email" type="email" required
                     class="mt-1 w-full px-4 py-3 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[rgb(var(--text))] focusable"
                     placeholder="you@domain.com" />
              <p class="mt-1 text-sm text-red-400 min-h-[1.25rem]" data-err="email"></p>
            </div>
          </div>

          <div>
            <label class="text-[11px] uppercase tracking-[.22em] muted">Budget</label>
            <select name="budget" required
                    class="mt-1 w-full px-4 py-3 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[rgb(var(--text))] focusable">
              <option value="">Select…</option>
              <option>$2M – $5M</option>
              <option>$5M – $10M</option>
              <option>$10M+</option>
            </select>
            <p class="mt-1 text-sm text-red-400 min-h-[1.25rem]" data-err="budget"></p>
          </div>

          <div>
            <label class="text-[11px] uppercase tracking-[.22em] muted">Message</label>
            <textarea name="message" rows="4" required minlength="10"
                      class="mt-1 w-full px-4 py-3 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[rgb(var(--text))] focusable"
                      placeholder="Preferred area, style, move-in timeline…"></textarea>
            <p class="mt-1 text-sm text-red-400 min-h-[1.25rem]" data-err="message"></p>
          </div>

          <button class="px-5 py-3 rounded-2xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable">
            Send Request
          </button>
          <p class="text-sm muted min-h-[1.25rem]" data-contact-note></p>
        </form>

        <div class="mt-6 grid gap-3">
          <div class="rounded-2xl ringline bg-[rgb(var(--panel2))] p-4">
            <div class="text-[10px] uppercase tracking-[.26em] muted">Direct</div>
            <div class="mt-2 font-display font-semibold">{{ $brand['phone'] }}</div>
            <div class="mt-1 muted text-sm">{{ $brand['email'] }}</div>
          </div>
          <div class="rounded-2xl ringline bg-[rgb(var(--panel2))] p-4">
            <div class="text-[10px] uppercase tracking-[.26em] muted">Office</div>
            <div class="mt-2 muted text-sm">{{ $brand['address'] }}</div>
          </div>
        </div>
      </div>

      <div class="col-span-12 lg:col-span-7 rounded-3xl ringline panel shadow-lift overflow-hidden">
        <div class="p-6 md:p-7 border-b hairline">
          <div class="flex items-end justify-between gap-4 flex-wrap">
            <div>
              <p class="text-[11px] uppercase tracking-[.28em] muted">Map</p>
              <h2 class="font-display text-2xl font-semibold tracking-tight">By Appointment</h2>
            </div>
            <div class="text-[11px] uppercase tracking-[.22em] muted">
              Minimal embed • Replace with your location
            </div>
          </div>
        </div>

        <iframe
          title="OpenStreetMap"
          class="w-full h-[380px] md:h-[420px]"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://www.openstreetmap.org/export/embed.html?bbox=-74.012%2C40.705%2C-73.985%2C40.725&amp;layer=mapnik">
        </iframe>

        <div class="p-6 md:p-7 border-t hairline">
          <div class="grid md:grid-cols-2 gap-4 items-center">
            <div>
              <p class="text-[11px] uppercase tracking-[.28em] muted">Newsletter</p>
              <h3 class="font-display text-xl font-semibold">Private Drops & New Inventory</h3>
              <p class="mt-1 muted text-sm">Monthly — calm, minimal, and actually useful. (Static demo.)</p>
            </div>
            <form class="grid sm:grid-cols-[1fr_auto] gap-3" data-newsletter-form>
              <input type="email" name="email" required
                     class="px-4 py-3 rounded-2xl ringline bg-[rgb(var(--panel2))] text-[rgb(var(--text))] focusable"
                     placeholder="you@domain.com">
              <button class="px-5 py-3 rounded-2xl text-[11px] uppercase tracking-[.22em] font-semibold transition focusable"
                      style="background: rgb(var(--amber)); color: rgb(var(--cine-ink, 10 16 28));">
                Subscribe
              </button>
              <p class="sm:col-span-2 text-sm muted min-h-[1.25rem]" data-newsletter-note></p>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main>

  {{-- FOOTER --}}
  <footer class="border-t hairline bg-[rgb(var(--bg)/.75)]">
    <div class="wrap py-10">
      <div class="grid md:grid-cols-12 gap-6 items-start">
        <div class="md:col-span-6">
          <div class="font-display font-semibold tracking-[.16em] uppercase text-sm">
            {{ $brand['name'] }}
          </div>
          <p class="mt-3 muted text-sm max-w-xl">
            Dark cinematic luxury real estate layout: modern hero, Swiss grid, modular cards, and refined typography.
            Dummy data, real structure.
          </p>
        </div>

        <div class="md:col-span-3">
          <div class="text-[11px] uppercase tracking-[.28em] muted">Sections</div>
          <div class="mt-3 grid gap-2">
            @foreach(['Listings'=>'#listings','Services'=>'#services','Plans'=>'#plans','Gallery'=>'#gallery','Team'=>'#team','Pricing'=>'#pricing','Contact'=>'#contact'] as $label=>$href)
              <a href="{{ $href }}" class="text-[11px] uppercase tracking-[.22em] font-medium muted hover:text-[rgb(var(--text))] focusable rounded-lg">
                {{ $label }}
              </a>
            @endforeach
          </div>
        </div>

        <div class="md:col-span-3">
          <div class="text-[11px] uppercase tracking-[.28em] muted">Contact</div>
          <div class="mt-3 grid gap-2 muted text-sm">
            <div>{{ $brand['phone'] }}</div>
            <div>{{ $brand['email'] }}</div>
            <div class="text-[11px] uppercase tracking-[.22em] muted">© <span data-year></span> — All rights reserved</div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  {{-- LISTING PREVIEW MODAL --}}
  <div class="fixed inset-0 hidden items-center justify-center p-4 z-[60]" data-modal>
    <div class="absolute inset-0 modal-backdrop" data-modal-close></div>

    <div class="relative w-full max-w-4xl rounded-3xl overflow-hidden ringline shadow-luxe panel">
      <div class="flex items-center justify-between gap-3 p-4 md:p-5 border-b hairline">
        <div>
          <div class="text-[11px] uppercase tracking-[.28em] muted">Preview</div>
          <div class="font-display font-semibold text-lg" data-modal-title>Listing</div>
          <div class="text-sm muted" data-modal-subtitle></div>
        </div>
        <button class="px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold focusable" data-modal-close>
          Close
        </button>
      </div>

      <div class="grid md:grid-cols-12">
        <div class="md:col-span-7 relative min-h-[260px] md:min-h-[420px]">
          <img class="absolute inset-0 w-full h-full object-cover" data-modal-img alt="Listing preview">
          <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/10 to-black/0"></div>
        </div>

        <div class="md:col-span-5 p-5 md:p-6">
          <div class="rounded-3xl ringline bg-[rgb(var(--panel2))] p-5">
            <div class="text-[11px] uppercase tracking-[.28em] muted">Starting at</div>
            <div class="mt-2 font-display font-semibold text-2xl" data-modal-price></div>
            <p class="mt-3 muted text-sm">
              A short, clean, cinematic description. Replace with real listing copy, specs, and disclosures. (Dummy)
            </p>

            <div class="mt-5 grid gap-2">
              @foreach(['Discreet tour scheduling','Architectural briefing pack','Comparable analysis (dummy)'] as $x)
                <div class="flex items-center justify-between rounded-2xl ringline glass px-4 py-3">
                  <span class="text-[11px] uppercase tracking-[.18em] font-medium">{{ $x }}</span>
                  <span class="h-1.5 w-1.5 rounded-full" style="background: rgb(var(--amber));"></span>
                </div>
              @endforeach
            </div>

            <a href="#contact"
               class="mt-5 inline-flex w-full justify-center px-5 py-3 rounded-2xl bg-[rgb(var(--text))] text-[rgb(var(--bg))] text-[11px] uppercase tracking-[.22em] font-semibold hover:opacity-95 transition focusable"
               data-modal-close>
              Request Viewing
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- GALLERY LIGHTBOX --}}
  <div class="fixed inset-0 hidden items-center justify-center p-4 z-[70]" data-lightbox>
    <div class="absolute inset-0 modal-backdrop" data-lightbox-close></div>
    <div class="relative w-full max-w-5xl rounded-3xl overflow-hidden ringline shadow-luxe panel">
      <div class="flex items-center justify-between gap-3 p-4 md:p-5 border-b hairline">
        <div>
          <div class="text-[11px] uppercase tracking-[.28em] muted">Gallery</div>
          <div class="font-display font-semibold text-lg" data-lightbox-title>Frame</div>
        </div>
        <button class="px-3 py-2 rounded-xl ringline glass text-[11px] uppercase tracking-[.22em] font-semibold focusable" data-lightbox-close>
          Close
        </button>
      </div>
      <div class="relative bg-black/40">
        <img class="w-full max-h-[75vh] object-cover" alt="Gallery preview" data-lightbox-img>
      </div>
    </div>
  </div>

  <script>
    // ===== Year =====
    document.querySelectorAll('[data-year]').forEach(el => el.textContent = new Date().getFullYear());

    // ===== Theme toggle (optional) =====
    const themeBtn = document.querySelector('[data-theme-toggle]');
    const root = document.documentElement;

    const savedTheme = localStorage.getItem('cine_theme'); // 'dark' | 'light'
    if (savedTheme === 'light') root.setAttribute('data-theme','light');

    themeBtn?.addEventListener('click', () => {
      const isLight = root.getAttribute('data-theme') === 'light';
      if (isLight) {
        root.removeAttribute('data-theme');
        localStorage.setItem('cine_theme','dark');
      } else {
        root.setAttribute('data-theme','light');
        localStorage.setItem('cine_theme','light');
      }
    });

    // ===== Mobile nav =====
    const mobileToggle = document.querySelector('[data-mobile-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    mobileToggle?.addEventListener('click', () => {
      const open = !mobileMenu.classList.contains('hidden');
      mobileMenu.classList.toggle('hidden', open);
      mobileToggle.setAttribute('aria-expanded', String(!open));
    });
    document.querySelectorAll('[data-mobile-link]').forEach(a => {
      a.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileToggle?.setAttribute('aria-expanded', 'false');
      });
    });

    // ===== Testimonials slider =====
    const testimonials = @json($testimonials);
    let t = 0;
    const q = document.querySelector('[data-t-quote]');
    const n = document.querySelector('[data-t-name]');
    const r = document.querySelector('[data-t-role]');
    function paintT(){
      const it = testimonials[t];
      if(q) q.textContent = it.quote;
      if(n) n.textContent = it.name;
      if(r) r.textContent = it.role;
    }
    paintT();
    document.querySelector('[data-t-next]')?.addEventListener('click', () => { t=(t+1)%testimonials.length; paintT(); });
    document.querySelector('[data-t-prev]')?.addEventListener('click', () => { t=(t-1+testimonials.length)%testimonials.length; paintT(); });
    setInterval(()=>{ t=(t+1)%testimonials.length; paintT(); }, 7500);

    // ===== FAQ accordion =====
    document.querySelectorAll('[data-accordion]').forEach(acc => {
      acc.querySelectorAll('[data-acc-btn]').forEach(btn => {
        btn.addEventListener('click', () => {
          const expanded = btn.getAttribute('aria-expanded') === 'true';
          acc.querySelectorAll('[data-acc-btn]').forEach(b => {
            b.setAttribute('aria-expanded','false');
            b.querySelector('[data-acc-panel]')?.classList.add('hidden');
            const ic = b.querySelector('[data-acc-icon]'); if(ic) ic.textContent = '+';
          });
          btn.setAttribute('aria-expanded', String(!expanded));
          btn.querySelector('[data-acc-panel]')?.classList.toggle('hidden', expanded);
          const icon = btn.querySelector('[data-acc-icon]'); if(icon) icon.textContent = expanded ? '+' : '–';
        }, { passive:true });
      });
    });

    // ===== Listing modal =====
    const modal = document.querySelector('[data-modal]');
    const modalTitle = document.querySelector('[data-modal-title]');
    const modalSub = document.querySelector('[data-modal-subtitle]');
    const modalPrice = document.querySelector('[data-modal-price]');
    const modalImg = document.querySelector('[data-modal-img]');

    function openModal({title, location, price, image}){
      if(modalTitle) modalTitle.textContent = title;
      if(modalSub) modalSub.textContent = location + ' • Private Listing';
      if(modalPrice) modalPrice.textContent = price;
      if(modalImg) modalImg.src = image;
      modal?.classList.remove('hidden');
      modal?.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
    function closeModal(){
      modal?.classList.add('hidden');
      modal?.classList.remove('flex');
      document.body.style.overflow = '';
      if(modalImg) modalImg.src = '';
    }

    document.querySelectorAll('[data-open-listing]').forEach(btn => {
      btn.addEventListener('click', () => {
        openModal({
          title: btn.getAttribute('data-title') || 'Listing',
          location: btn.getAttribute('data-location') || '',
          price: btn.getAttribute('data-price') || '',
          image: btn.getAttribute('data-image') || ''
        });
      });
    });
    document.querySelectorAll('[data-modal-close]').forEach(el => el.addEventListener('click', closeModal));
    window.addEventListener('keydown', (e) => { if(e.key === 'Escape') { closeModal(); closeLightbox(); } });

    // ===== Gallery lightbox =====
    const lightbox = document.querySelector('[data-lightbox]');
    const lbImg = document.querySelector('[data-lightbox-img]');
    const lbTitle = document.querySelector('[data-lightbox-title]');

    function openLightbox(src, title){
      if(lbImg) lbImg.src = src;
      if(lbTitle) lbTitle.textContent = title || 'Frame';
      lightbox?.classList.remove('hidden');
      lightbox?.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
    function closeLightbox(){
      lightbox?.classList.add('hidden');
      lightbox?.classList.remove('flex');
      document.body.style.overflow = '';
      if(lbImg) lbImg.src = '';
    }

    document.querySelectorAll('[data-gallery-item]').forEach((it) => {
      it.addEventListener('click', () => {
        openLightbox(it.getAttribute('data-src'), it.getAttribute('data-title'));
      });
    });
    document.querySelectorAll('[data-lightbox-close]').forEach(el => el.addEventListener('click', closeLightbox));
    document.querySelector('[data-open-lightbox-first]')?.addEventListener('click', () => {
      const first = document.querySelector('[data-gallery-item]');
      if(first) openLightbox(first.getAttribute('data-src'), first.getAttribute('data-title'));
    });

    // ===== Newsletter (static) =====
    document.querySelectorAll('[data-newsletter-form]').forEach(form => {
      const note = form.querySelector('[data-newsletter-note]');
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = (new FormData(form).get('email') || '').toString().trim();
        const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if(note) note.textContent = ok ? 'Subscribed (demo). Connect to your backend/provider.' : 'Please enter a valid email.';
        if(ok) form.reset();
      });
    });

    // ===== Contact validation (static) =====
    const contactForm = document.querySelector('[data-contact-form]');
    const contactNote = document.querySelector('[data-contact-note]');
    const err = (k, msg) => {
      const el = document.querySelector(`[data-err="${k}"]`);
      if(el) el.textContent = msg || '';
    };

    contactForm?.addEventListener('submit', (e) => {
      e.preventDefault();
      if(contactNote) contactNote.textContent = '';

      const fd = new FormData(contactForm);
      const name = (fd.get('name') || '').toString().trim();
      const email = (fd.get('email') || '').toString().trim();
      const budget = (fd.get('budget') || '').toString().trim();
      const message = (fd.get('message') || '').toString().trim();

      err('name',''); err('email',''); err('budget',''); err('message','');

      let ok = true;
      if(name.length < 2){ err('name','Enter at least 2 characters.'); ok = false; }
      if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){ err('email','Enter a valid email.'); ok = false; }
      if(!budget){ err('budget','Select a budget range.'); ok = false; }
      if(message.length < 10){ err('message','Enter at least 10 characters.'); ok = false; }

      if(!ok){
        if(contactNote) contactNote.textContent = 'Please fix the highlighted fields.';
        return;
      }

      if(contactNote) contactNote.textContent = 'Request received (demo). No message was sent.';
      contactForm.reset();
    });
  </script>
</body>
</html>