{{-- resources/views/portfolio.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ADRIAN STONE — Digital Architect</title>
  <meta name="description" content="Portfolio Neo-Brutalism modern untuk desainer & developer." />
  <meta name="theme-color" content="#bcfe2f" />

  {{-- Tailwind (CDN) --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- AOS (Animate On Scroll) --}}
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Mono:wght@400;700&family=Inter:wght@400;900&display=swap" rel="stylesheet">
  
  {{-- Icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    :root {
      --ink: #000000;
      --paper: #f0f0f0;
      --accent: #bcfe2f;   /* Cyber Lime */
      --accent2: #00e5ff;  /* Electric Cyan */
      --accent3: #ff2e97;  /* Hot Pink */
      --accent4: #ffc700;  /* Vivid Amber */
      --border-w: 4px;
      --brutal-shadow: 10px 10px 0px var(--ink);
      --brutal-shadow-sm: 5px 5px 0px var(--ink);
      --brutal-shadow-hover: 15px 15px 0px var(--ink);
    }

    html { scroll-behavior: smooth; }

    body {
      background-color: var(--paper);
      color: var(--ink);
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
    }

    .archivo { font-family: 'Archivo Black', sans-serif; }
    .mono { font-family: 'Space Mono', monospace; }

    /* Dot Matrix Background */
    .bg-dots {
      background-image: radial-gradient(var(--ink) 1.5px, transparent 1.5px);
      background-size: 32px 32px;
    }

    /* Neo-Brutal Cards */
    .nb-card {
      background: white;
      border: var(--border-w) solid var(--ink);
      box-shadow: var(--brutal-shadow);
      transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .nb-card:hover {
      transform: translate(-5px, -5px);
      box-shadow: var(--brutal-shadow-hover);
    }

    /* Buttons */
    .nb-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: var(--border-w) solid var(--ink);
      box-shadow: var(--brutal-shadow-sm);
      font-weight: 900;
      text-transform: uppercase;
      transition: all 0.1s ease;
      cursor: pointer;
    }
    .nb-btn:hover {
      transform: translate(-3px, -3px);
      box-shadow: 8px 8px 0px var(--ink);
    }
    .nb-btn:active {
      transform: translate(3px, 3px);
      box-shadow: 0px 0px 0px var(--ink);
    }

    /* Marquee Animation */
    .marquee {
      overflow: hidden;
      white-space: nowrap;
      border-top: var(--border-w) solid var(--ink);
      border-bottom: var(--border-w) solid var(--ink);
      background: var(--accent4);
      padding: 10px 0;
    }
    .marquee-content {
      display: inline-block;
      animation: marquee 20s linear infinite;
      font-weight: 900;
      text-transform: uppercase;
      font-size: 1.5rem;
    }
    @keyframes marquee {
      from { transform: translateX(0); }
      to { transform: translateX(-50%); }
    }

    /* Custom Input */
    .nb-input {
      border: var(--border-w) solid var(--ink);
      box-shadow: var(--brutal-shadow-sm);
      padding: 1rem;
      outline: none;
      width: 100%;
    }
    .nb-input:focus {
      background: #fff;
      box-shadow: 8px 8px 0px var(--accent3);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 16px; }
    ::-webkit-scrollbar-track { background: var(--paper); border-left: var(--border-w) solid var(--ink); }
    ::-webkit-scrollbar-thumb {
      background: var(--accent);
      border: 4px solid var(--ink);
    }

    /* Rotation Utility */
    .rotate-brutal { transform: rotate(-2deg); }
    .rotate-brutal-reverse { transform: rotate(2deg); }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'brutal-green': '#bcfe2f',
            'brutal-cyan': '#00e5ff',
            'brutal-pink': '#ff2e97',
            'brutal-yellow': '#ffc700',
          }
        }
      }
    }
  </script>
</head>

<body class="bg-dots">

  {{-- NAVIGATION --}}
  <nav class="sticky top-0 z-[100] bg-white border-b-[4px] border-black">
    <div class="max-w-[1400px] mx-auto flex justify-between items-center h-20 px-6">
      <a href="#top" class="archivo text-2xl tracking-tighter flex items-center gap-2">
        <span class="bg-brutal-green px-2 border-4 border-black">A.STONE</span>
      </a>

      <div class="hidden md:flex gap-1">
        @foreach(['About' => '#about', 'Skills' => '#skills', 'Projects' => '#projects', 'Experience' => '#experience', 'Contact' => '#contact'] as $label => $link)
          <a href="{{ $link }}" class="nb-btn bg-white px-4 py-2 text-sm">{{ $label }}</a>
        @endforeach
      </div>

      <div class="flex items-center gap-4">
        <button id="copyEmailBtn" class="hidden lg:flex nb-btn bg-brutal-cyan px-4 py-2 text-sm">
          HIRE ME
        </button>
        <button id="menuBtn" class="md:hidden nb-btn bg-white p-2 w-12 h-12">
          <i class="fa-solid fa-bars-staggered text-xl"></i>
        </button>
      </div>
    </div>
    
    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden md:hidden bg-white border-b-4 border-black p-6">
        <div class="flex flex-col gap-3">
            @foreach(['About' => '#about', 'Skills' => '#skills', 'Projects' => '#projects', 'Experience' => '#experience', 'Contact' => '#contact'] as $label => $link)
                <a href="{{ $link }}" class="nb-btn bg-white w-full py-4">{{ $label }}</a>
            @endforeach
        </div>
    </div>
  </nav>

  {{-- MARQUEE --}}
  <div class="marquee">
    <div class="marquee-content">
      AVAILABLE FOR PROJECTS • SHIPS FAST • NEO-BRUTAL UI • LARAVEL EXPERT • AVAILABLE FOR PROJECTS • SHIPS FAST • NEO-BRUTAL UI • LARAVEL EXPERT • 
    </div>
  </div>

  <main class="max-w-[1400px] mx-auto px-6">
    
    {{-- HERO SECTION --}}
    <section id="top" class="py-16 md:py-24 grid lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-7" data-aos="zoom-out-right">
        <div class="inline-block bg-brutal-pink text-white archivo px-4 py-1 border-4 border-black mb-6 rotate-brutal">
          DIGITAL ARCHITECT
        </div>
        <h1 class="archivo text-5xl md:text-8xl leading-[0.9] mb-8">
            BOLD <span class="bg-brutal-green px-4 border-4 border-black inline-block my-2">IDEAS</span> <br> 
            FOR BOLD <span class="bg-brutal-cyan px-4 border-4 border-black inline-block my-2">BRANDS.</span>
        </h1>
        <p class="text-xl md:text-2xl font-bold max-w-2xl mb-10 leading-relaxed">
          Saya Adrian, seorang <span class="underline decoration-4 decoration-brutal-pink">Hybrid Designer & Developer</span> yang percaya bahwa website harus berteriak, bukan sekadar berbisik.
        </p>
        
        <div class="flex flex-wrap gap-4">
          <a href="#projects" class="nb-btn bg-brutal-green text-xl px-8 py-4">View Work <i class="fa-solid fa-arrow-right ml-2"></i></a>
          <button id="downloadBtn" class="nb-btn bg-white text-xl px-8 py-4">Resume.pdf</button>
        </div>

        <div class="mt-16 grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="nb-card p-6 bg-white rotate-brutal-reverse">
                <span class="block archivo text-4xl">08+</span>
                <span class="mono font-bold text-sm">Years Experience</span>
            </div>
            <div class="nb-card p-6 bg-brutal-yellow">
                <span class="block archivo text-4xl">40+</span>
                <span class="mono font-bold text-sm">Projects Done</span>
            </div>
            <div class="nb-card p-6 bg-brutal-cyan hidden md:block rotate-brutal">
                <span class="block archivo text-4xl">100%</span>
                <span class="mono font-bold text-sm">Satisfaction</span>
            </div>
        </div>
      </div>

      <div class="lg:col-span-5 relative" data-aos="zoom-out-left">
        <div class="nb-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?q=80&w=800&auto=format&fit=crop" class="w-full h-[500px] object-cover grayscale hover:grayscale-0 transition-all duration-500" alt="Adrian Stone">
        </div>
        {{-- Floating Badge --}}
        <div class="absolute -bottom-10 -left-10 nb-card p-6 bg-brutal-green max-w-[200px] hidden sm:block rotate-brutal">
            <p class="archivo text-lg leading-tight">BASED IN EARTH, WORKING REMOTE.</p>
        </div>
      </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="py-20 border-t-4 border-black">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div data-aos="fade-right">
            <h2 class="archivo text-5xl md:text-6xl mb-8">WHO THE <span class="text-brutal-pink">HELL</span> IS ADRIAN?</h2>
            <div class="space-y-6 text-lg font-medium">
                <p>Saya bukan sekadar pembuat tombol. Saya membangun sistem yang mengonversi pengunjung menjadi pembeli menggunakan estetika **Neo-Brutalism** yang berani dan teknik rekayasa yang pragmatis.</p>
                <p>Kombinasi antara Laravel (otak) dan Tailwind (wajah) memungkinkan saya menciptakan produk digital yang tidak hanya estetik tapi juga performant dan skalabel.</p>
            </div>
            
            <div class="mt-10 grid sm:grid-cols-2 gap-4">
                <div class="nb-card p-4 bg-white border-dashed">
                    <i class="fa-solid fa-check-double text-2xl mb-2 text-brutal-green"></i>
                    <h4 class="font-black">Design Systems</h4>
                    <p class="text-sm">Membangun UI yang konsisten dan reusable.</p>
                </div>
                <div class="nb-card p-4 bg-white border-dashed">
                    <i class="fa-solid fa-code text-2xl mb-2 text-brutal-cyan"></i>
                    <h4 class="font-black">Clean Code</h4>
                    <p class="text-sm">Struktur Laravel yang rapi dan mudah dirawat.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4" data-aos="fade-left">
            <div class="nb-card aspect-square bg-brutal-cyan flex items-center justify-center p-8 text-center rotate-brutal">
                <p class="archivo text-2xl">LOUD VISUALS</p>
            </div>
            <div class="nb-card aspect-square bg-white flex flex-col items-center justify-center p-8 text-center">
                <i class="fa-solid fa-bolt text-5xl mb-4 text-brutal-yellow"></i>
                <p class="archivo text-2xl">FAST LOAD</p>
            </div>
            <div class="nb-card aspect-square bg-black text-white flex flex-col items-center justify-center p-8 text-center">
                <i class="fa-solid fa-mobile-screen text-5xl mb-4"></i>
                <p class="archivo text-xl">MOBILE FIRST</p>
            </div>
            <div class="nb-card aspect-square bg-brutal-green flex items-center justify-center p-8 text-center rotate-brutal-reverse">
                <p class="archivo text-2xl">PIXEL PERFECT</p>
            </div>
        </div>
      </div>
    </section>

    {{-- SKILLS SECTION --}}
    <section id="skills" class="py-20 border-t-4 border-black">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="archivo text-5xl md:text-7xl">MY <span class="bg-brutal-yellow px-4 border-4 border-black">WEAPONS</span></h2>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        @php
            $skillsets = [
                ['Frontend', 'HTML5, CSS3, Tailwind, JS, Alpine.js', 'bg-brutal-green'],
                ['Backend', 'PHP, Laravel, MySQL, Redis, API', 'bg-brutal-cyan'],
                ['Design', 'Figma, UI/UX, Brutalism, Branding', 'bg-brutal-pink']
            ];
        @endphp

        @foreach($skillsets as $s)
        <div class="nb-card p-8 {{ $s[2] }}" data-aos="zoom-in-up">
            <h3 class="archivo text-3xl mb-4 uppercase">{{ $s[0] }}</h3>
            <div class="h-1 bg-black mb-6"></div>
            <p class="font-bold text-lg leading-relaxed">{{ $s[1] }}</p>
            <div class="mt-8 flex justify-end">
                <i class="fa-solid fa-toolbox text-4xl opacity-30"></i>
            </div>
        </div>
        @endforeach
      </div>
    </section>

    {{-- PROJECTS SECTION --}}
    <section id="projects" class="py-20 border-t-4 border-black">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div data-aos="fade-right">
                <h2 class="archivo text-5xl md:text-7xl uppercase">Selected <br> <span class="text-brutal-cyan">Works</span></h2>
            </div>
            <div class="flex flex-wrap gap-2" data-aos="fade-left">
                @foreach(['all', 'web', 'ui', 'dash'] as $cat)
                    <button class="nb-btn bg-white px-6 py-2 filterBtn active:bg-brutal-green" data-filter="{{ $cat }}">{{ strtoupper($cat) }}</button>
                @endforeach
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            @php
            $projects = [
                ['web', 'Neon Checkout', 'Conversion-heavy landing page.', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800', ['Laravel','Tailwind']],
                ['dash', 'Ops Control', 'Internal monitoring system.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800', ['MySQL','Charts']],
                ['ui', 'Brutal Kit', 'Component system for SaaS.', 'https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&w=800', ['Design','Tokens']],
                ['web', 'Agency X', 'Digital agency portfolio v2.', 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800', ['SEO','AOS']],
            ];
            @endphp

            @foreach($projects as $p)
            <div class="nb-card overflow-hidden projectCard group" data-cat="{{ $p[0] }}" data-aos="fade-up">
                <div class="relative overflow-hidden border-b-4 border-black">
                    <img src="{{ $p[3] }}" alt="{{ $p[1] }}" class="w-full h-[300px] object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="nb-card bg-brutal-yellow px-3 py-1 text-xs font-black mono uppercase">{{ $p[0] }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="archivo text-3xl mb-2">{{ $p[1] }}</h3>
                    <p class="font-bold opacity-80 mb-6">{{ $p[2] }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($p[4] as $tag)
                            <span class="nb-card bg-white px-3 py-1 text-[10px] font-black mono">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <div class="flex gap-4">
                        <button class="nb-btn bg-brutal-green px-6 py-2 flex-1 openProjectBtn" 
                                data-title="{{ $p[1] }}" data-desc="{{ $p[2] }}" data-img="{{ $p[3] }}" data-cat="{{ $p[0] }}">PREVIEW</button>
                        <button class="nb-btn bg-white p-2 w-12 h-12 shareBtn" data-title="{{ $p[1] }}"><i class="fa-solid fa-share-nodes"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- EXPERIENCE --}}
    <section id="experience" class="py-20 border-t-4 border-black">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-4" data-aos="fade-right">
                <h2 class="archivo text-5xl mb-6">SURVIVAL <br> <span class="bg-brutal-pink text-white px-2 border-4 border-black">LOGS</span></h2>
                <p class="font-bold text-lg leading-relaxed">Perjalanan karir saya dari tahun ke tahun, fokus pada eksekusi dan hasil nyata.</p>
            </div>
            <div class="lg:col-span-8 space-y-6" data-aos="fade-left">
                @php
                $xp = [
                    ['2024 - NOW', 'Senior Freelance Dev', 'Membangun MVP untuk startup Silicon Valley.'],
                    ['2021 - 2023', 'Frontend Lead @ Agency', 'Memimpin tim untuk merilis 20+ produk digital.'],
                    ['2018 - 2021', 'UI Designer', 'Belajar bahwa user experience di atas segalanya.']
                ];
                @endphp

                @foreach($xp as $x)
                <div class="nb-card p-6 bg-white flex flex-col md:flex-row gap-6 items-start">
                    <div class="nb-card bg-brutal-yellow px-4 py-2 mono font-black text-sm whitespace-nowrap">{{ $x[0] }}</div>
                    <div>
                        <h4 class="archivo text-2xl uppercase">{{ $x[1] }}</h4>
                        <p class="font-bold opacity-70">{{ $x[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="py-20 border-t-4 border-black">
        <div class="grid md:grid-cols-3 gap-8">
            @php
            $tests = [
                ['“Konversinya gila setelah redesign.”', 'Sarah J.', 'CEO Startup', 'bg-brutal-green'],
                ['“Cepat, bersih, dan berkarakter.”', 'Mike R.', 'Product Lead', 'bg-brutal-cyan'],
                ['“Gak ribet.Adrian tau apa yang dia lakukan.”', 'Deni K.', 'Founder', 'bg-brutal-yellow']
            ];
            @endphp
            @foreach($tests as $t)
            <div class="nb-card p-8 {{ $t[3] }} rotate-brutal-reverse" data-aos="flip-up">
                <p class="archivo text-xl mb-6 leading-tight">{{ $t[0] }}</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full border-4 border-black bg-white overflow-hidden">
                        <img src="https://i.pravatar.cc/100?u={{ $t[1] }}" alt="Avatar">
                    </div>
                    <div>
                        <div class="font-black uppercase text-sm">{{ $t[1] }}</div>
                        <div class="mono text-[10px] font-bold opacity-70">{{ $t[2] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- NOTES / LAB --}}
    <section class="py-20 border-t-4 border-black overflow-hidden">
        <div class="flex items-center gap-8 mb-12">
            <h2 class="archivo text-5xl whitespace-nowrap uppercase">Lab Notes</h2>
            <div class="h-[4px] bg-black w-full"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $notes = [
                ['Design', 'Kenapa Neo-Brutalism akan tren di 2026.'],
                ['Code', 'Mengoptimalkan Eloquent untuk data besar.'],
                ['UX', 'Membangun form yang tidak membosankan.'],
                ['Life', 'Produktivitas tanpa rasa burnout.']
            ];
            @endphp
            @foreach($notes as $n)
            <a href="#" class="nb-card p-6 bg-white hover:bg-black hover:text-white group">
                <span class="mono text-xs font-black uppercase mb-4 block opacity-60 group-hover:opacity-100">{{ $n[0] }}</span>
                <h4 class="archivo text-xl mb-6">{{ $n[1] }}</h4>
                <div class="nb-btn bg-brutal-green text-black px-4 py-2 text-xs">READ <i class="fa-solid fa-arrow-right ml-2"></i></div>
            </a>
            @endforeach
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section id="contact" class="py-20 border-t-4 border-black">
        <div class="nb-card bg-black text-white p-8 md:p-16 relative overflow-hidden">
            {{-- Decoration --}}
            <div class="absolute top-0 right-0 p-10 opacity-20 hidden lg:block">
                <i class="fa-solid fa-paper-plane text-[200px] -rotate-12"></i>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 relative z-10">
                <div data-aos="fade-right">
                    <h2 class="archivo text-5xl md:text-7xl mb-8 leading-none uppercase">Let's build <br> something <br> <span class="text-brutal-green underline">ICONIC</span></h2>
                    <p class="text-xl mb-12 font-bold opacity-80">Ada ide proyek? Kirim pesan dan mari kita buat dunia sedikit lebih berisik.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 nb-card bg-brutal-pink flex items-center justify-center text-black">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <span class="archivo text-lg tracking-tight" id="emailText">adrian.stone@example.com</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 nb-card bg-brutal-cyan flex items-center justify-center text-black">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <span class="archivo text-lg tracking-tight" id="phoneText">+1 (555) 010-2046</span>
                        </div>
                    </div>
                </div>

                <form id="contactForm" class="nb-card p-8 bg-white text-black" data-aos="fade-left">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="mono font-black text-xs block mb-2 uppercase">Your Name</label>
                            <input type="text" id="name" class="nb-input" placeholder="Wick John" required>
                            <p class="text-red-500 text-xs mt-2 hidden" data-err="name">Name is required.</p>
                        </div>
                        <div>
                            <label class="mono font-black text-xs block mb-2 uppercase">Email Address</label>
                            <input type="email" id="email" class="nb-input" placeholder="john@example.com" required>
                            <p class="text-red-500 text-xs mt-2 hidden" data-err="email">Valid email is required.</p>
                        </div>
                        <div>
                            <label class="mono font-black text-xs block mb-2 uppercase">What are you building?</label>
                            <textarea id="message" rows="4" class="nb-input" placeholder="Tell me everything..." required></textarea>
                            <p class="text-red-500 text-xs mt-2 hidden" data-err="message">Message is required.</p>
                        </div>
                        <button type="submit" class="nb-btn bg-brutal-green w-full py-4 text-xl">SEND MESSAGE <i class="fa-solid fa-paper-plane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="py-20 border-t-4 border-black">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
            <div class="archivo text-4xl leading-none">ADRIAN <br> STONE.</div>
            
            <div class="flex gap-4">
                <a href="#" class="nb-btn bg-white w-14 h-14 text-2xl"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="nb-btn bg-brutal-cyan w-14 h-14 text-2xl"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#" class="nb-btn bg-brutal-pink w-14 h-14 text-2xl"><i class="fa-brands fa-dribbble"></i></a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-6 items-center border-t-4 border-black pt-8">
            <p class="mono text-xs font-black">© {{ date('Y') }} ADRIAN STONE. BUILT WITH BRUTALITY.</p>
            <div class="flex gap-6">
                <button id="themePunchBtn" class="nb-btn bg-brutal-yellow px-4 py-1 text-[10px]">REMIX UI</button>
                <a href="#top" class="mono text-xs font-black hover:underline uppercase tracking-widest">Back to top ↑</a>
            </div>
        </div>
    </footer>

  </main>

  {{-- MODAL --}}
  <div id="modal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
    <div class="nb-card bg-white w-full max-w-4xl relative z-10 p-0 overflow-hidden flex flex-col md:flex-row">
        <div class="md:w-1/2 border-b-4 md:border-b-0 md:border-r-4 border-black">
            <img id="modalImg" src="" class="w-full h-full object-cover">
        </div>
        <div class="md:w-1/2 p-8">
            <button id="modalClose" class="absolute top-4 right-4 nb-btn bg-white p-2 w-10 h-10">X</button>
            <span id="modalBadge" class="nb-card px-3 py-1 bg-brutal-yellow text-[10px] mono font-black uppercase mb-4 inline-block">WEB</span>
            <h3 id="modalTitle" class="archivo text-4xl mb-4">Project Title</h3>
            <p id="modalDesc" class="font-bold mb-8 leading-relaxed opacity-80">Full project description goes here. It explains the challenge and the solution in detail.</p>
            
            <div class="nb-card p-6 bg-brutal-green">
                <p class="archivo text-lg mb-4">WANT SOMETHING LIKE THIS?</p>
                <a href="#contact" onclick="closeModal()" class="nb-btn bg-white w-full py-2">GET A QUOTE</a>
            </div>
        </div>
    </div>
  </div>

  {{-- TOAST --}}
  <div id="toast" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[2000] hidden">
    <div class="nb-card bg-white px-8 py-4 archivo border-4 border-black shadow-none flex items-center gap-4">
        <div class="w-4 h-4 bg-brutal-cyan border-2 border-black"></div>
        <span id="toastText">COPIED!</span>
    </div>
  </div>

  {{-- SCRIPTS --}}
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, duration: 800 });

    // Menu Mobile
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    menuBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    // Toast
    const toast = document.getElementById('toast');
    const toastText = document.getElementById('toastText');
    function showToast(msg) {
        toastText.textContent = msg;
        toast.classList.remove('hidden');
        setTimeout(() => toast.classList.add('hidden'), 2000);
    }

    // Copy Email/Phone
    const copyEmail = (text) => {
        navigator.clipboard.writeText(text);
        showToast("EMAIL COPIED!");
    };
    document.getElementById('copyEmailBtn')?.addEventListener('click', () => copyEmail("adrian.stone@example.com"));

    // Filter Project
    const filterBtns = document.querySelectorAll('.filterBtn');
    const projectCards = document.querySelectorAll('.projectCard');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const f = btn.dataset.filter;
            filterBtns.forEach(b => b.classList.remove('bg-brutal-green'));
            btn.classList.add('bg-brutal-green');
            projectCards.forEach(c => {
                c.classList.toggle('hidden', f !== 'all' && c.dataset.cat !== f);
            });
        });
    });

    // Modal
    const modal = document.getElementById('modal');
    const modalClose = document.getElementById('modalClose');
    const openModalBtns = document.querySelectorAll('.openProjectBtn');

    function openModal(data) {
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDesc').textContent = data.desc;
        document.getElementById('modalImg').src = data.img;
        document.getElementById('modalBadge').textContent = data.cat;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => openModal(btn.dataset));
    });
    modalClose.addEventListener('click', closeModal);

    // Form Validation
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const msg = document.getElementById('message').value;

        if (name && email && msg) {
            showToast("PREPARING EMAIL...");
            setTimeout(() => {
                window.location.href = `mailto:adrian.stone@example.com?subject=Inquiry from ${name}&body=${msg}`;
            }, 1000);
        }
    });

    // Theme Punch (Color Remix)
    const themePunchBtn = document.getElementById('themePunchBtn');
    themePunchBtn.addEventListener('click', () => {
        const colors = ['#bcfe2f', '#00e5ff', '#ff2e97', '#ffc700', '#ffffff', '#a855f7'];
        const root = document.documentElement;
        root.style.setProperty('--accent', colors[Math.floor(Math.random() * colors.length)]);
        root.style.setProperty('--accent2', colors[Math.floor(Math.random() * colors.length)]);
        root.style.setProperty('--accent3', colors[Math.floor(Math.random() * colors.length)]);
        root.style.setProperty('--accent4', colors[Math.floor(Math.random() * colors.length)]);
        showToast("UI REMIXED!");
    });

    // CV Download Demo
    document.getElementById('downloadBtn').addEventListener('click', () => {
        showToast("DOWNLOADING RESUME...");
    });
  </script>
</body>
</html>