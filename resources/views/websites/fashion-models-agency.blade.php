{{-- resources/views/agency.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Fashion Models Agency — Demo</title>

  {{-- Tailwind (CDN) --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', 'sans-serif'],
            display: ['Space Grotesk', 'Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            ink: '#0c0c0c',
            coal: '#141414',
            ash: '#1d1d1d',
            paper: '#f5f5f5',
            accent: '#d94b3d',
          },
          letterSpacing: {
            tighter2: '-0.04em',
            wide2: '0.18em',
          }
        }
      }
    }
  </script>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

  {{-- AOS --}}
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>

  <style>
    :root { color-scheme: dark; scroll-behavior: smooth; }
    html, body { background: #0c0c0c; }

    /* A bit more “editorial” */
    .hairline { height: 1px; background: rgba(255,255,255,.12); }
    .muted { color: rgba(245,245,245,.68); }
    .tiny { font-size: 11px; letter-spacing: .18em; text-transform: uppercase; }

    /* Decorative circle lines */
    .ring {
      position: absolute;
      width: 380px; height: 380px;
      border: 1px solid rgba(255,255,255,.16);
      border-radius: 9999px;
      pointer-events: none;
      filter: blur(.0px);
    }

    /* Better text rendering */
    body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

    /* Custom scrollbar */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.12); border-radius: 999px; }
    ::-webkit-scrollbar-track { background: rgba(0,0,0,.2); }
  </style>
</head>

<body class="bg-ink text-paper font-sans">
  {{-- Fixed micro header --}}
  <header class="fixed inset-x-0 top-0 z-50 bg-ink/50 backdrop-blur-md md:bg-transparent md:backdrop-blur-none">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
      <div class="flex items-center justify-between py-5">
        <div class="flex items-center gap-3">
          <div class="h-2 w-2 rounded-full bg-paper/80"></div>
          <span class="tiny text-paper/80">FASHION MODELS AGENCY</span>
        </div>

        <nav class="hidden md:flex items-center gap-6 text-xs tracking-[0.22em] uppercase text-paper/70">
          <a class="hover:text-paper transition" href="#models">Models</a>
          <a class="hover:text-paper transition" href="#about">About</a>
          <a class="hover:text-paper transition" href="#contact">Contact</a>
        </nav>

        <a href="#contact"
           class="inline-flex items-center gap-2 rounded-full border border-paper/20 px-4 py-2 text-xs tracking-[0.22em] uppercase text-paper/80 hover:text-paper hover:border-paper/35 transition">
          Request booking
          <span aria-hidden="true" class="text-paper/50">↗</span>
        </a>
      </div>
    </div>
  </header>

  <main>

    {{-- HERO (B/W portrait + big right title) --}}
    <section class="relative min-h-[100vh] pt-24 pb-12 flex flex-col justify-end overflow-hidden">
      <div class="absolute inset-0">
        {{-- Background image --}}
        <img
          src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=2400&q=80"
          alt="Editorial portrait"
          class="h-full w-full object-cover grayscale"
        />
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-b from-transparent to-ink"></div>

        {{-- Decorative rings --}}
        <div class="ring left-6 top-24 hidden md:block"></div>
        <div class="ring right-24 top-40 hidden lg:block" style="width:520px;height:520px;border-color:rgba(255,255,255,.10)"></div>
      </div>

      <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
        <div class="grid gap-10 lg:grid-cols-12 items-end">
          <div class="lg:col-span-5">
            <div class="max-w-md pt-8" data-aos="fade-up" data-aos-duration="800">
              <p class="tiny text-paper/60">Our philosophy</p>
              <div class="hairline my-4 w-20"></div>
              <p class="text-sm leading-relaxed text-paper/70">
                A modern, editorial-first modeling agency. We build careers with precision:
                portfolio direction, casting strategy, brand alignment, and show bookings.
              </p>
              <p class="mt-3 text-sm leading-relaxed text-paper/55">
                Based worldwide — operating with a small roster, high-touch management, and
                a creative network of photographers, stylists, and directors.
              </p>
            </div>
          </div>

          <div class="lg:col-span-7">
            <div class="pb-10 lg:pb-14">
              <div class="flex justify-end" data-aos="fade-left" data-aos-duration="900">
                <h1 class="font-display text-right leading-[0.92] tracking-tighter2 text-paper
                           text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
                  <span class="block">FASHION—</span>
                  <span class="block">MODELS</span>
                  <span class="block">—AGENCY</span>
                </h1>
              </div>

              <div class="mt-6 flex justify-end" data-aos="fade-up" data-aos-delay="100">
                <div class="max-w-sm text-right text-xs tracking-[0.22em] uppercase text-paper/55">
                  new faces · editorial · runway · commercial
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- TITLE BAND (dark, big editorial type) --}}
    <section id="models" class="bg-coal">
      <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="grid items-center gap-8 py-14 lg:grid-cols-12">
          <div class="lg:col-span-8" data-aos="fade-up" data-aos-duration="800">
            <h2 class="font-display tracking-tighter2 text-4xl sm:text-5xl md:text-6xl">
              IMG —<br class="sm:hidden">
              MODELS<br class="hidden sm:block">
              — LILY ALDRIDGE
            </h2>
          </div>

          <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
            <p class="text-sm leading-relaxed text-paper/65">
              A cross-season direction grounded in editorial identity, silhouette consistency,
              and high-frequency test shoots. Built for campaigns, shows, and long-term brand work.
            </p>
            <div class="mt-5 flex items-center gap-3">
              <span class="tiny text-paper/55">(fashion)</span>
              <span class="h-[1px] w-10 bg-paper/20"></span>
              <span class="tiny text-paper/55">portfolio 2026</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- RED FEATURE SECTION --}}
    <section class="relative">
      <div class="absolute inset-0 bg-accent"></div>
      <div class="relative mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="grid gap-10 lg:grid-cols-12 items-end">
          <div class="lg:col-span-5" data-aos="fade-right" data-aos-duration="900">
            <p class="text-xs tracking-[0.22em] uppercase text-paper/85">Career development</p>
            <div class="hairline my-4 w-20 bg-paper/25"></div>
            <p class="text-sm leading-relaxed text-paper/90">
              We focus on building the career of models by providing strategic support, contracts
              guidance, and creative direction. We collaborate with photographers, stylists, makeup artists,
              and production teams to craft signature imagery for print and screens.
            </p>
            <p class="mt-4 text-sm leading-relaxed text-paper/85">
              From new faces to established talents — our management is tailored, consistent, and measurable.
            </p>
          </div>

          <div class="lg:col-span-7">
            <div class="relative overflow-hidden rounded-sm border border-black/20 bg-black/10"
                 data-aos="zoom-in" data-aos-duration="900">
              <img
                src="https://images.unsplash.com/photo-1620818655725-d388f51eb29f?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Model in coat on red"
                class="h-[520px] w-full object-cover object-center"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

              <div class="absolute left-5 bottom-5 right-5 grid gap-4 md:grid-cols-2">
                <div class="text-[11px] leading-relaxed tracking-wide text-paper/85">
                  WE ARE WORKING ON DEVELOPING THE CAREER OF MODELS, PROVIDING SUPPORT, ADVERTISING,
                  AND CONTRACTS. WE ALSO COLLABORATE WITH CREATIVE PRODUCERS FOR FILMING & SCREENINGS.
                </div>
                <div class="text-[11px] leading-relaxed tracking-wide text-paper/85 md:text-right">
                  OUR AGENCY FINDS UNIQUE TALENTS, RUNS AUDITIONS, AND BUILDS INDIVIDUAL PROMOTION
                  STRATEGIES FOR EACH MODEL — FROM TEST SHOOTS TO SHOW SEASON.
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-14 hairline bg-paper/20"></div>
      </div>
    </section>

    {{-- ABOUT + GALLERY --}}
    <section id="about" class="bg-coal">
      <div class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="grid gap-10 lg:grid-cols-12 items-start">
          <div class="lg:col-span-5" data-aos="fade-up">
            <p class="tiny text-paper/55">A professional organization</p>
            <div class="hairline my-4 w-20"></div>
            <p class="text-sm leading-relaxed text-paper/65">
              We operate with a compact roster and a global partner network. Our focus is to
              maintain consistency in identity, casting, and deliverables — while protecting
              the long-term value of each career.
            </p>

            <div class="mt-8 flex items-center gap-4">
              <a href="#contact"
                 class="inline-flex items-center gap-2 border-b border-paper/30 pb-1 text-xs tracking-[0.22em] uppercase text-paper/80 hover:text-paper hover:border-paper/60 transition">
                See all photo
                <span aria-hidden="true">→</span>
              </a>
              <span class="text-paper/35">/</span>
              <span class="text-xs tracking-[0.22em] uppercase text-paper/55">Fashion Models Agency</span>
            </div>
          </div>

          <div class="lg:col-span-7" data-aos="fade-left" data-aos-duration="900">
            <div class="flex justify-end">
              <h3 class="font-display text-right tracking-tighter2 leading-[0.92]
                         text-4xl sm:text-5xl md:text-6xl">
                ABOUT—<br>
                OUR<br>
                —AGENCY
              </h3>
            </div>
          </div>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-12">
          {{-- Vertical label (left) --}}
          <div class="hidden lg:flex lg:col-span-1 items-stretch justify-center">
            <div class="w-full flex items-center justify-center">
              <div class="rotate-180 [writing-mode:vertical-rl] text-xs tracking-[0.22em] uppercase text-paper/45">
                FASHION MODELS AGENCY
              </div>
            </div>
          </div>

          {{-- Gallery grid --}}
          <div class="lg:col-span-11 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Card 1 --}}
            <article class="group relative overflow-hidden rounded-sm border border-paper/10 bg-ash"
                     data-aos="fade-up" data-aos-duration="800">
              <img
                src="https://images.unsplash.com/photo-1520975916090-3105956dac38?auto=format&fit=crop&w=1600&q=80"
                alt="Portrait 01"
                class="h-80 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
              <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                <div>
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/80">Karla Pereira</p>
                  <p class="text-[11px] text-paper/60">Editorial</p>
                </div>
                <span class="text-paper/70 text-xs tracking-[0.22em] uppercase">Fashion</span>
              </div>
            </article>

            {{-- Card 2 --}}
            <article class="group relative overflow-hidden rounded-sm border border-paper/10 bg-ash"
                     data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
              <img
                src="https://images.unsplash.com/photo-1520975661595-6453be3f7070?auto=format&fit=crop&w=1600&q=80"
                alt="Portrait 02"
                class="h-80 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
              <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                <div>
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/80">Nora L.</p>
                  <p class="text-[11px] text-paper/60">Runway</p>
                </div>
                <span class="text-paper/70 text-xs tracking-[0.22em] uppercase">Agency</span>
              </div>
            </article>

            {{-- Card 3 --}}
            <article class="relative overflow-hidden rounded-sm border border-paper/10 bg-accent"
                     data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
              <div class="p-6 h-80 flex flex-col justify-between">
                <div>
                  <p class="tiny text-paper/90">Season notes</p>
                  <div class="hairline my-4 w-16 bg-paper/40"></div>
                  <p class="text-sm leading-relaxed text-paper/95">
                    A tight roster. Strong silhouettes. Editorial-first direction with show-ready pacing.
                  </p>
                </div>
                <div class="flex items-end justify-between">
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/90">Casting</p>
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/80">SS/26</p>
                </div>
              </div>
            </article>

            {{-- Card 4 --}}
            <article class="group relative overflow-hidden rounded-sm border border-paper/10 bg-ash sm:col-span-2 lg:col-span-2"
                     data-aos="fade-up" data-aos-delay="50" data-aos-duration="800">
              <img
                src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?auto=format&fit=crop&w=2200&q=80"
                alt="Wide editorial"
                class="h-80 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
              <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                <div>
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/80">Studio Series</p>
                  <p class="text-[11px] text-paper/60">Commercial / Beauty</p>
                </div>
                <span class="text-paper/70 text-xs tracking-[0.22em] uppercase">Portfolio</span>
              </div>
            </article>

            {{-- Card 5 --}}
            <article class="group relative overflow-hidden rounded-sm border border-paper/10 bg-ash"
                     data-aos="fade-up" data-aos-delay="120" data-aos-duration="800">
              <img
                src="https://images.unsplash.com/photo-1517630800677-932d836ab680?auto=format&fit=crop&w=1600&q=80"
                alt="Portrait 03"
                class="h-80 w-full object-cover grayscale group-hover:grayscale-0 transition duration-500"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
              <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                <div>
                  <p class="text-xs tracking-[0.22em] uppercase text-paper/80">Ariane K.</p>
                  <p class="text-[11px] text-paper/60">Lookbook</p>
                </div>
                <span class="text-paper/70 text-xs tracking-[0.22em] uppercase">Fashion</span>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    {{-- CONTACT / FOOTER --}}
    <section id="contact" class="bg-ink">
      <div class="mx-auto max-w-7xl px-5 sm:px-8 py-16">
        <div class="grid gap-10 lg:grid-cols-12 items-start">
          <div class="lg:col-span-6" data-aos="fade-up">
            <h4 class="font-display tracking-tighter2 text-3xl sm:text-4xl md:text-5xl leading-[1.02]">
              BOOKINGS &<br> CASTINGS — 2026
            </h4>
            <p class="mt-5 text-sm leading-relaxed text-paper/65 max-w-lg">
              For bookings, development, and partnerships: send a brief, links to portfolio, and availability.
              We respond within 2–3 business days.
            </p>

            <div class="mt-8 grid gap-3 text-sm">
              <div class="flex items-center justify-between border-b border-paper/10 py-3">
                <span class="text-paper/65">Email</span>
                <span class="text-paper/85">bookings@agency.demo</span>
              </div>
              <div class="flex items-center justify-between border-b border-paper/10 py-3">
                <span class="text-paper/65">Office</span>
                <span class="text-paper/85">Global / Remote</span>
              </div>
              <div class="flex items-center justify-between border-b border-paper/10 py-3">
                <span class="text-paper/65">Instagram</span>
                <span class="text-paper/85">@agency.demo</span>
              </div>
            </div>
          </div>

          <div class="lg:col-span-6" data-aos="fade-left" data-aos-duration="900">
            <form class="rounded-sm border border-paper/10 bg-coal p-6 sm:p-8">
              <div class="grid gap-5 sm:grid-cols-2">
                <label class="block">
                  <span class="tiny text-paper/55">Name</span>
                  <input type="text"
                         class="mt-2 w-full rounded-sm bg-ink/60 border border-paper/10 px-3 py-3 text-sm text-paper placeholder:text-paper/30 focus:outline-none focus:ring-2 focus:ring-paper/20"
                         placeholder="Your name" />
                </label>
                <label class="block">
                  <span class="tiny text-paper/55">Email</span>
                  <input type="email"
                         class="mt-2 w-full rounded-sm bg-ink/60 border border-paper/10 px-3 py-3 text-sm text-paper placeholder:text-paper/30 focus:outline-none focus:ring-2 focus:ring-paper/20"
                         placeholder="you@domain.com" />
                </label>
              </div>

              <label class="mt-5 block">
                <span class="tiny text-paper/55">Message</span>
                <textarea rows="5"
                          class="mt-2 w-full rounded-sm bg-ink/60 border border-paper/10 px-3 py-3 text-sm text-paper placeholder:text-paper/30 focus:outline-none focus:ring-2 focus:ring-paper/20"
                          placeholder="Tell us about your project / dates / usage..."></textarea>
              </label>

              <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <p class="text-xs text-paper/45">
                  Demo form UI (no backend). Hook to your Laravel route if needed.
                </p>
                <button type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-paper text-ink px-5 py-3 text-xs tracking-[0.22em] uppercase hover:bg-white transition">
                  Send request
                  <span aria-hidden="true">↗</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="mt-14 hairline"></div>
        <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between text-xs tracking-[0.22em] uppercase text-paper/45">
          <span>© {{ date('Y') }} Fashion Models Agency (Demo)</span>
          <span>Design: editorial / monochrome / accent</span>
        </div>
      </div>
    </section>

  </main>

  {{-- Scripts --}}
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    // Initialize AOS
    document.addEventListener('DOMContentLoaded', function() {
      AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-out-cubic',
        offset: 120,
        disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
      });
    });
  </script>
</body>
</html>