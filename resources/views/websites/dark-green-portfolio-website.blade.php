<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NEON — Visual Architect & Developer</title>
  
  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { 
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            display: ['Space Grotesk', 'sans-serif']
          },
          colors: {
            neon: '#CCFF00', 
            dark: '#050505',
            surface: '#0F0F10',
          },
          boxShadow: {
            'glow': '0 0 25px rgba(204, 255, 0, 0.2)',
            'glass': 'inset 0 0 0 1px rgba(255, 255, 255, 0.05)'
          }
        }
      }
    }
  </script>

  <style>
    :root {
      --primary: 204 255 0;
      --bg: #050505;
    }
    
    body {
      background-color: var(--bg);
      color: #FFFFFF;
      overflow-x: hidden;
    }

    /* Hero Background Overlay */
    .hero-gradient {
      background: linear-gradient(to bottom, rgba(5,5,5,0.2) 0%, rgba(5,5,5,0.8) 70%, #050505 100%);
    }

    /* Grain Overlay */
    .grain::before {
      content: "";
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background-image: url('https://grainy-gradients.vercel.app/noise.svg');
      opacity: 0.03;
      pointer-events: none;
      z-index: 99;
    }

    .bento-card {
      background: rgba(15, 15, 16, 0.5);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-radius: 1.5rem;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
    }

    .bento-card:hover {
      border-color: rgba(204, 255, 0, 0.3);
      transform: translateY(-5px);
      background: rgba(15, 15, 16, 0.8);
    }

    /* Page Transitions */
    [data-page] { display: none; }
    [data-page].is-active { 
      display: block; 
      animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .nav-glass {
      background: rgba(5, 5, 5, 0.7);
      backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .text-glow {
      text-shadow: 0 0 20px rgba(204, 255, 0, 0.5);
    }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: #050505; }
    ::-webkit-scrollbar-thumb { background: #CCFF00; border-radius: 10px; }
  </style>
</head>

<body class="dark font-sans grain">

  {{-- TOP NAVIGATION --}}
  <nav class="fixed top-0 left-0 w-full z-[100] nav-glass transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
      <a href="#/home" class="flex items-center gap-2 group">
        <div class="w-10 h-10 bg-neon rounded-lg flex items-center justify-center overflow-hidden">
            <span class="text-black font-black text-xl">N</span>
        </div>
        <span class="font-display font-bold text-xl tracking-tighter group-hover:text-neon transition-colors">NEON.STUDIO</span>
      </a>

      <div class="hidden md:flex items-center gap-8">
        @php
          $links = [
            ['l'=>'Overview','t'=>'#/home'],
            ['l'=>'Gallery','t'=>'#/gallery'],
            ['l'=>'Services','t'=>'#/services'],
            ['l'=>'Contact','t'=>'#/contact']
          ];
        @endphp
        @foreach($links as $link)
          <a href="{{ $link['t'] }}" data-nav-link class="text-sm font-bold uppercase tracking-widest text-neutral-400 hover:text-neon transition-colors relative group">
            {{ $link['l'] }}
            <span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-neon transition-all group-hover:w-full"></span>
          </a>
        @endforeach
      </div>

      <div class="flex items-center gap-4">
        <button data-theme-toggle class="p-2 text-neutral-400 hover:text-neon transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        </button>
        <a href="#/contact" class="bg-neon text-black px-6 py-2.5 rounded-full font-black text-xs uppercase tracking-widest hover:shadow-glow hover:scale-105 transition-all">
            Get Started
        </a>
      </div>
    </div>
  </nav>

  <main>
    
    {{-- PAGE: HOME --}}
    <section data-page="home">
      {{-- FULL HERO SECTION --}}
      <div class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        {{-- Hero Image --}}
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover" alt="Hero Background">
        
        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 hero-gradient"></div>

        {{-- Hero Content --}}
        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <div class="mb-6 inline-flex items-center gap-3 bg-white/5 border border-white/10 backdrop-blur-md px-6 py-2 rounded-full" data-aos="fade-down">
                <span class="w-2 h-2 bg-neon rounded-full animate-ping"></span>
                <span class="text-neon text-[10px] font-black uppercase tracking-[0.2em]">Visual Architect Studio</span>
            </div>
            <h1 class="font-display text-6xl md:text-[120px] font-bold tracking-[ -0.04em] leading-[0.85] mb-8" data-aos="zoom-out">
                BUILDING <br> <span class="text-neon text-glow italic">DIGITAL DNA.</span>
            </h1>
            <p class="text-neutral-300 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed mb-10">
                Specialized in high-end design systems and premium web experiences where aesthetics meet performance.
            </p>
            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <a href="#/gallery" class="bg-neon text-black px-10 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:shadow-glow transition-all w-full md:w-auto text-center">
                    Explore Work
                </a>
                <a href="#/services" class="border border-white/20 backdrop-blur-md text-white px-10 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white hover:text-black transition-all w-full md:w-auto text-center">
                    Our Process
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce opacity-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7"></path></svg>
        </div>
      </div>

      {{-- BENTO SECTIONS (Fold) --}}
      <div class="max-w-7xl mx-auto px-6 py-24 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            {{-- Big Intro Card --}}
            <div class="md:col-span-8 bento-card p-12">
                <h2 class="font-display text-4xl font-bold mb-6 italic tracking-tight">Crafting Interfaces <br>That Command Attention.</h2>
                <p class="text-neutral-400 text-lg leading-relaxed max-w-xl">
                    We believe the future of the web belongs to those who dare to be different. Our approach combines mathematical precision with artistic chaos.
                </p>
            </div>

            <div class="md:col-span-4 bento-card flex flex-col justify-center items-center p-8 bg-neon">
                <div class="text-black text-center">
                    <div class="font-display text-[80px] font-black leading-none">24/7</div>
                    <p class="font-black uppercase tracking-widest text-xs">Innovation Cycle</p>
                </div>
            </div>

            {{-- Stat Cards --}}
            @foreach(['Digital Strategy', 'Visual Identity', 'Motion Graphics'] as $item)
            <div class="md:col-span-4 bento-card p-10 flex flex-col justify-between aspect-square group">
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-neon group-hover:bg-neon group-hover:text-black transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h3 class="font-display text-2xl font-bold mb-2">{{ $item }}</h3>
                    <p class="text-neutral-500 text-sm">We define the core of your brand through rigorous design testing.</p>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </section>

    {{-- PAGE: SERVICES --}}
    <section data-page="services" class="max-w-7xl mx-auto px-6 pt-32 pb-24 space-y-6">
        <div class="bento-card p-16 text-center">
            <h2 class="font-display text-6xl font-bold mb-6 italic tracking-tighter">Strategic Impact.</h2>
            <p class="text-neutral-400 max-w-2xl mx-auto">We don't just design; we architect digital solutions that drive real growth and authority.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $svs = [
                    ['t' => 'UX Architecture', 'd' => 'Building complex user journeys into simple, intuitive interactions.', 'p' => '$2,500'],
                    ['t' => 'Cyber-Dev', 'd' => 'High-end development with GSAP animations and Next.js performance.', 'p' => '$4,000'],
                    ['t' => 'Art Direction', 'd' => 'Defining the visual soul of your brand through neon-minimalism.', 'p' => '$1,800']
                ];
            @endphp
            @foreach($svs as $s)
            <div class="bento-card p-10 flex flex-col justify-between min-h-[350px]">
                <span class="text-neon font-black text-sm tracking-widest uppercase italic">// service_{{ $loop->iteration }}</span>
                <div>
                    <h3 class="text-3xl font-bold mb-4 tracking-tighter">{{ $s['t'] }}</h3>
                    <p class="text-neutral-500 text-sm mb-8 leading-relaxed">{{ $s['d'] }}</p>
                    <div class="flex items-end justify-between border-t border-white/10 pt-6">
                        <span class="text-xs uppercase font-black text-neutral-500">From</span>
                        <span class="font-display text-3xl font-bold tracking-tighter">{{ $s['p'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- PAGE: GALLERY --}}
    <section data-page="gallery" class="max-w-7xl mx-auto px-6 pt-32 pb-24 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end mb-12">
            <div class="md:col-span-8">
                <h2 class="font-display text-7xl font-bold tracking-tighter">Visual <span class="text-neon italic text-glow">Archives</span></h2>
            </div>
            <div class="md:col-span-4 flex justify-end gap-2">
                @foreach(['All', 'UI/UX', 'Art'] as $f)
                    <button class="px-6 py-2 rounded-full text-[10px] font-black uppercase tracking-widest border border-white/10 hover:bg-neon hover:text-black transition-all" data-gallery-filter="{{ $f }}">
                        {{ $f }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            @php
                $imgs = [
                    ['s'=>'md:col-span-7', 't'=>'Ether-X Interface', 'tag'=>'UI/UX', 'u'=>'https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070'],
                    ['s'=>'md:col-span-5', 't'=>'Chrome Aesthetics', 'tag'=>'Art', 'u'=>'https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=2070'],
                    ['s'=>'md:col-span-5', 't'=>'Digital Monolith', 'tag'=>'Art', 'u'=>'https://images.unsplash.com/photo-1633356122544-f134324a6cee?q=80&w=2070'],
                    ['s'=>'md:col-span-7', 't'=>'Cyber Workspace', 'tag'=>'UI/UX', 'u'=>'https://images.unsplash.com/photo-1510511459019-5dee99c48fc8?q=80&w=2070']
                ];
            @endphp
            @foreach($imgs as $i)
            <div class="{{ $i['s'] }} group bento-card h-[500px] relative cursor-pointer" data-gallery-item data-gallery-tag="{{ $i['tag'] }}" data-gallery-src="{{ $i['u'] }}" data-gallery-title="{{ $i['t'] }}">
                <img src="{{ $i['u'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700 opacity-40 group-hover:opacity-70">
                <div class="absolute inset-0 p-10 flex flex-col justify-end bg-gradient-to-t from-dark to-transparent">
                    <span class="text-neon text-[10px] font-black uppercase tracking-[0.3em] mb-4">{{ $i['tag'] }}</span>
                    <h3 class="text-4xl font-bold tracking-tighter">{{ $i['t'] }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- PAGE: CONTACT --}}
    <section data-page="contact" class="max-w-7xl mx-auto px-6 pt-32 pb-24 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-4 bento-card p-12 bg-neon text-black">
                <h2 class="font-display text-5xl font-black tracking-tighter italic leading-none mb-12">Start the <br>Mission.</h2>
                <div class="space-y-6">
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest mb-2 opacity-50">Studio Access</div>
                        <div class="text-xl font-bold">Berlin, Germany</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest mb-2 opacity-50">Direct Line</div>
                        <div class="text-xl font-bold">hello@neon.studio</div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-8 bento-card p-12">
                <form class="space-y-8" data-contact-form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Your Full Name</label>
                            <input type="text" name="name" class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 outline-none focus:border-neon transition-all" placeholder="Enter name..." required>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Email Address</label>
                            <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 outline-none focus:border-neon transition-all" placeholder="Enter email..." required>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">Project Brief</label>
                        <textarea name="message" rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 outline-none focus:border-neon transition-all" placeholder="Tell us about your project..."></textarea>
                    </div>
                    <button class="bg-neon text-black px-12 py-5 rounded-full font-black uppercase tracking-widest text-xs hover:shadow-glow transition-all">Send Transmission</button>
                    <p class="text-xs text-center text-neutral-500 mt-4" data-contact-note></p>
                </form>
            </div>
        </div>
    </section>
  </main>

  {{-- FOOTER --}}
  <footer class="max-w-7xl mx-auto px-6 py-12 border-t border-white/5 text-center md:text-left">
    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <p class="text-neutral-500 text-xs font-bold uppercase tracking-widest">© 2025 NEON STUDIO. ARCHITECTING DIGITAL SPACES.</p>
        <div class="flex gap-8">
            @foreach(['X','Instagram','GitHub'] as $s)
                <a href="#" class="text-xs font-black uppercase tracking-widest text-neutral-400 hover:text-neon transition-colors">{{ $s }}</a>
            @endforeach
        </div>
    </div>
  </footer>

  {{-- LIGHTBOX MODAL --}}
  <div class="fixed inset-0 z-[200] hidden bg-dark/95 backdrop-blur-2xl p-6" data-lightbox>
    <button class="absolute top-10 right-10 text-white hover:text-neon" data-lightbox-close>
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2"/></svg>
    </button>
    <div class="h-full flex flex-col items-center justify-center max-w-6xl mx-auto">
        <img src="" class="max-h-[75vh] w-auto rounded-2xl mb-10 shadow-2xl border border-white/10" data-lightbox-img>
        <div class="text-center">
            <h2 class="text-5xl font-display font-bold tracking-tighter" data-lightbox-title></h2>
            <p class="text-neon uppercase text-[10px] font-black mt-4 tracking-[0.5em]" data-lightbox-tag></p>
        </div>
    </div>
  </div>

  <script>
    // NAVIGATION SCROLL EFFECT
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            nav.classList.add('h-16');
            nav.classList.remove('h-20');
            nav.classList.add('shadow-2xl');
        } else {
            nav.classList.add('h-20');
            nav.classList.remove('h-16');
            nav.classList.remove('shadow-2xl');
        }
    });

    // SPA ROUTER
    function router() {
      const hash = window.location.hash || '#/home';
      const route = hash.replace('#/', '');
      
      document.querySelectorAll('[data-page]').forEach(p => {
        p.classList.toggle('is-active', p.dataset.page === route);
      });

      document.querySelectorAll('[data-nav-link]').forEach(l => {
        const isActive = l.getAttribute('href') === hash;
        l.classList.toggle('text-neon', isActive);
        l.classList.toggle('bg-white/5', isActive);
      });
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('hashchange', router);
    window.addEventListener('load', router);

    // GALLERY & LIGHTBOX
    const lb = document.querySelector('[data-lightbox]');
    const lbImg = lb.querySelector('[data-lightbox-img]');
    const lbTitle = lb.querySelector('[data-lightbox-title]');
    const lbTag = lb.querySelector('[data-lightbox-tag]');

    document.querySelectorAll('[data-gallery-item]').forEach(item => {
        item.addEventListener('click', () => {
            lbImg.src = item.dataset.gallerySrc;
            lbTitle.textContent = item.dataset.galleryTitle;
            lbTag.textContent = item.dataset.galleryTag;
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });
    });

    document.querySelector('[data-lightbox-close]').addEventListener('click', () => {
        lb.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    // CONTACT FORM
    document.querySelector('[data-contact-form]').addEventListener('submit', (e) => {
        e.preventDefault();
        const note = document.querySelector('[data-contact-note]');
        note.textContent = "Transmission successful. Neon is on the way.";
        e.target.reset();
    });
  </script>
</body>
</html>