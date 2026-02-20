{{-- resources/views/petcare.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PawPal Care — Modern Friendly Pet Care</title>

  {{-- Tailwind CDN (single-file friendly) --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Tailwind config (inline) --}}
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            ink: "#1f2937",
            bg: "#fbfbf7",
            tealsoft: "#2bb7a7",
            tealdeep: "#159a8d",
            lemon: "#ffd86b",
            sky: "#a9d8ff",
            mist: "#f1f5f9",
          },
          boxShadow: {
            soft: "0 18px 50px rgba(17, 24, 39, .12)",
            lift: "0 12px 30px rgba(17, 24, 39, .10)",
            glow: "0 0 0 6px rgba(43, 183, 167, .16), 0 16px 40px rgba(17,24,39,.14)",
          }
        }
      }
    }
  </script>

  {{-- Alpine.js (micro-interactions + carousel) --}}
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    :root { color-scheme: light; }

    /* Subtle paw-print pattern (SVG data URI) */
    .paw-pattern {
      background-image:
        radial-gradient(circle at 10px 12px, rgba(31,41,55,.04) 0 2px, transparent 2.2px),
        radial-gradient(circle at 17px 8px, rgba(31,41,55,.04) 0 1.8px, transparent 2px),
        radial-gradient(circle at 3px 8px, rgba(31,41,55,.04) 0 1.8px, transparent 2px),
        radial-gradient(circle at 10px 6px, rgba(31,41,55,.04) 0 1.6px, transparent 1.8px),
        radial-gradient(circle at 10px 18px, rgba(31,41,55,.04) 0 3.2px, transparent 3.4px);
      background-size: 46px 46px;
      background-position: 0 0;
    }

    /* Organic blob shapes */
    .blob {
      border-radius: 44% 56% 61% 39% / 46% 39% 61% 54%;
      filter: drop-shadow(0 20px 40px rgba(17,24,39,.10));
      transform: translateZ(0);
    }
    .blob-2 {
      border-radius: 62% 38% 42% 58% / 54% 60% 40% 46%;
    }

    /* Cutout-ish dog effect */
    .cutout {
      filter: drop-shadow(0 18px 24px rgba(17,24,39,.18));
      transform: translateZ(0);
    }

    /* Smooth hover */
    .hvr {
      transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease, border-color .2s ease;
    }

    /* Soft floating */
    @keyframes floaty { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    .floaty { animation: floaty 5.5s ease-in-out infinite; }
    .floaty2 { animation: floaty 6.5s ease-in-out infinite; }
  </style>
</head>

@php
  $services = [
    ['name' => 'Grooming',   'desc' => 'Bath, trim & glow', 'icon' => 'scissors'],
    ['name' => 'Healthcare', 'desc' => 'Checkups & care',   'icon' => 'heart'],
    ['name' => 'Boarding',   'desc' => 'Cozy overnight',    'icon' => 'home'],
    ['name' => 'Daycare',    'desc' => 'Play & socialize',  'icon' => 'sun'],
    ['name' => 'Training',   'desc' => 'Good habits',       'icon' => 'spark'],
  ];

  $features = [
    ['title' => 'Vet-verified care', 'text' => 'Protocols designed with safety first.', 'tone' => 'lemon', 'icon' => 'shield'],
    ['title' => 'Photo updates',     'text' => 'See your pet’s day in real time.',      'tone' => 'sky',   'icon' => 'camera'],
    ['title' => 'Calm handling',     'text' => 'Gentle routines for anxious pets.',     'tone' => 'teal',  'icon' => 'hand'],
    ['title' => 'Flexible pickups',  'text' => 'Easy scheduling around your day.',     'tone' => 'lemon', 'icon' => 'clock'],
    ['title' => 'Clean + bright',    'text' => 'Airy rooms, fresh gear, soft beds.',   'tone' => 'sky',   'icon' => 'sparkle'],
    ['title' => 'Trusted team',      'text' => 'Background-checked, pet-first staff.', 'tone' => 'teal',  'icon' => 'users'],
  ];

  $testimonials = [
    ['name' => 'Alya S.', 'role' => 'Golden owner', 'text' => 'The grooming finish is unreal—soft, clean, and my dog actually looked proud walking out.'],
    ['name' => 'Dimas R.', 'role' => 'Busy parent', 'text' => 'Boarding felt like a boutique hotel. Daily photo updates made it so easy to relax on our trip.'],
    ['name' => 'Maya K.', 'role' => 'Rescue adopter', 'text' => 'They handled my anxious pup with patience. Training sessions were calm, clear, and effective.'],
  ];

  /* Online images (swap anytime) */
  $heroDog = "https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1400&q=80";
  $circle1 = "https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?auto=format&fit=crop&w=1200&q=80";
  $circle2 = "https://images.unsplash.com/photo-1558788353-f76d92427f16?auto=format&fit=crop&w=1200&q=80";
  $circle3 = "https://images.unsplash.com/photo-1560743641-3914f2c45636?auto=format&fit=crop&w=1200&q=80";

  $avatars = [
    "https://i.pravatar.cc/120?img=32",
    "https://i.pravatar.cc/120?img=12",
    "https://i.pravatar.cc/120?img=48",
    "https://i.pravatar.cc/120?img=5",
    "https://i.pravatar.cc/120?img=21",
  ];

  function iconSvg($name) {
    // Minimal line icons (inline SVG)
    $common = 'class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"';
    return match($name) {
      'scissors' => "<svg $common viewBox='0 0 24 24'><circle cx='6' cy='6' r='2'/><circle cx='6' cy='18' r='2'/><path d='M20 4L8.5 11.5'/><path d='M20 20L8.5 12.5'/><path d='M8.5 11.5L6.8 9.8'/><path d='M8.5 12.5L6.8 14.2'/></svg>",
      'heart'    => "<svg $common viewBox='0 0 24 24'><path d='M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z'/></svg>",
      'home'     => "<svg $common viewBox='0 0 24 24'><path d='M3 10.5 12 3l9 7.5'/><path d='M5 10v10h14V10'/><path d='M9 20v-6h6v6'/></svg>",
      'sun'      => "<svg $common viewBox='0 0 24 24'><circle cx='12' cy='12' r='4'/><path d='M12 2v2'/><path d='M12 20v2'/><path d='M4.9 4.9l1.4 1.4'/><path d='M17.7 17.7l1.4 1.4'/><path d='M2 12h2'/><path d='M20 12h2'/><path d='M4.9 19.1l1.4-1.4'/><path d='M17.7 6.3l1.4-1.4'/></svg>",
      'spark'    => "<svg $common viewBox='0 0 24 24'><path d='M12 2l1.2 5.2L18 8.5l-4.8 1.3L12 15l-1.2-5.2L6 8.5l4.8-1.3L12 2z'/><path d='M19 14l.8 3.2L23 18l-3.2.8L19 22l-.8-3.2L15 18l3.2-.8L19 14z'/></svg>",
      'shield'   => "<svg $common viewBox='0 0 24 24'><path d='M12 2l8 4v6c0 5-3.4 9.4-8 10-4.6-.6-8-5-8-10V6l8-4z'/><path d='M9 12l2 2 4-4'/></svg>",
      'camera'   => "<svg $common viewBox='0 0 24 24'><path d='M4 7h3l2-2h6l2 2h3v12H4z'/><circle cx='12' cy='13' r='3'/></svg>",
      'hand'     => "<svg $common viewBox='0 0 24 24'><path d='M8 13V6a2 2 0 1 1 4 0v6'/><path d='M12 12V5a2 2 0 1 1 4 0v9'/><path d='M16 10a2 2 0 1 1 4 0v7a5 5 0 0 1-5 5H12a6 6 0 0 1-6-6v-4a2 2 0 1 1 4 0v1'/></svg>",
      'clock'    => "<svg $common viewBox='0 0 24 24'><circle cx='12' cy='12' r='9'/><path d='M12 7v6l4 2'/></svg>",
      'sparkle'  => "<svg $common viewBox='0 0 24 24'><path d='M12 2l1.2 5.2L18 8.5l-4.8 1.3L12 15l-1.2-5.2L6 8.5l4.8-1.3L12 2z'/><path d='M4 14l.7 2.7L7.5 17l-2.8.7L4 20l-.7-2.3L.5 17l2.8-.3L4 14z'/></svg>",
      'users'    => "<svg $common viewBox='0 0 24 24'><path d='M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2'/><circle cx='9' cy='7' r='4'/><path d='M22 21v-2a4 4 0 0 0-3-3.9'/><path d='M16 3.1a4 4 0 0 1 0 7.8'/></svg>",
      default    => "<svg $common viewBox='0 0 24 24'><path d='M12 2v20'/><path d='M2 12h20'/></svg>",
    };
  }
@endphp

<body class="bg-bg text-ink antialiased">
  {{-- Top background decoration --}}
  <div class="relative overflow-hidden">
    <div class="absolute inset-0 paw-pattern opacity-60"></div>

    {{-- soft blobs --}}
    <div class="pointer-events-none absolute -top-24 -left-24 w-[360px] h-[360px] bg-lemon/70 blob"></div>
    <div class="pointer-events-none absolute top-36 -right-28 w-[420px] h-[420px] bg-tealsoft/25 blob blob-2"></div>

    {{-- Header --}}
    <header class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-6">
        <div class="flex items-center justify-between">
          <a href="#" class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-tealsoft text-white shadow-lift grid place-items-center">
              {{-- paw --}}
              <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8.5 11.5c-1.5-1.4-3.7-1.1-4.8.6-1 1.6-.3 3.6 1.5 4.2 1 .3 2.1.1 3-.6"/>
                <path d="M15.5 11.5c1.5-1.4 3.7-1.1 4.8.6 1 1.6.3 3.6-1.5 4.2-1 .3-2.1.1-3-.6"/>
                <path d="M9 16.2c1.8-1.5 4.2-1.5 6 0 1.8 1.5 1.6 4.3-.4 5.6-1.7 1.1-3.5 1.1-5.2 0-2-1.3-2.2-4.1-.4-5.6z"/>
                <circle cx="8" cy="7.5" r="1.5"/>
                <circle cx="12" cy="6.5" r="1.5"/>
                <circle cx="16" cy="7.5" r="1.5"/>
              </svg>
            </div>
            <div class="leading-tight">
              <div class="font-semibold tracking-tight text-lg">PawPal Care</div>
              <div class="text-xs text-ink/60">Friendly, modern pet services</div>
            </div>
          </a>

          <nav class="hidden md:flex items-center gap-7 text-sm text-ink/70">
            <a class="hvr hover:text-ink" href="#services">Services</a>
            <a class="hvr hover:text-ink" href="#why">Why us</a>
            <a class="hvr hover:text-ink" href="#testimonials">Testimonials</a>
            <a class="hvr hover:text-ink" href="#contact">Contact</a>
          </nav>

          <div class="flex items-center gap-3">
            <a href="#contact" class="hidden sm:inline-flex hvr rounded-2xl px-4 py-2 text-sm font-semibold border border-ink/10 bg-white/70 backdrop-blur hover:bg-white shadow-sm">
              Book a visit
            </a>
            <a href="#contact" class="inline-flex hvr rounded-2xl px-4 py-2 text-sm font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
              Get started
            </a>
          </div>
        </div>
      </div>
    </header>

    {{-- Hero --}}
    <section class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-12 pb-10 lg:pt-16">
        <div class="grid lg:grid-cols-12 gap-10 items-center">
          <div class="lg:col-span-6">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/70 backdrop-blur border border-ink/10 px-4 py-2 text-xs text-ink/70 shadow-sm">
              <span class="w-2 h-2 rounded-full bg-tealsoft"></span>
              Now accepting new daycare & grooming clients
            </div>

            <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight">
              Modern, playful <span class="text-tealdeep">pet care</span>
              your family can trust.
            </h1>

            <p class="mt-5 text-base sm:text-lg text-ink/70 max-w-xl">
              Clean spaces, gentle handling, and a team that treats every pet like a favorite.
              Grooming, health check-ins, boarding, daycare, and training—done with startup-level polish.
            </p>

            <div class="mt-7 flex flex-col sm:flex-row gap-3">
              <a href="#services" class="inline-flex justify-center items-center gap-2 hvr rounded-2xl px-5 py-3 font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
                Explore services
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14"/><path d="M13 5l7 7-7 7"/>
                </svg>
              </a>

              <a href="#testimonials" class="inline-flex justify-center items-center gap-2 hvr rounded-2xl px-5 py-3 font-semibold bg-white/70 backdrop-blur border border-ink/10 hover:bg-white shadow-sm">
                See happy tails
                <span class="text-ink/40">•</span>
                <span class="text-ink/60 text-sm">4.9 avg</span>
              </a>
            </div>

            <div class="mt-8 flex items-center gap-6 text-sm text-ink/70">
              <div class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-2xl bg-sky/30 grid place-items-center">
                  <svg class="w-5 h-5 text-ink/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 6 9 17l-5-5"/>
                  </svg>
                </span>
                <span>Calm, fear-free approach</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-2xl bg-lemon/40 grid place-items-center">
                  <svg class="w-5 h-5 text-ink/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 17l-5 3 1.6-5.6L4 10.9l5.8-.2L12 5l2.2 5.7 5.8.2-4.6 3.5L17 20z"/>
                  </svg>
                </span>
                <span>Soft, clean, bright facility</span>
              </div>
            </div>
          </div>

          <div class="lg:col-span-6">
            <div class="relative">
              {{-- Yellow blob behind dog --}}
              <div class="absolute -top-6 -left-6 sm:-top-10 sm:-left-10 w-[320px] h-[320px] sm:w-[420px] sm:h-[420px] bg-lemon/80 blob"></div>

              {{-- Teal blob accent --}}
              <div class="absolute -bottom-10 -right-10 w-[220px] h-[220px] bg-tealsoft/25 blob blob-2 floaty2"></div>

              {{-- Dog image (cutout-ish) --}}
              <div class="relative rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-4 sm:p-6">
                <div class="relative overflow-hidden rounded-[1.8rem] bg-gradient-to-br from-white to-mist">
                  <img
                    src="{{ $heroDog }}"
                    alt="Happy dog"
                    class="cutout w-full h-[340px] sm:h-[420px] object-cover object-[center_30%]"
                    loading="lazy"
                  />

                  {{-- floating UI chips --}}
                  <div class="absolute top-5 left-5 floaty">
                    <div class="rounded-2xl bg-white/80 backdrop-blur border border-ink/10 shadow-sm px-4 py-3">
                      <div class="text-xs text-ink/60">Next available</div>
                      <div class="font-semibold">Today, 4:30 PM</div>
                    </div>
                  </div>

                  <div class="absolute bottom-5 right-5 floaty2">
                    <div class="rounded-2xl bg-white/80 backdrop-blur border border-ink/10 shadow-sm px-4 py-3">
                      <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-tealsoft"></span>
                        <div class="text-sm font-semibold">Live photo updates</div>
                      </div>
                      <div class="text-xs text-ink/60 mt-1">In daycare & boarding</div>
                    </div>
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-between gap-4">
                  <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-tealsoft/15 text-tealdeep grid place-items-center">
                      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21s-7-4.4-7-11a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 6.6-7 11-7 11z"/>
                      </svg>
                    </div>
                    <div>
                      <div class="font-semibold">Gentle, family-friendly care</div>
                      <div class="text-sm text-ink/60">Because trust is everything.</div>
                    </div>
                  </div>

                  <div class="hidden sm:flex items-center gap-2 text-sm text-ink/60">
                    <span class="inline-flex items-center gap-1">
                      <span class="w-2 h-2 rounded-full bg-lemon"></span> Grooming
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1">
                      <span class="w-2 h-2 rounded-full bg-sky"></span> Daycare
                    </span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Services icon nav --}}
    <section id="services" class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12 lg:pb-16">
        <div class="rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-6 sm:p-8">
          <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
              <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight">Services made simple</h2>
              <p class="mt-2 text-ink/65 max-w-2xl">
                Minimal, clean options—each designed to feel warm, modern, and easy to book.
              </p>
            </div>
            <a href="#contact" class="hvr inline-flex items-center justify-center rounded-2xl px-4 py-2 font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
              Book now
            </a>
          </div>

          <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($services as $s)
              <a href="#contact" class="group hvr rounded-[1.6rem] border border-ink/10 bg-white/60 hover:bg-white shadow-sm hover:shadow-lift p-4">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-2xl bg-mist grid place-items-center text-ink/70 group-hover:text-tealdeep">
                    {!! iconSvg($s['icon']) !!}
                  </div>
                  <div>
                    <div class="font-semibold">{{ $s['name'] }}</div>
                    <div class="text-sm text-ink/60">{{ $s['desc'] }}</div>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    {{-- Mid-page “Behance style” showcase section --}}
    <section id="why" class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-14 lg:pb-20">
        <div class="grid lg:grid-cols-12 gap-8 items-stretch">
          <div class="lg:col-span-5">
            <div class="relative h-full rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-6 sm:p-8 overflow-hidden">
              <div class="absolute -top-20 -right-20 w-[240px] h-[240px] bg-sky/35 blob blob-2"></div>
              <div class="absolute -bottom-24 -left-24 w-[300px] h-[300px] bg-lemon/55 blob"></div>

              <h3 class="text-2xl sm:text-3xl font-semibold tracking-tight">
                A clean, bright experience—built for comfort.
              </h3>
              <p class="mt-3 text-ink/70">
                From check-in to pickup, everything feels smooth: rounded UI, airy spacing, and gentle routines
                your pet can actually enjoy.
              </p>

              <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="rounded-2xl border border-ink/10 bg-white/70 p-4 shadow-sm floaty">
                  <div class="text-xs text-ink/60">Avg pickup time</div>
                  <div class="mt-1 text-xl font-semibold">3 mins</div>
                  <div class="mt-2 text-sm text-ink/60">Fast & calm handoff</div>
                </div>
                <div class="rounded-2xl border border-ink/10 bg-white/70 p-4 shadow-sm floaty2">
                  <div class="text-xs text-ink/60">Daily capacity</div>
                  <div class="mt-1 text-xl font-semibold">Limited</div>
                  <div class="mt-2 text-sm text-ink/60">More attention per pet</div>
                </div>
              </div>

              <div class="mt-6">
                <a href="#contact" class="inline-flex hvr items-center gap-2 rounded-2xl px-5 py-3 font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
                  Meet the team
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="M13 5l7 7-7 7"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>

          <div class="lg:col-span-7">
            <div class="grid sm:grid-cols-3 gap-4 h-full">
              {{-- Circular image masks --}}
              <div class="rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-5 sm:p-6">
                <div class="relative">
                  <div class="absolute -top-4 -right-5 w-20 h-20 bg-tealsoft/20 blob blob-2"></div>
                  <div class="w-full aspect-square rounded-full overflow-hidden border border-ink/10 shadow-sm">
                    <img src="{{ $circle1 }}" alt="Dog being cared for" class="w-full h-full object-cover" loading="lazy">
                  </div>
                </div>
                <div class="mt-4 font-semibold">Gentle grooming</div>
                <div class="mt-1 text-sm text-ink/65">Soft handling + clean finish.</div>
              </div>

              <div class="rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-5 sm:p-6">
                <div class="relative">
                  <div class="absolute -bottom-4 -left-5 w-20 h-20 bg-lemon/45 blob"></div>
                  <div class="w-full aspect-square rounded-full overflow-hidden border border-ink/10 shadow-sm">
                    <img src="{{ $circle2 }}" alt="Happy puppy" class="w-full h-full object-cover" loading="lazy">
                  </div>
                </div>
                <div class="mt-4 font-semibold">Bright daycare</div>
                <div class="mt-1 text-sm text-ink/65">Play, rest, repeat—comfortably.</div>
              </div>

              <div class="rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-5 sm:p-6">
                <div class="relative">
                  <div class="absolute -top-4 -left-5 w-20 h-20 bg-sky/40 blob blob-2"></div>
                  <div class="w-full aspect-square rounded-full overflow-hidden border border-ink/10 shadow-sm">
                    <img src="{{ $circle3 }}" alt="Dog relaxing" class="w-full h-full object-cover" loading="lazy">
                  </div>
                </div>
                <div class="mt-4 font-semibold">Cozy boarding</div>
                <div class="mt-1 text-sm text-ink/65">A calm overnight routine.</div>
              </div>

              {{-- Feature grid --}}
              <div class="sm:col-span-3 rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-6 sm:p-8">
                <div class="flex items-end justify-between gap-6 flex-wrap">
                  <div>
                    <h3 class="text-2xl sm:text-3xl font-semibold tracking-tight">Why families choose PawPal</h3>
                    <p class="mt-2 text-ink/65 max-w-3xl">
                      A modern pet care brand: clean UI, friendly tone, and thoughtful details—without the fluff.
                    </p>
                  </div>
                </div>

                <div class="mt-7 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                  @foreach ($features as $f)
                    @php
                      $toneBg = match($f['tone']) {
                        'lemon' => 'bg-lemon/35',
                        'sky'   => 'bg-sky/35',
                        'teal'  => 'bg-tealsoft/18',
                        default => 'bg-mist',
                      };
                      $toneText = match($f['tone']) {
                        'teal' => 'text-tealdeep',
                        default => 'text-ink/70',
                      };
                    @endphp
                    <div class="group hvr rounded-[1.6rem] border border-ink/10 bg-white/60 hover:bg-white shadow-sm hover:shadow-lift p-5">
                      <div class="flex items-start gap-3">
                        <div class="w-12 h-12 rounded-2xl {{ $toneBg }} grid place-items-center {{ $toneText }}">
                          {!! iconSvg($f['icon']) !!}
                        </div>
                        <div>
                          <div class="font-semibold">{{ $f['title'] }}</div>
                          <div class="mt-1 text-sm text-ink/65">{{ $f['text'] }}</div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Testimonials carousel --}}
    <section id="testimonials" class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-14 lg:pb-20">
        <div
          class="relative overflow-hidden rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-6 sm:p-10"
          x-data="{
            i: 0,
            items: @js($testimonials),
            next(){ this.i = (this.i + 1) % this.items.length },
            prev(){ this.i = (this.i - 1 + this.items.length) % this.items.length },
            start(){ this.t = setInterval(() => this.next(), 5200) },
            stop(){ clearInterval(this.t) },
            init(){ this.start() }
          }"
          @mouseenter="stop()" @mouseleave="start()"
        >
          {{-- soft shape background --}}
          <div class="pointer-events-none absolute -top-16 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-tealsoft/18 blob blob-2"></div>
          <div class="pointer-events-none absolute -bottom-24 -right-24 w-[380px] h-[380px] bg-lemon/50 blob"></div>

          {{-- floating avatars around center --}}
          <div class="pointer-events-none absolute inset-0">
            <img class="w-12 h-12 rounded-full border-2 border-white shadow-sm absolute top-8 left-8 floaty" src="{{ $avatars[0] }}" alt="avatar">
            <img class="w-14 h-14 rounded-full border-2 border-white shadow-sm absolute top-10 right-14 floaty2" src="{{ $avatars[1] }}" alt="avatar">
            <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm absolute bottom-10 left-16 floaty2" src="{{ $avatars[2] }}" alt="avatar">
            <img class="w-12 h-12 rounded-full border-2 border-white shadow-sm absolute bottom-12 right-10 floaty" src="{{ $avatars[3] }}" alt="avatar">
            <img class="hidden sm:block w-16 h-16 rounded-full border-2 border-white shadow-sm absolute top-1/2 left-10 -translate-y-1/2 floaty" src="{{ $avatars[4] }}" alt="avatar">
          </div>

          <div class="relative">
            <div class="text-center">
              <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight">Loved by pet parents</h2>
              <p class="mt-2 text-ink/65 max-w-2xl mx-auto">
                Warm, trustworthy, and professional—but still playful where it matters.
              </p>
            </div>

            <div class="mt-8 sm:mt-10 max-w-3xl mx-auto">
              <div class="rounded-[2.2rem] bg-white/75 backdrop-blur border border-ink/10 shadow-sm p-6 sm:p-8">
                <div class="flex items-center justify-center gap-1 text-lemon">
                  @for ($k=0; $k<5; $k++)
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                      <path d="M12 17l-5 3 1.6-5.6L4 10.9l5.8-.2L12 5l2.2 5.7 5.8.2-4.6 3.5L17 20z"/>
                    </svg>
                  @endfor
                </div>

                <p class="mt-5 text-lg sm:text-xl text-ink/80 leading-relaxed text-center"
                   x-text="items[i].text"></p>

                <div class="mt-6 flex items-center justify-center gap-3">
                  <div class="w-12 h-12 rounded-full bg-tealsoft/20 border border-ink/10 grid place-items-center text-tealdeep">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M9 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M17 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      <path d="M3 20a6 6 0 0 1 12 0"/><path d="M14 20a5 5 0 0 1 7 0"/>
                    </svg>
                  </div>
                  <div class="text-center">
                    <div class="font-semibold" x-text="items[i].name"></div>
                    <div class="text-sm text-ink/60" x-text="items[i].role"></div>
                  </div>
                </div>

                <div class="mt-7 flex items-center justify-center gap-3">
                  <button type="button" class="hvr rounded-2xl px-4 py-2 border border-ink/10 bg-white/70 hover:bg-white shadow-sm"
                          @click="prev()">
                    Prev
                  </button>
                  <button type="button" class="hvr rounded-2xl px-4 py-2 bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep"
                          @click="next()">
                    Next
                  </button>
                </div>

                <div class="mt-4 flex items-center justify-center gap-2">
                  <template x-for="(t, idx) in items" :key="idx">
                    <button type="button"
                            class="hvr w-2.5 h-2.5 rounded-full"
                            :class="idx === i ? 'bg-tealsoft' : 'bg-ink/15 hover:bg-ink/25'"
                            @click="i = idx"
                            aria-label="Go to testimonial"></button>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Contact / CTA --}}
    <section id="contact" class="relative z-10">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-16 lg:pb-24">
        <div class="rounded-[2.2rem] bg-gradient-to-br from-white/80 to-mist/70 backdrop-blur border border-ink/10 shadow-soft overflow-hidden">
          <div class="relative p-6 sm:p-10">
            <div class="pointer-events-none absolute -top-24 -left-24 w-[320px] h-[320px] bg-sky/35 blob blob-2"></div>
            <div class="pointer-events-none absolute -bottom-28 -right-28 w-[420px] h-[420px] bg-lemon/55 blob"></div>

            <div class="relative grid lg:grid-cols-12 gap-8 items-center">
              <div class="lg:col-span-7">
                <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight">
                  Ready for stress-free care?
                </h2>
                <p class="mt-2 text-ink/70 max-w-2xl">
                  Send a quick request—our team will confirm availability and recommend the best plan for your pet.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                  <a href="#" class="inline-flex justify-center items-center hvr rounded-2xl px-5 py-3 font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
                    Request a booking
                  </a>
                  <a href="#" class="inline-flex justify-center items-center hvr rounded-2xl px-5 py-3 font-semibold bg-white/70 border border-ink/10 hover:bg-white shadow-sm">
                    View pricing
                  </a>
                </div>

                <div class="mt-6 grid sm:grid-cols-3 gap-3 text-sm text-ink/70">
                  <div class="rounded-2xl bg-white/70 border border-ink/10 p-4 shadow-sm">
                    <div class="text-xs text-ink/60">Hours</div>
                    <div class="font-semibold mt-1">Daily • 8am–8pm</div>
                  </div>
                  <div class="rounded-2xl bg-white/70 border border-ink/10 p-4 shadow-sm">
                    <div class="text-xs text-ink/60">Phone</div>
                    <div class="font-semibold mt-1">(021) 555-PAWS</div>
                  </div>
                  <div class="rounded-2xl bg-white/70 border border-ink/10 p-4 shadow-sm">
                    <div class="text-xs text-ink/60">Location</div>
                    <div class="font-semibold mt-1">Jakarta (demo)</div>
                  </div>
                </div>
              </div>

              <div class="lg:col-span-5">
                <form class="relative rounded-[2.2rem] bg-white/75 backdrop-blur border border-ink/10 shadow-sm p-6 sm:p-8">
                  <div class="font-semibold text-lg">Quick request</div>
                  <p class="mt-1 text-sm text-ink/60">We’ll reply within 1 business day.</p>

                  <div class="mt-5 space-y-3">
                    <label class="block">
                      <span class="text-sm font-medium text-ink/70">Name</span>
                      <input class="mt-1 w-full rounded-2xl border border-ink/10 bg-white px-4 py-3 outline-none focus:ring-4 focus:ring-tealsoft/15"
                             placeholder="Your name" />
                    </label>
                    <label class="block">
                      <span class="text-sm font-medium text-ink/70">Email</span>
                      <input type="email" class="mt-1 w-full rounded-2xl border border-ink/10 bg-white px-4 py-3 outline-none focus:ring-4 focus:ring-tealsoft/15"
                             placeholder="you@domain.com" />
                    </label>
                    <label class="block">
                      <span class="text-sm font-medium text-ink/70">Service</span>
                      <select class="mt-1 w-full rounded-2xl border border-ink/10 bg-white px-4 py-3 outline-none focus:ring-4 focus:ring-tealsoft/15">
                        @foreach ($services as $s)
                          <option>{{ $s['name'] }}</option>
                        @endforeach
                      </select>
                    </label>
                    <label class="block">
                      <span class="text-sm font-medium text-ink/70">Notes</span>
                      <textarea rows="3" class="mt-1 w-full rounded-2xl border border-ink/10 bg-white px-4 py-3 outline-none focus:ring-4 focus:ring-tealsoft/15"
                                placeholder="Tell us about your pet (age, temperament, anything important)"></textarea>
                    </label>
                  </div>

                  <button type="button"
                          class="mt-5 w-full hvr rounded-2xl px-5 py-3 font-semibold bg-tealsoft text-white shadow-lift hover:shadow-glow hover:bg-tealdeep">
                    Send request
                  </button>

                  <div class="mt-3 text-xs text-ink/50">
                    Demo form (no backend). Wire this to your Laravel route/controller when ready.
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    {{-- Footer with soft curved transition --}}
    <footer class="relative">
      <div class="absolute inset-x-0 -top-10 h-16 bg-gradient-to-b from-transparent to-bg"></div>
      <div class="bg-bg">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-10">
          <div class="rounded-[2.2rem] bg-white/70 backdrop-blur border border-ink/10 shadow-soft p-6 sm:p-10">
            <div class="grid md:grid-cols-12 gap-8">
              <div class="md:col-span-5">
                <div class="flex items-center gap-3">
                  <div class="w-11 h-11 rounded-2xl bg-tealsoft text-white shadow-lift grid place-items-center">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M8.5 11.5c-1.5-1.4-3.7-1.1-4.8.6-1 1.6-.3 3.6 1.5 4.2 1 .3 2.1.1 3-.6"/>
                      <path d="M15.5 11.5c1.5-1.4 3.7-1.1 4.8.6 1 1.6.3 3.6-1.5 4.2-1 .3-2.1.1-3-.6"/>
                      <path d="M9 16.2c1.8-1.5 4.2-1.5 6 0 1.8 1.5 1.6 4.3-.4 5.6-1.7 1.1-3.5 1.1-5.2 0-2-1.3-2.2-4.1-.4-5.6z"/>
                      <circle cx="8" cy="7.5" r="1.5"/>
                      <circle cx="12" cy="6.5" r="1.5"/>
                      <circle cx="16" cy="7.5" r="1.5"/>
                    </svg>
                  </div>
                  <div>
                    <div class="font-semibold tracking-tight text-lg">PawPal Care</div>
                    <div class="text-sm text-ink/60">Trustworthy, warm, modern pet care</div>
                  </div>
                </div>

                <p class="mt-4 text-sm text-ink/65 max-w-md">
                  Clean bright spaces, rounded UI energy, and a calm team.
                  Built to feel like a polished product—and a welcoming place for pets.
                </p>

                <div class="mt-5 flex items-center gap-3 text-sm text-ink/70">
                  <span class="inline-flex items-center gap-2 rounded-2xl bg-mist px-4 py-2 border border-ink/10">
                    <span class="w-2 h-2 rounded-full bg-tealsoft"></span>
                    hello@pawpal.care
                  </span>
                  <span class="inline-flex items-center gap-2 rounded-2xl bg-mist px-4 py-2 border border-ink/10">
                    (021) 555-PAWS
                  </span>
                </div>
              </div>

              <div class="md:col-span-7 grid sm:grid-cols-3 gap-6">
                <div>
                  <div class="font-semibold">Services</div>
                  <ul class="mt-3 space-y-2 text-sm text-ink/65">
                    @foreach ($services as $s)
                      <li><a class="hvr hover:text-ink" href="#services">{{ $s['name'] }}</a></li>
                    @endforeach
                  </ul>
                </div>
                <div>
                  <div class="font-semibold">Company</div>
                  <ul class="mt-3 space-y-2 text-sm text-ink/65">
                    <li><a class="hvr hover:text-ink" href="#why">Why PawPal</a></li>
                    <li><a class="hvr hover:text-ink" href="#testimonials">Testimonials</a></li>
                    <li><a class="hvr hover:text-ink" href="#contact">Contact</a></li>
                  </ul>
                </div>
                <div>
                  <div class="font-semibold">Visit</div>
                  <ul class="mt-3 space-y-2 text-sm text-ink/65">
                    <li>Daily: 8am–8pm</li>
                    <li>Jakarta (demo)</li>
                    <li class="text-ink/50">© {{ date('Y') }} PawPal Care</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="mt-8 pt-6 border-t border-ink/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-ink/50">
              <div>Design mood: warm • family-friendly • professional but playful</div>
              <div class="flex items-center gap-4">
                <a href="#" class="hvr hover:text-ink">Privacy</a>
                <a href="#" class="hvr hover:text-ink">Terms</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</body>
</html>