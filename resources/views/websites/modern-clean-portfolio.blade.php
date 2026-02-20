<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mark Rivera — Visual Architect</title>
  
  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- AOS --}}
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
          colors: {
            ink: '#09090b',
            accent: '#6366f1',
            surface: '#f4f4f5'
          }
        }
      }
    }
  </script>

  <style>
    :root {
      --accent: #6366f1;
      --glass: rgba(255, 255, 255, 0.7);
    }

    body {
      background-color: #ffffff;
      color: #09090b;
      selection-background: var(--accent);
      selection-color: #fff;
    }

    /* Noise Texture Overlay */
    .noise::before {
      content: "";
      position: fixed;
      top: 0; left: 0; width: 100vw; height: 100vh;
      background: url('https://grainy-gradients.vercel.app/noise.svg');
      opacity: 0.05;
      pointer-events: none;
      z-index: 999;
    }

    /* Mesh Gradients */
    .mesh-gradient {
      background: 
        radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
        radial-gradient(at 100% 0%, rgba(217, 70, 239, 0.1) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
        radial-gradient(at 0% 100%, rgba(217, 70, 239, 0.15) 0px, transparent 50%);
    }

    .glass-card {
      background: var(--glass);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(0, 0, 0, 0.05);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.03);
    }

    .bento-item {
      transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      border-radius: 2rem;
    }

    .bento-item:hover {
      transform: translateY(-5px);
      border-color: var(--accent);
      box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    }

    .outline-text {
      font-weight: 800;
      -webkit-text-stroke: 1px rgba(9, 9, 11, 0.1);
      color: transparent;
      line-height: 0.8;
      pointer-events: none;
    }

    .btn-primary {
      background: #09090b;
      color: #fff;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: var(--accent);
      box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
      transform: translateY(-2px);
    }

    .project-image {
      transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .bento-item:hover .project-image {
      transform: scale(1.05);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d4d4d8; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--accent); }
  </style>
</head>

<body class="noise mesh-gradient overflow-x-hidden">

  {{-- NAVIGATION --}}
  <nav class="fixed top-6 inset-x-0 z-[100] px-4">
    <div class="max-w-4xl mx-auto glass-card rounded-full px-6 py-3 flex items-center justify-between">
      <a href="#" class="font-extrabold tracking-tighter text-xl">MR<span class="text-accent">.</span></a>
      
      <div class="hidden md:flex items-center gap-8 text-sm font-medium">
        <a href="#work" class="hover:text-accent transition-colors">Projects</a>
        <a href="#about" class="hover:text-accent transition-colors">About</a>
        <a href="#contact" class="hover:text-accent transition-colors">Contact</a>
      </div>

      <a href="#contact" class="btn-primary px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest">
        Hire Me
      </a>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto px-6 pt-32 pb-20">
    
    {{-- HERO SECTION --}}
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-24">
      <div class="lg:col-span-8 glass-card bento-item p-10 md:p-16 flex flex-col justify-center" data-aos="fade-right">
        <span class="text-accent font-bold tracking-widest text-xs uppercase mb-4 block">Available for freelance</span>
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[0.9] mb-8">
          Crafting <span class="text-accent italic">Digital</span> Authority.
        </h1>
        <p class="text-lg text-neutral-500 max-w-lg font-medium leading-relaxed">
          I'm Mark, a Visual Architect specialized in building high-performance websites for forward-thinking brands.
        </p>
        
        <div class="mt-10 flex flex-wrap gap-4">
          <a href="#work" class="btn-primary px-8 py-4 rounded-full font-bold text-sm">View Projects</a>
          <div class="flex items-center gap-3 px-4">
            <div class="flex -space-x-3">
              <div class="w-10 h-10 rounded-full border-2 border-white bg-neutral-200"></div>
              <div class="w-10 h-10 rounded-full border-2 border-white bg-neutral-300"></div>
              <div class="w-10 h-10 rounded-full border-2 border-white bg-neutral-400"></div>
            </div>
            <span class="text-xs font-bold text-neutral-400">Trusted by 40+ Clients</span>
          </div>
        </div>
      </div>

      <div class="lg:col-span-4 glass-card bento-item overflow-hidden relative group" data-aos="fade-left">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=1200&q=80" 
             alt="Portrait" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        <div class="absolute bottom-8 left-8">
            <p class="text-white font-bold">Mark Rivera</p>
            <p class="text-white/60 text-xs">Based in London, UK</p>
        </div>
      </div>
    </section>

    {{-- STATS GRID --}}
    <section class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-24">
        @php
            $stats = [
                ['label' => 'Experience', 'val' => '08+', 'sub' => 'Years'],
                ['label' => 'Projects', 'val' => '120+', 'sub' => 'Completed'],
                ['label' => 'Satisfaction', 'val' => '99%', 'sub' => 'Rating'],
                ['label' => 'Awards', 'val' => '12', 'sub' => 'Won']
            ];
        @endphp
        @foreach($stats as $s)
            <div class="glass-card bento-item p-8 text-center" data-aos="zoom-in">
                <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-400 mb-2">{{ $s['label'] }}</p>
                <h3 class="text-4xl font-extrabold tracking-tighter">{{ $s['val'] }}</h3>
                <p class="text-xs font-medium text-neutral-500">{{ $s['sub'] }}</p>
            </div>
        @endforeach
    </section>

    {{-- WORK SECTION --}}
    <section id="work" class="relative mb-32">
        <div class="outline-text text-[100px] md:text-[200px] absolute -top-16 -left-4 z-0">WORK</div>
        
        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $works = [
                    ['title' => 'Quantum UI', 'cat' => 'Design System', 'img' => 'https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=1200'],
                    ['title' => 'Nebula Tech', 'cat' => 'SaaS Landing', 'img' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?q=80&w=1200'],
                    ['title' => 'Aether Docs', 'cat' => 'Documentation', 'img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=1200'],
                    ['title' => 'Nova Studio', 'cat' => 'Creative Agency', 'img' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1200']
                ];
            @endphp

            @foreach($works as $work)
                <div class="glass-card bento-item overflow-hidden group cursor-pointer" data-aos="fade-up">
                    <div class="h-[400px] overflow-hidden">
                        <img src="{{ $work['img'] }}" alt="Work" class="project-image w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                    </div>
                    <div class="p-8 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-accent uppercase tracking-widest mb-1">{{ $work['cat'] }}</p>
                            <h4 class="text-2xl font-bold tracking-tight">{{ $work['title'] }}</h4>
                        </div>
                        <div class="w-12 h-12 rounded-full border border-neutral-200 flex items-center justify-center group-hover:bg-accent group-hover:border-accent transition-all group-hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section id="contact" class="max-w-4xl mx-auto">
        <div class="glass-card bento-item p-10 md:p-20 text-center relative overflow-hidden" data-aos="fade-up">
            <div class="absolute top-0 left-0 w-32 h-32 bg-accent/10 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-fuchsia-500/10 blur-[100px] rounded-full"></div>
            
            <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">Let's create something <span class="italic text-accent">extraordinary</span>.</h2>
            <p class="text-neutral-500 mb-10 text-lg font-medium">Have a project in mind? I'm currently accepting new work for Q3 2024.</p>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                <a href="mailto:mark@rivera.com" class="btn-primary px-10 py-5 rounded-full font-bold flex items-center gap-3">
                    Start a Conversation
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-12 h-12 rounded-full glass-card flex items-center justify-center hover:text-accent transition-colors">TW</a>
                    <a href="#" class="w-12 h-12 rounded-full glass-card flex items-center justify-center hover:text-accent transition-colors">DR</a>
                    <a href="#" class="w-12 h-12 rounded-full glass-card flex items-center justify-center hover:text-accent transition-colors">LN</a>
                </div>
            </div>
        </div>
    </section>

  </main>

  <footer class="py-10 border-t border-neutral-100 text-center">
    <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest">
        &copy; 2024 Visual Architect &mdash; All Rights Reserved.
    </p>
  </footer>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: true,
      offset: 100,
      easing: 'ease-out-cubic'
    });

    // Subtle parallax effect for mesh gradient
    window.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        document.body.style.backgroundPosition = `${x * 20}px ${y * 20}px`;
    });
  </script>
</body>
</html>