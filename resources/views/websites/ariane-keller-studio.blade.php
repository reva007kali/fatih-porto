<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Ariane Keller — Design & Strategy</title>

  {{-- Fonts: Inter for Swiss Sans, Space Mono for 'Technical' labels --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Space+Mono&display=swap" rel="stylesheet">

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- AOS --}}
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui'],
            mono: ['Space Mono', 'monospace'],
          },
          colors: {
            paper: '#FAF9F6',
            beige: {
              50: '#F2EFE9',
              100: '#E8E2D6',
              200: '#D9C5B2', // Primary Accent
              300: '#BCA48C',
            },
            ink: '#121212',
            border: 'rgba(18,18,18,0.1)',
          },
          letterSpacing: {
            tightest: '-.04em',
            tighter: '-.02em',
            widest: '.2em',
          }
        }
      }
    }
  </script>

  <style>
    body { background-color: #FAF9F6; color: #121212; -webkit-font-smoothing: antialiased; }
    
    /* Swiss Grid Utilities */
    .grid-container {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 24px;
      max-width: 1440px;
      margin: 0 auto;
      padding: 0 40px;
    }

    .hairline { border-top: 1px solid rgba(18,18,18,0.1); }
    .hairline-v { border-left: 1px solid rgba(18,18,18,0.1); }

    /* Typography scale */
    .display-1 { font-size: clamp(3rem, 8vw, 7.5rem); line-height: 0.9; font-weight: 800; letter-spacing: -0.05em; }
    .label-mono { font-family: 'Space Mono', monospace; font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: #666; }
    
    /* Interactive */
    .hover-link { position: relative; transition: color 0.3s ease; }
    .hover-link::after { 
        content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 1px; 
        background: currentColor; transition: width 0.3s ease; 
    }
    .hover-link:hover::after { width: 100%; }

    .btn-swiss {
        background: #D9C5B2;
        padding: 12px 24px;
        font-family: 'Space Mono', monospace;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .btn-swiss:hover { background: #121212; color: #FAF9F6; }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #FAF9F6; }
    ::-webkit-scrollbar-thumb { background: #D9C5B2; }
  </style>
</head>

<body class="font-sans">

    <!-- NAVIGATION -->
    <nav class="fixed top-0 w-full z-50 bg-paper/80 backdrop-blur-md border-b border-border">
        <div class="grid-container py-6 items-center">
            <div class="col-span-6 md:col-span-4 flex items-center gap-4">
                <span class="font-bold tracking-tightest text-xl">AK—STUDIO</span>
            </div>
            <div class="hidden md:flex col-span-4 justify-center gap-8 items-center">
                <a href="#work" class="label-mono hover-link">Work</a>
                <a href="#about" class="label-mono hover-link">About</a>
                <a href="#contact" class="label-mono hover-link">Contact</a>
            </div>
            <div class="col-span-6 md:col-span-4 flex justify-end">
                <a href="#contact" class="btn-swiss">Start Project</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <header class="pt-40 pb-20 md:pt-56 md:pb-32">
        <div class="grid-container">
            <div class="col-span-12 lg:col-span-9" data-aos="fade-up">
                <div class="label-mono mb-6 flex items-center gap-3">
                    <span class="w-8 h-[1px] bg-ink"></span>
                    Available for Q3 2024
                </div>
                <h1 class="display-1 mb-12">
                    Creating <span class="italic font-light">visual</span> order for bold leaders.
                </h1>
            </div>
            
            <div class="col-span-12 lg:col-span-3 flex flex-col justify-end pb-4" data-aos="fade-up" data-aos-delay="200">
                <p class="text-lg leading-relaxed text-neutral-600 mb-8">
                    Swiss-inspired personal branding for executives and creative founders who value clarity over noise.
                </p>
                <div class="w-full aspect-square bg-beige-200 p-8 flex flex-col justify-between overflow-hidden relative group">
                    <div class="label-mono text-ink">Identity / Digital / Print</div>
                    <div class="text-4xl">↗</div>
                    <div class="absolute inset-0 bg-ink translate-y-full group-hover:translate-y-0 transition-transform duration-500 p-8 flex flex-col justify-between">
                        <div class="label-mono text-paper">Methodology</div>
                        <p class="text-paper text-sm">Strict grids, warm palettes, and editorial hierarchy.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- HORIZONTAL RULE SECTION -->
    <div class="grid-container">
        <div class="col-span-12 hairline"></div>
    </div>

    <!-- SELECTED WORK -->
    <section id="work" class="py-24">
        <div class="grid-container mb-20">
            <div class="col-span-12 md:col-span-6">
                <div class="label-mono mb-4">Index — 01</div>
                <h2 class="text-5xl font-bold tracking-tightest">Selected Projects</h2>
            </div>
        </div>

        <div class="grid-container gap-y-24">
            <!-- Project 1 -->
            <div class="col-span-12 md:col-span-7" data-aos="fade-up">
                <div class="overflow-hidden bg-beige-100 aspect-[4/5] mb-6">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=1200&q=80" 
                         class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700 hover:scale-105" 
                         alt="Project">
                </div>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold italic mb-1">Evelyn Vance</h3>
                        <p class="label-mono">Strategy & Creative Direction</p>
                    </div>
                    <div class="text-sm uppercase tracking-widest pt-2">2024</div>
                </div>
            </div>

            <!-- Project 2 (Offset) -->
            <div class="col-span-12 md:col-start-9 md:col-span-4 self-center" data-aos="fade-up" data-aos-delay="200">
                <div class="overflow-hidden bg-beige-200 aspect-square mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" 
                         class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700 hover:scale-105" 
                         alt="Project">
                </div>
                <h3 class="text-2xl font-bold mb-1">Marcus Thorne</h3>
                <p class="label-mono">Digital Ecosystem</p>
            </div>

            <!-- Project 3 -->
            <div class="col-span-12 md:col-span-5" data-aos="fade-up">
                <div class="bg-beige-50 p-12 aspect-square mb-6 flex flex-col justify-center border border-border">
                    <span class="display-1 text-beige-200">Aa</span>
                    <p class="mt-8 text-neutral-500 font-mono text-xs">A typography-first approach to identity. We built a custom grid system that defines every touchpoint from mobile to billboard.</p>
                </div>
                <h3 class="text-2xl font-bold mb-1">The Monograph Series</h3>
                <p class="label-mono">Editorial Design</p>
            </div>
        </div>
    </section>

    <!-- SERVICES / STATS -->
    <section class="bg-ink text-paper py-32">
        <div class="grid-container">
            <div class="col-span-12 md:col-span-4" data-aos="fade-right">
                <div class="label-mono text-beige-200 mb-8">What I solve</div>
                <h2 class="text-4xl font-bold tracking-tightest leading-none">The Swiss approach to digital identity.</h2>
            </div>
            
            <div class="col-span-12 md:col-span-7 md:col-start-6 space-y-12">
                <div class="hairline border-paper/20 pt-8" data-aos="fade-up">
                    <div class="flex items-start gap-8">
                        <span class="label-mono text-beige-200">01</span>
                        <div>
                            <h4 class="text-2xl font-bold mb-4">Precision Grid Systems</h4>
                            <p class="text-paper/60 max-w-md">I don't just "place" elements. I engineer layouts based on mathematical ratios to ensure perfect balance on every screen size.</p>
                        </div>
                    </div>
                </div>
                <div class="hairline border-paper/20 pt-8" data-aos="fade-up">
                    <div class="flex items-start gap-8">
                        <span class="label-mono text-beige-200">02</span>
                        <div>
                            <h4 class="text-2xl font-bold mb-4">Editorial Hierarchy</h4>
                            <p class="text-paper/60 max-w-md">Your message shouldn't compete with the design. I use white space as a tool to guide your audience through your story.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section id="contact" class="py-32">
        <div class="grid-container">
            <div class="col-span-12 lg:col-span-5 mb-16 lg:mb-0" data-aos="fade-right">
                <div class="label-mono mb-4">Ready to start?</div>
                <h2 class="display-1 mb-8">Let's talk.</h2>
                <div class="space-y-2">
                    <p class="text-xl">hello@arianekeller.studio</p>
                    <p class="text-xl">+41 44 234 56 78</p>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-7" data-aos="fade-left">
                <form class="grid grid-cols-2 gap-8">
                    <div class="col-span-2 md:col-span-1">
                        <label class="label-mono block mb-2">Name</label>
                        <input type="text" class="w-full bg-transparent border-b border-ink/20 py-4 focus:outline-none focus:border-beige-200 transition-colors">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label class="label-mono block mb-2">Email</label>
                        <input type="email" class="w-full bg-transparent border-b border-ink/20 py-4 focus:outline-none focus:border-beige-200 transition-colors">
                    </div>
                    <div class="col-span-2">
                        <label class="label-mono block mb-2">Message</label>
                        <textarea rows="4" class="w-full bg-transparent border-b border-ink/20 py-4 focus:outline-none focus:border-beige-200 transition-colors"></textarea>
                    </div>
                    <div class="col-span-2 pt-8">
                        <button type="submit" class="btn-swiss w-full md:w-auto px-12 py-5 text-lg">Send Inquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-12 border-t border-border">
        <div class="grid-container">
            <div class="col-span-12 md:col-span-6 flex flex-col md:flex-row gap-8 items-center">
                <span class="label-mono">© 2024 Ariane Keller</span>
                <span class="label-mono">Built in Zurich</span>
            </div>
            <div class="col-span-12 md:col-span-6 flex justify-center md:justify-end gap-8">
                <a href="#" class="label-mono hover-link">LinkedIn</a>
                <a href="#" class="label-mono hover-link">Instagram</a>
                <a href="#" class="label-mono hover-link">Layers</a>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // AOS init with standard scroll behavior
        AOS.init({
            duration: 1000,
            easing: 'ease-out-quart',
            once: true,
            offset: 100
        });

        // Simple parallax for the hero display text (Native)
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroText = document.querySelector('.display-1');
            if (heroText) {
                heroText.style.transform = `translateY(${scrolled * 0.15}px)`;
            }
        });
    </script>
</body>
</html>