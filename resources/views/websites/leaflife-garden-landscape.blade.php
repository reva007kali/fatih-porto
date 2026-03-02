
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LeafLife — Bespoke Landscape Architecture</title>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            sans: ['"Plus Jakarta Sans"', 'sans-serif']
          },
          colors: {
            forest: {
              50: '#f2f4f2', 100: '#e1e7e0', 200: '#c5d0c3', 300: '#9fb19b',
              400: '#738a6f', 500: '#566d52', 600: '#435640', 700: '#374635',
              800: '#2d382c', 900: '#273026', 950: '#131a13'
            },
            sage: '#a3b18a',
            earth: '#493d32',
            paper: '#faf9f6'
          }
        }
      }
    }
  </script>

  {{-- AOS & Alpine --}}
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    [x-cloak] { display: none !important; }
    
    /* Immersive Hero Zoom */
    @keyframes kenburns {
      0% { transform: scale(1); }
      100% { transform: scale(1.1); }
    }
    .animate-kenburns {
      animation: kenburns 20s ease-out infinite alternate;
    }

    .glass-nav {
      background: rgba(250, 249, 246, 0.8);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .text-stroke {
      -webkit-text-stroke: 1px rgba(255, 255, 255, 0.6);
      color: transparent;
    }

    .hero-gradient {
      background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.2) 40%, rgba(0,0,0,0.7) 100%);
    }
  </style>
</head>

<body class="bg-paper text-forest-950 font-sans selection:bg-forest-200">

@php
  $imgHero = "https://plus.unsplash.com/premium_photo-1668096747228-c32252e8943f?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
  $imgAbout = "https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1200&q=80";
  $imgService1 = "https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1200&q=80";
  $imgService2 = "https://images.unsplash.com/photo-1598902108854-10e335adac99?auto=format&fit=crop&w=1200&q=80";
  $imgWork1 = "https://images.unsplash.com/photo-1557429287-b2e26467fc2b?auto=format&fit=crop&w=1200&q=80";
  $imgWork2 = "https://images.unsplash.com/photo-1510672981848-a1c4f1cb5ccf?auto=format&fit=crop&w=1200&q=80";
@endphp

{{-- STICKY NAV --}}
<nav x-data="{ scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 50)"
     :class="scrolled ? 'glass-nav py-3 border-b border-forest-100 shadow-sm' : 'py-6'"
     class="fixed top-0 w-full z-50 transition-all duration-300">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between">
    <a href="#top" class="flex items-center gap-2 group">
      <div class="w-10 h-10 bg-forest-700 rounded-full flex items-center justify-center text-white transition-transform group-hover:rotate-12">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"/></svg>
      </div>
      <span class="font-bold text-xl tracking-tighter" :class="scrolled ? 'text-forest-900' : 'text-white'">LEAFLIFE</span>
    </a>

    <div class="hidden md:flex items-center gap-10 text-sm font-medium uppercase tracking-widest"
         :class="scrolled ? 'text-forest-700' : 'text-white/90'">
      <a href="#about" class="hover:text-forest-500 transition">Philosophy</a>
      <a href="#services" class="hover:text-forest-500 transition">Expertise</a>
      <a href="#projects" class="hover:text-forest-500 transition">Gallery</a>
      <a href="#contact" class="px-6 py-2 bg-forest-800 text-white rounded-full hover:bg-forest-600 transition shadow-lg">Inquiry</a>
    </div>

    {{-- Mobile Trigger --}}
    <button class="md:hidden p-2 rounded-lg" :class="scrolled ? 'text-forest-900' : 'text-white'">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
  </div>
</nav>

{{-- FULL-SCREEN HERO --}}
<header id="top" class="relative h-screen w-full overflow-hidden flex items-center">
  {{-- Background Layer --}}
  <div class="absolute inset-0 z-0">
    <img src="{{ $imgHero }}" alt="Luxury Garden" class="w-full h-full object-cover animate-kenburns">
    <div class="absolute inset-0 hero-gradient"></div>
  </div>

  <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-12">
    <div class="max-w-4xl" data-aos="fade-up" data-aos-duration="1200">
      <span class="inline-block py-1 px-3 border border-white/30 rounded-full text-white text-[10px] uppercase tracking-[0.3em] backdrop-blur-sm mb-6">
        Est. 2012 • Premium Landscape Architecture
      </span>
      <h1 class="font-display text-white text-6xl md:text-8xl lg:text-[10rem] leading-[0.85] font-medium italic">
        Sculpting <br>
        <span class="text-stroke not-italic font-black">Nature.</span>
      </h1>
      
      <div class="mt-12 flex flex-col md:flex-row md:items-center gap-8">
        <p class="text-white/80 text-lg md:text-xl max-w-md leading-relaxed font-light">
          We transform ordinary outdoor spaces into living masterpieces that evolve with the seasons.
        </p>
        <div class="flex gap-4">
          <a href="#contact" class="h-16 w-16 md:h-20 md:w-20 bg-white rounded-full flex items-center justify-center text-forest-900 hover:scale-110 transition-transform shadow-2xl">
            <svg class="w-6 h-6 rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
          </a>
          <span class="text-white text-sm self-center font-semibold uppercase tracking-widest">Start a Project</span>
        </div>
      </div>
    </div>
  </div>

  {{-- Scroll Indicator --}}
  <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
    <span class="text-white/50 text-[10px] uppercase tracking-widest">Scroll</span>
    <div class="w-px h-12 bg-gradient-to-b from-white/50 to-transparent"></div>
  </div>
</header>

{{-- PHILOSOPHY --}}
<section id="about" class="py-24 lg:py-32 bg-white overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    <div class="grid lg:grid-cols-2 gap-20 items-center">
      <div class="relative" data-aos="fade-right">
        <div class="aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl">
          <img src="{{ $imgAbout }}" alt="Our Work" class="w-full h-full object-cover">
        </div>
        <div class="absolute -bottom-10 -right-10 hidden md:block w-64 h-64 bg-forest-50 rounded-2xl -z-10 border border-forest-100"></div>
        <div class="absolute top-12 -left-12 bg-forest-900 p-8 rounded-2xl text-white shadow-xl hidden xl:block">
          <p class="font-display text-4xl mb-1">12+</p>
          <p class="text-xs uppercase tracking-widest opacity-60">Years of Craft</p>
        </div>
      </div>

      <div data-aos="fade-left">
        <h2 class="text-forest-500 font-bold uppercase tracking-[0.2em] text-sm mb-4">The Philosophy</h2>
        <h3 class="font-display text-4xl md:text-6xl text-forest-950 leading-tight mb-8">
          Harmony between <span class="italic text-forest-400 font-normal">Modernity</span> and the Wild.
        </h3>
        <p class="text-forest-700/80 text-lg leading-relaxed mb-10">
          Our approach isn't just about planting trees. It’s about understanding the soil, the light, and your rhythm of life. We design "outdoor rooms" that invite silence, conversation, and growth.
        </p>
        
        <div class="grid grid-cols-2 gap-8">
          <div>
            <h4 class="font-bold text-forest-900 mb-2">Sustainable</h4>
            <p class="text-sm text-forest-600">Local flora and water-smart systems built for the future.</p>
          </div>
          <div>
            <h4 class="font-bold text-forest-900 mb-2">Artisanal</h4>
            <p class="text-sm text-forest-600">Hand-selected stone and bespoke timber work in every project.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SERVICES (BENTO GRID) --}}
<section id="services" class="py-24 bg-forest-50">
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    <div class="text-center mb-16">
      <h2 class="font-display text-5xl md:text-7xl">Our Expertise</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      {{-- Card 1 --}}
      <div class="md:col-span-2 group relative h-96 rounded-3xl overflow-hidden shadow-lg" data-aos="fade-up">
        <img src="{{ $imgService1 }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        <div class="absolute bottom-8 left-8 text-white">
          <h3 class="text-3xl font-display mb-2">Estate Transformation</h3>
          <p class="text-white/70 max-w-sm">Large scale landscape architecture for heritage homes and modern villas.</p>
        </div>
      </div>
      
      {{-- Card 2 --}}
      <div class="group relative h-96 rounded-3xl overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ $imgService2 }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="">
        <div class="absolute inset-0 bg-forest-900/40 group-hover:bg-forest-900/20 transition-colors"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
          <h3 class="text-2xl font-display mb-2">Urban Oasis</h3>
          <p class="text-sm opacity-80">Rooftops and courtyards reimagined for city living.</p>
        </div>
      </div>

      {{-- Card 3 --}}
      <div class="bg-forest-900 rounded-3xl p-10 text-white flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-sage">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div>
          <h3 class="text-2xl font-display mb-4 italic">Bespoke Lighting</h3>
          <p class="text-white/60 text-sm">Professional lighting design that makes your garden breathe at night.</p>
          <a href="#" class="mt-6 inline-block text-sage text-xs font-bold uppercase tracking-widest border-b border-sage/30 pb-1">View Details</a>
        </div>
      </div>

      {{-- Card 4 --}}
      <div class="md:col-span-2 bg-white rounded-3xl p-10 border border-forest-100 flex items-center gap-8" data-aos="fade-up" data-aos-delay="300">
        <div class="hidden sm:block w-1/3 aspect-square rounded-2xl overflow-hidden">
          <img src="{{ $imgWork2 }}" class="w-full h-full object-cover" alt="">
        </div>
        <div class="flex-1">
          <h3 class="text-2xl font-display text-forest-900 mb-4">Consultation & Planning</h3>
          <p class="text-forest-600 text-sm leading-relaxed mb-6">Start with a 1-on-1 strategy session to map out your vision, budget, and ecological footprint.</p>
          <button class="px-8 py-3 bg-forest-100 text-forest-800 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-forest-800 hover:text-white transition">Book Session</button>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CONTACT / CTA --}}
<section id="contact" class="relative py-24 bg-forest-950 overflow-hidden">
  <div class="absolute top-0 right-0 w-1/2 h-full opacity-20 pointer-events-none">
     <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
      <path fill="#a3b18a" d="M44.7,-76.4C58.1,-69.2,69.2,-57.4,77.3,-43.8C85.4,-30.2,90.5,-15.1,88.7,-0.9C87,13.2,78.5,26.4,69.5,38.2C60.5,50,51,60.3,39.4,68.8C27.8,77.3,13.9,84,0.1,83.9C-13.7,83.7,-27.4,76.8,-39.7,68.6C-52,60.4,-62.8,50.9,-71.3,39.4C-79.8,27.8,-86,14.3,-86.3,-0.1C-86.5,-14.5,-80.8,-29,-71.5,-41.2C-62.2,-53.4,-49.2,-63.3,-35.3,-70.2C-21.3,-77,-10.7,-80.8,2.7,-85.4C16,-90,31.4,-90.4,44.7,-76.4Z" transform="translate(100 100)" />
    </svg>
  </div>

  <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 text-center lg:text-left">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div>
        <h2 class="font-display text-5xl md:text-7xl text-white leading-tight mb-8">
          Let’s grow <br><span class="italic text-sage font-light">something beautiful</span> together.
        </h2>
        <div class="space-y-6">
          <div class="flex items-center gap-4 text-white/60">
            <span class="w-12 h-px bg-white/20"></span>
            <span class="text-sm tracking-[0.3em] uppercase">Based in Portland, OR</span>
          </div>
          <p class="text-white/50 text-lg max-w-md">Currently accepting bookings for Summer 2026. Limited slots available for architectural consulting.</p>
        </div>
      </div>

      <div class="bg-white p-8 md:p-12 rounded-[40px] shadow-2xl" data-aos="zoom-in">
        <form action="#" class="space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <input type="text" placeholder="Name" class="w-full bg-forest-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-sage outline-none">
            <input type="email" placeholder="Email" class="w-full bg-forest-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-sage outline-none">
          </div>
          <select class="w-full bg-forest-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-sage outline-none text-forest-400">
            <option>Service Type</option>
            <option>Residential Garden</option>
            <option>Commercial Landscape</option>
          </select>
          <textarea rows="4" placeholder="Briefly describe your space..." class="w-full bg-forest-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-sage outline-none"></textarea>
          <button class="w-full py-5 bg-forest-900 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-forest-800 transition shadow-xl">Send Inquiry</button>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="py-12 bg-white border-t border-forest-100">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
    <p class="text-forest-400 text-sm italic font-display">Crafting serenity since 2012.</p>
    <div class="flex gap-8 text-xs font-bold uppercase tracking-widest text-forest-900">
      <a href="#" class="hover:text-sage transition">Instagram</a>
      <a href="#" class="hover:text-sage transition">Pinterest</a>
      <a href="#" class="hover:text-sage transition">LinkedIn</a>
    </div>
    <p class="text-forest-400 text-[10px] uppercase tracking-widest">© {{ date('Y') }} LeafLife Studio.</p>
  </div>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100,
    easing: 'ease-out-quint'
  });
</script>

</body>
</html>