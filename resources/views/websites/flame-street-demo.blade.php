{{-- resources/views/flamestreet.blade.php --}}
@php
    $page = request('page', 'home');

    // Dummy data produk (silakan ganti angka & link order sesuai real)
    $products = [
        [
            'id' => 'flame-dada',
            'name' => 'Flame Dada',
            'type' => 'Chicken',
            'kcal' => 320,
            'protein' => 48,
            'fat' => 7,
            'carbs' => 14,
            'highlight' => true,
            'img' => 'https://revaldyadhitya.com/storage/other/e0b3c374-8125-43ed-8c6d-3469543ae235.webp',
            'desc' => 'Charcoal grilled. Real protein. Anti basa-basi.',
            'order' => [
                'wa' => 'https://wa.me/6281234567890?text=Halo%20Flame%20Street,%20mau%20order%20Flame%20Dada',
                'gofood' => 'https://gofood.link/',
                'grabfood' => 'https://food.grab.com/',
            ],
        ],
        [
            'id' => 'beef-banger',
            'name' => 'Beef Banger',
            'type' => 'Beef',
            'kcal' => 410,
            'protein' => 44,
            'fat' => 16,
            'carbs' => 18,
            'highlight' => false,
            'img' => 'https://revaldyadhitya.com/storage/other/24b6810f-aa9d-476a-8a84-d5f7c31af501.webp',
            'desc' => 'Bold flavor, macro-friendly.',
            'order' => [
                'wa' => 'https://wa.me/6281234567890?text=Halo%20Flame%20Street,%20mau%20order%20Beef%20Banger',
                'gofood' => 'https://gofood.link/',
                'grabfood' => 'https://food.grab.com/',
            ],
        ],
        [
            'id' => 'dori-lean',
            'name' => 'Dori Lean',
            'type' => 'Fish',
            'kcal' => 290,
            'protein' => 38,
            'fat' => 6,
            'carbs' => 12,
            'highlight' => false,
            'img' => 'https://revaldyadhitya.com/storage/other/fa3b1e11-10c3-4a9e-9801-252e41fefc50.webp',
            'desc' => 'Clean taste, clean numbers.',
            'order' => [
                'wa' => 'https://wa.me/6281234567890?text=Halo%20Flame%20Street,%20mau%20order%20Dori%20Lean',
                'gofood' => 'https://gofood.link/',
                'grabfood' => 'https://food.grab.com/',
            ],
        ],
        [
            'id' => 'paha-smoke',
            'name' => 'Paha Smoke',
            'type' => 'Chicken',
            'kcal' => 360,
            'protein' => 42,
            'fat' => 11,
            'carbs' => 16,
            'highlight' => false,
            'img' => 'https://revaldyadhitya.com/storage/other/50e85704-32db-4000-b3b2-1a3c93448e43.webp',
            'desc' => 'Juicy, smoky, still gym-approved.',
            'order' => [
                'wa' => 'https://wa.me/6281234567890?text=Halo%20Flame%20Street,%20mau%20order%20Paha%20Smoke',
                'gofood' => 'https://gofood.link/',
                'grabfood' => 'https://food.grab.com/',
            ],
        ],
    ];

    $proteinTypes = ['All', 'Chicken', 'Beef', 'Fish'];

    $brandLogos = [
        [
            'name' => 'Iron Temple Gym',
            'img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'name' => 'Barbell Club',
            'img' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'name' => 'Corporate Fit',
            'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'name' => 'Athlete Lab',
            'img' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'name' => 'Strong Society',
            'img' => 'https://images.unsplash.com/photo-1526401485004-2fda9f6ae1a6?auto=format&fit=crop&w=600&q=80',
        ],
    ];
@endphp

<!doctype html>
<html lang="id" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flame Street — Real Protein, Anti Basa-Basi</title>

    {{-- Typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui']
                    },
                    colors: {
                        base: '#0D0D0D',
                        flame: '#009B22',
                    }
                }
            }
        }
    </script>

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- AOS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <style>
        /* Marquee */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 30s linear infinite;
        }

        /* Optional: Bikin gerakan lebih lambat di mobile */
        @media (max-width: 768px) {
            .animate-marquee {
                animation-duration: 20s;
            }
        }

        .noise {
            background-image:
                radial-gradient(rgba(255, 255, 255, .06) 1px, transparent 1px);
            background-size: 14px 14px;
            opacity: .22;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        @keyframes scroll-dash {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(200%);
            }
        }

        .animate-scroll-dash {
            animation: scroll-dash 2s ease-in-out infinite;
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 12s linear infinite;
        }

        /* Custom Styling untuk Swiper Pagination agar lebih Industrial */
        .swiper-pagination-bullet {
            width: 40px !important;
            height: 4px !important;
            border-radius: 2px !important;
            background: rgba(255, 255, 255, 0.1) !important;
            opacity: 1 !important;
            transition: all 0.3s ease !important;
        }

        .swiper-pagination-bullet-active {
            background: #009B22 !important;
            /* Warna flame */
            width: 60px !important;
        }
    </style>
</head>

<body class="bg-base text-white font-sans antialiased selection:bg-flame/30 selection:text-white">
    {{-- Topbar --}}
    <header class="sticky top-0 z-50 border-b border-white/10 bg-base/75 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ url()->current() }}?page=home" class="flex items-center gap-3 group">
                <div class="leading-tight">
                    <div class="font-black tracking-tight text-xl italic">Flame<span
                            class="text-green-500">Street</span></div>
                    <div class="text-xs text-white/60 -mt-0.5">Real Protein. Anti Basa-Basi.</div>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-2">
                @php
                    $nav = [
                        ['key' => 'home', 'label' => 'Home'],
                        ['key' => 'about', 'label' => 'About'],
                        ['key' => 'catalog', 'label' => 'Catalog'],
                        ['key' => 'flame-fit', 'label' => 'Flame Fit'],
                    ];
                @endphp
                @foreach ($nav as $n)
                    @php $active = $page === $n['key']; @endphp
                    <a href="{{ url()->current() }}?page={{ $n['key'] }}"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition
              {{ $active ? 'bg-white/10 border border-white/15' : 'text-white/75 hover:text-white hover:bg-white/5 border border-transparent' }}">
                        {{ $n['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ url()->current() }}?page=catalog"
                    class="px-4 py-2 hidden md:inline-block rounded-xl text-sm font-bold bg-flame text-black hover:brightness-110 transition shadow-[0_0_45px_rgba(0,155,34,0.25)]">
                    Order Now
                </a>

                <button id="mobileMenuBtn" class="md:hidden px-3 py-2 rounded-xl border border-white/15 bg-white/5">
                    <span class="text-sm font-semibold">Menu</span>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobileMenu" class="md:hidden hidden border-t border-white/10 pb-8">
            <div class="mx-auto max-w-6xl px-4 py-3 flex flex-col gap-2">
                <a class="px-4 py-3 rounded-xl bg-white/5 border border-white/10"
                    href="{{ url()->current() }}?page=home">Home</a>
                <a class="px-4 py-3 rounded-xl bg-white/5 border border-white/10"
                    href="{{ url()->current() }}?page=catalog">Catalog</a>
                <a class="px-4 py-3 rounded-xl bg-white/5 border border-white/10"
                    href="{{ url()->current() }}?page=about">About</a>
                <a class="px-4 py-3 rounded-xl bg-white/5 border border-white/10"
                    href="{{ url()->current() }}?page=flame-fit">Flame Fit</a>
            </div>
        </div>
    </header>

    <main class="">

        {{-- ===================== HOME ===================== --}}
        @if ($page === 'home')
            {{-- Full Screen Video Hero --}}
            <section class="relative h-screen min-h-[700px] w-full overflow-hidden -mt-6 md:-mt-8">
                {{-- Video Background --}}
                <div class="absolute inset-0 z-0">
                    <video autoplay muted loop playsinline class="h-full w-full object-cover">
                        <source src="https://flamestreet.id/img/video/videobackground.mp4" type="video/mp4">
                    </video>
                    {{-- Overlays: Gradient for readability + Noise for Industrial Texture --}}
                    <div class="absolute inset-0 bg-gradient-to-b from-base/60 via-base/20 to-base"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-base via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute inset-0 noise opacity-20"></div>
                </div>

                {{-- Content Container --}}
                <div class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center">
                    <div class="max-w-3xl">
                        {{-- Badge --}}
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-flame/40 bg-flame/10 backdrop-blur-md text-flame text-xs md:text-[10px] font-black tracking-[0.2em] uppercase mb-8"
                            data-aos="fade-right">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-flame opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-flame"></span>
                            </span>
                            High-Protein Status • Microwave Friendly
                        </div>

                        {{-- Main Heading --}}
                        <h1 class="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] text-white"
                            data-aos="fade-up" data-aos-delay="100">
                            REAL PROTEIN,<br />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-flame to-emerald-400">ANTI
                                BASA-BASI.</span>
                        </h1>

                        <p class="mt-8 text-lg md:text-xl text-white/80 max-w-xl leading-relaxed font-medium"
                            data-aos="fade-up" data-aos-delay="200">
                            Dada ayam bakar glistening, charcoal grilled, dan macro yang nggak bikin debat.
                            <span class="text-white font-bold underline decoration-flame/50">Panas 2 menit. Makan.
                                Repeat.</span>
                        </p>

                        {{-- Action Buttons --}}
                        <div class="mt-10 flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ url()->current() }}?page=catalog"
                                class="group relative px-8 py-4 rounded-2xl bg-flame text-black font-black text-lg transition-all hover:scale-105 active:scale-95 shadow-[0_0_50px_rgba(0,155,34,0.4)] flex items-center justify-center gap-3">
                                All Products
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="{{ url()->current() }}?page=about"
                                class="px-8 py-4 rounded-2xl border border-white/20 bg-white/5 backdrop-blur-md hover:bg-white/10 transition font-bold text-center text-lg">
                                The Story
                            </a>
                        </div>

                        {{-- Quick Stats --}}
                        <div class="mt-12 flex flex-wrap gap-8 border-t border-white/10 pt-8" data-aos="fade-up"
                            data-aos-delay="400">
                            <div>
                                <div class="text-white/50 text-xs font-bold tracking-widest uppercase">Avg Protein</div>
                                <div class="text-3xl font-black mt-1">40g+</div>
                            </div>
                            <div>
                                <div class="text-white/50 text-xs font-bold tracking-widest uppercase">Prep Time</div>
                                <div class="text-3xl font-black mt-1">2 MIN</div>
                            </div>
                            <div class="hidden md:block">
                                <div class="text-white/50 text-xs font-bold tracking-widest uppercase">Method</div>
                                <div class="text-3xl font-black mt-1 uppercase text-flame">Charcoal</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 hidden md:block" data-aos="fade-up"
                    data-aos-delay="600">
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-[10px] font-black tracking-[0.3em] uppercase text-white/30">Scroll</span>
                        <div
                            class="w-[2px] h-12 bg-gradient-to-b from-flame to-transparent rounded-full overflow-hidden">
                            <div class="w-full h-1/2 bg-white animate-scroll-dash"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Modern Industrial Marquee --}}
            <section class="mt-16 relative" data-aos="fade-up">
                {{-- Header dengan aksen garis --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px flex-grow bg-gradient-to-r from-transparent via-white/10 to-white/20"></div>
                    <h2 class="text-[10px] md:text-xs font-black tracking-[0.4em] uppercase text-white/40">
                        Official <span class="text-flame">Gym Partners</span> Network
                    </h2>
                    <div class="h-px flex-grow bg-gradient-to-l from-transparent via-white/10 to-white/20"></div>
                </div>

                <div class="relative group">
                    {{-- Masking Gradient (Bikin logo ilang-timbul di pinggir halus) --}}
                    <div
                        class="absolute inset-y-0 left-0 w-20 md:w-40 bg-gradient-to-r from-base to-transparent z-10 pointer-events-none">
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 w-20 md:w-40 bg-gradient-to-l from-base to-transparent z-10 pointer-events-none">
                    </div>

                    {{-- Container Marquee --}}
                    <div class="overflow-hidden py-4">
                        @php
                            // Triple list agar durasi animasi pas dan tidak ada gap kosong
                            $logosLoop = array_merge($brandLogos, $brandLogos, $brandLogos);
                        @endphp

                        <div
                            class="flex animate-marquee group-hover:[animation-play-state:paused] whitespace-nowrap gap-6">
                            @foreach ($logosLoop as $l)
                                <div
                                    class="inline-flex items-center gap-4 px-6 py-4 rounded-2xl border border-white/5 bg-white/[0.02] hover:bg-white/[0.08] hover:border-flame/30 hover:scale-105 transition-all duration-300">
                                    {{-- Logo dengan Grayscale effect yang hilang saat hover --}}
                                    <img src="{{ $l['img'] }}" alt="{{ $l['name'] }}"
                                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl object-cover grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 border border-white/10">

                                    <div>
                                        <div
                                            class="text-sm font-black text-white/80 group-hover:text-white tracking-tight">
                                            {{ $l['name'] }}
                                        </div>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-flame animate-pulse"></span>
                                            <span
                                                class="text-[9px] text-white/40 font-bold uppercase tracking-widest">Verified
                                                Hub</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Bottom Decoration Line --}}
                <div class="mt-4 flex justify-center">
                    <div class="h-[2px] w-24 bg-flame/20 rounded-full"></div>
                </div>
            </section>

            {{-- Modern Bento Features: Industrial Spec Style --}}
            <section class="mt-20 px-4 md:px-28">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8" data-aos="fade-up">
                    <div>
                        <div class="flex items-center gap-2 text-flame mb-2">
                            <span class="w-8 h-[2px] bg-flame"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em]">The Blueprint</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black tracking-tighter uppercase italic leading-none">
                            3 Pilar <span class="text-white/20">Flame Street</span>
                        </h2>
                    </div>
                    <div
                        class="text-white/40 text-[10px] font-bold uppercase tracking-widest border-l border-white/10 pl-4 hidden md:block">
                        High Performance <br /> Meal Prep System
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-6 gap-5">
                    {{-- Card 1: Real Protein with Background Image --}}
                    <div class="md:col-span-3 group relative rounded-[2.5rem] border border-white/10 bg-base overflow-hidden p-8 transition-all duration-500 hover:border-flame/40"
                        data-aos="fade-up" data-aos-delay="50">

                        {{-- Image Background Layer --}}
                        <div class="absolute inset-0 z-0">
                            <img src="https://revaldyadhitya.com/storage/other/67c9f791-9d69-4f55-80c7-c5345b271007.webp"
                                alt="Real Protein grilled chicken"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80">
                            {{-- High Contrast Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-base via-base/80 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-base to-transparent opacity-60"></div>
                        </div>

                        {{-- Decorative Number --}}
                        <div
                            class="absolute top-0 right-0 p-6 opacity-20 group-hover:opacity-40 transition-opacity z-10">
                            <span class="text-6xl font-black italic text-white/10 select-none">01</span>
                        </div>

                        {{-- Content Layer --}}
                        <div class="relative z-20">
                            <div
                                class="w-12 h-12 rounded-2xl bg-flame/20 backdrop-blur-md border border-flame/30 flex items-center justify-center mb-6 shadow-[0_0_20px_rgba(0,155,34,0.3)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-flame" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>

                            <div
                                class="text-flame font-black tracking-[0.2em] text-[10px] uppercase mb-2 bg-flame/10 w-fit px-2 py-0.5 rounded border border-flame/20">
                                Maximum Fuel
                            </div>

                            <div
                                class="text-3xl font-black text-white leading-tight uppercase tracking-tighter drop-shadow-lg">
                                Real Protein,<br /> No Gimmick.
                            </div>

                            <p class="mt-4 text-white/80 leading-relaxed max-w-sm font-medium drop-shadow-md">
                                Fokus ke kualitas bahan dan teknik grill. Yang kamu bayar: rasa + macro yang masuk akal.
                            </p>

                            <div class="mt-8 flex flex-wrap gap-2">
                                <span
                                    class="px-3 py-1 rounded-full bg-base/60 backdrop-blur-md border border-white/10 text-[10px] font-black text-white uppercase tracking-widest hover:border-flame/40 transition-colors">
                                    High-protein
                                </span>
                                <span
                                    class="px-3 py-1 rounded-full bg-base/60 backdrop-blur-md border border-white/10 text-[10px] font-black text-white uppercase tracking-widest hover:border-flame/40 transition-colors">
                                    Charcoal
                                </span>
                                <span
                                    class="px-3 py-1 rounded-full bg-base/60 backdrop-blur-md border border-white/10 text-[10px] font-black text-white uppercase tracking-widest hover:border-flame/40 transition-colors">
                                    No drama
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Microwave Friendly with Background Image --}}
                    <div class="md:col-span-3 group relative rounded-[2.5rem] border border-white/10 bg-base p-8 overflow-hidden transition-all duration-500 hover:border-flame/40"
                        data-aos="fade-up" data-aos-delay="100">

                        {{-- Image Background Layer --}}
                        <div class="absolute inset-0 z-0">
                            <img src="https://revaldyadhitya.com/storage/other/38b1058c-7715-4aaf-91ed-3bb57e8d8eff.webp"
                                alt="Microwave friendly meal pack"
                                class="h-full w-full object-cover transition-transform duration-1000 group-hover:scale-110 opacity-50 grayscale group-hover:grayscale-0">
                            {{-- High Contrast Overlays --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-base via-base/90 to-transparent"></div>
                            <div
                                class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(0,155,34,0.3),transparent_70%)] opacity-40 group-hover:opacity-60 transition-opacity">
                            </div>
                        </div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start">
                                <div
                                    class="text-flame font-black tracking-[0.2em] text-[10px] uppercase mb-2 bg-flame/10 px-2 py-0.5 rounded border border-flame/20">
                                    Efficiency Mode
                                </div>
                                <div
                                    class="flex gap-1.5 bg-base/60 backdrop-blur-md p-1.5 rounded-full border border-white/10">
                                    <div class="w-2 h-2 rounded-full bg-flame animate-pulse"></div>
                                    <div class="w-2 h-2 rounded-full bg-white/10"></div>
                                    <div class="w-2 h-2 rounded-full bg-white/10"></div>
                                </div>
                            </div>

                            <div class="text-3xl font-black text-white leading-tight uppercase tracking-tighter mt-4">
                                Microwave<br /> Friendly.
                            </div>
                            <p class="mt-4 text-white/80 leading-relaxed font-medium drop-shadow-md max-w-[240px]">
                                Sistem makan anti-ribet untuk kamu yang punya jadwal padat.
                            </p>

                            <div class="mt-8 grid grid-cols-3 gap-3">
                                <div
                                    class="relative group/step p-4 rounded-2xl border border-white/10 bg-base/60 backdrop-blur-md hover:bg-white/10 transition-all">
                                    <div class="text-[9px] font-black text-white/40 mb-1 uppercase tracking-tighter">
                                        Heat</div>
                                    <div
                                        class="text-2xl font-black text-white group-hover/step:text-flame transition-colors tracking-tighter">
                                        01</div>
                                </div>
                                <div
                                    class="relative group/step p-4 rounded-2xl border border-white/10 bg-base/60 backdrop-blur-md hover:bg-white/10 transition-all">
                                    <div class="text-[9px] font-black text-white/40 mb-1 uppercase tracking-tighter">
                                        Eat</div>
                                    <div
                                        class="text-2xl font-black text-white group-hover/step:text-flame transition-colors tracking-tighter">
                                        02</div>
                                </div>
                                <div
                                    class="relative group/step p-4 rounded-2xl border border-white/10 bg-base/60 backdrop-blur-md hover:bg-white/10 transition-all">
                                    <div class="text-[9px] font-black text-white/40 mb-1 uppercase tracking-tighter">
                                        Grow</div>
                                    <div
                                        class="text-2xl font-black text-white group-hover/step:text-flame transition-colors tracking-tighter">
                                        03</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card 3: Quality --}}
                    <div class="md:col-span-4 group relative rounded-[2.5rem] border border-white/10 bg-white/5 p-8 overflow-hidden transition-all duration-500 hover:border-flame/40"
                        data-aos="fade-up" data-aos-delay="150">
                        <div class="absolute -right-10 -bottom-10 opacity-5 group-hover:opacity-10 transition-opacity">
                            <svg width="240" height="240" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="max-w-md">
                                <div class="text-flame font-black tracking-[0.2em] text-xs uppercase mb-2">Quality
                                    Control</div>
                                <div class="text-3xl font-black text-white uppercase tracking-tighter">Taste
                                    Industrial,<br />Build Clean.</div>
                                <p class="mt-4 text-white/60 leading-relaxed font-medium">
                                    Konsistensi adalah kunci. Porsi stabil, seasoning presisi, dan macro transparan di
                                    setiap porsi.
                                </p>
                            </div>
                            <div class="shrink-0">
                                <div
                                    class="w-32 h-32 rounded-full border-4 border-dashed border-white/5 flex items-center justify-center relative">
                                    <div class="absolute inset-0 animate-spin-slow opacity-20">
                                        <svg viewBox="0 0 100 100" class="w-full h-full">
                                            <circle cx="50" cy="50" r="45" fill="none"
                                                stroke="white" stroke-width="2" stroke-dasharray="10 5" />
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-black text-white">100%</div>
                                        <div class="text-[8px] font-bold text-white/40 uppercase tracking-widest">
                                            Stable</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card 4: Signature CTA --}}
                    <div class="md:col-span-2 group relative rounded-[2.5rem] border border-flame/20 bg-flame/5 p-8 overflow-hidden transition-all duration-500 hover:bg-flame/10"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="relative z-10 flex flex-col h-full">
                            <div class="text-white/60 text-[10px] font-black uppercase tracking-widest mb-2">The
                                Science</div>
                            <div class="text-2xl font-black text-white uppercase tracking-tight leading-none">
                                Golden<br /> Window.</div>
                            <p class="mt-4 text-white/60 text-xs leading-relaxed font-medium">
                                Jangan buang hasil workout karena telat makan. Pahami pentingnya nutrisi pasca-latihan.
                            </p>
                            <div class="mt-auto pt-8">
                                <a href="{{ url()->current() }}?page=about#golden-window"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-flame text-black font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all w-full group/btn">
                                    Baca Science
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Modern Performance Swiper --}}
            <section class="mt-20 px-4 md:px-28">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10" data-aos="fade-up">
                    <div>
                        <div class="flex items-center gap-2 text-flame mb-2">
                            <span class="w-2 h-2 rounded-full bg-flame animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Elite Selection</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black tracking-tighter uppercase italic leading-none">
                            Product <span class="text-white/20">Banger</span>
                        </h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ url()->current() }}?page=catalog"
                            class="group flex items-center gap-3 text-xs font-black uppercase tracking-widest text-white/50 hover:text-white transition-all">
                            View Full Menu
                            <span
                                class="w-10 h-[1px] bg-white/20 group-hover:w-14 group-hover:bg-flame transition-all"></span>
                        </a>
                    </div>
                </div>

                <div class="relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper product-slider overflow-hidden">
                        <div class="swiper-wrapper">
                            @foreach ($products as $p)
                                <div class="swiper-slide h-auto">
                                    <article
                                        class="group relative flex flex-col h-full bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:border-flame/40">

                                        {{-- Product Image & Kcal Label --}}
                                        <div class="relative h-[400px] overflow-hidden">
                                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}"
                                                class="absolute inset-0 h-full w-full object-cover scale-[1.05] group-hover:scale-110 transition duration-700">

                                            {{-- Gradient Shadow --}}
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-base via-base/40 to-transparent">
                                            </div>

                                            {{-- Floating Spec Label --}}
                                            <div class="absolute top-6 left-6">
                                                <div
                                                    class="bg-black/80 backdrop-blur-md border border-white/10 px-4 py-2 rounded-2xl">
                                                    <div
                                                        class="text-[8px] font-black text-white/40 uppercase tracking-[0.2em] mb-0.5">
                                                        Energy Output</div>
                                                    <div class="text-2xl font-black text-white leading-none">
                                                        {{ $p['kcal'] }} <span
                                                            class="text-xs text-flame">KCAL</span></div>
                                                </div>
                                            </div>

                                            {{-- Category Tag --}}
                                            <div class="absolute top-6 right-6">
                                                <span
                                                    class="px-3 py-1 rounded-full border border-flame/30 bg-flame/10 backdrop-blur-md text-flame text-[9px] font-black uppercase tracking-widest">
                                                    {{ $p['type'] }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Product Info --}}
                                        <div class="relative -mt-20 px-8 pb-8 flex-grow">
                                            <div
                                                class="bg-white/5 backdrop-blur-2xl border border-white/10 p-6 rounded-[2rem] shadow-2xl">
                                                <h3
                                                    class="text-2xl font-black text-white tracking-tight mb-2 group-hover:text-flame transition-colors">
                                                    {{ $p['name'] }}
                                                </h3>
                                                <p
                                                    class="text-white/50 text-sm leading-relaxed line-clamp-2 mb-6 font-medium">
                                                    {{ $p['desc'] }}
                                                </p>

                                                {{-- Macro Grid (Dashboard Style) --}}
                                                <div class="grid grid-cols-3 gap-3 mb-8">
                                                    <div
                                                        class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                                                        <div
                                                            class="text-[8px] font-black text-white/30 uppercase mb-1">
                                                            Protein</div>
                                                        <div class="text-sm font-black text-white">
                                                            {{ $p['protein'] }}g</div>
                                                    </div>
                                                    <div
                                                        class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                                                        <div
                                                            class="text-[8px] font-black text-white/30 uppercase mb-1">
                                                            Carbs</div>
                                                        <div class="text-sm font-black text-white">
                                                            {{ $p['carbs'] }}g</div>
                                                    </div>
                                                    <div
                                                        class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                                                        <div
                                                            class="text-[8px] font-black text-white/30 uppercase mb-1">
                                                            Fat</div>
                                                        <div class="text-sm font-black text-white">
                                                            {{ $p['fat'] }}g</div>
                                                    </div>
                                                </div>

                                                {{-- Actions --}}
                                                <div class="flex flex-col gap-3">
                                                    <a href="{{ $p['order']['wa'] }}" target="_blank"
                                                        class="w-full flex items-center justify-center gap-3 py-4 rounded-xl bg-flame text-black font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-[0_10px_30px_rgba(0,155,34,0.2)]">
                                                        Deploy Order (WA)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    </a>

                                                    <div class="grid grid-cols-2 gap-3">
                                                        <a href="{{ $p['order']['gofood'] }}" target="_blank"
                                                            class="flex items-center justify-center py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all grayscale opacity-60 hover:grayscale-0 hover:opacity-100">
                                                            <img src="https://avatars.githubusercontent.com/u/29785210?s=280&v=4"
                                                                class="h-4 brightness-0 invert" alt="GoFood">
                                                        </a>
                                                        <a href="{{ $p['order']['grabfood'] }}" target="_blank"
                                                            class="flex items-center justify-center py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all grayscale opacity-60 hover:grayscale-0 hover:opacity-100">
                                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Grab_Logo.svg/1280px-Grab_Logo.svg.png"
                                                                class="h-3 brightness-0 invert" alt="GrabFood">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Featured Glow --}}
                                        @if ($p['highlight'])
                                            <div
                                                class="absolute inset-0 pointer-events-none border-2 border-flame/20 rounded-[2.5rem]">
                                            </div>
                                            <div
                                                class="absolute top-0 right-0 w-32 h-32 bg-flame/10 blur-[80px] pointer-events-none">
                                            </div>
                                        @endif
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        {{-- Custom Modern Pagination --}}
                        <div class="flex items-center justify-center gap-8 mt-12">
                            <div class="swiper-pagination !static !w-auto"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Modern Founder/About Section --}}
            <section class="mt-20 mb-20 px-4 md:px-28 relative overflow-hidden">
                {{-- Background Decoration --}}
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-flame/5 blur-[120px] rounded-full pointer-events-none">
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    {{-- Image Side --}}
                    <div class="lg:col-span-5" data-aos="fade-right">
                        <div class="relative group">
                            {{-- Decorative Frame --}}
                            <div class="absolute -inset-4 border border-white/5 rounded-[3rem] pointer-events-none">
                            </div>
                            <div class="absolute -inset-2 border border-white/10 rounded-[2.8rem] pointer-events-none">
                            </div>

                            {{-- Main Image Container --}}
                            <div
                                class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] border border-white/20 bg-base/80">
                                <img src="https://revaldyadhitya.com/storage/other/41e1b6e8-79b0-4742-8393-121452c4a252.webp"
                                    alt="Founder of Flame Street"
                                    class="w-full h-full object-cover transition-all duration-700" />

                                {{-- ID Badge Overlay --}}
                                <div
                                    class="absolute bottom-6 left-6 right-6 p-5 bg-base/60 backdrop-blur-xl border border-white/10 rounded-2xl">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div
                                                class="text-[10px] font-black text-flame uppercase tracking-[0.2em] mb-1">
                                                Founder / Architect</div>
                                            <div class="text-xl font-black text-white uppercase tracking-tight">The
                                                Gain-Maker</div>
                                        </div>
                                        <div
                                            class="h-10 w-10 border border-white/20 rounded-full flex items-center justify-center">
                                            <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Technical Annotation --}}
                            <div class="absolute -right-8 top-12 hidden xl:block">
                                <div class="flex items-center gap-3 rotate-90 origin-left">
                                    <span class="h-px w-12 bg-white/20"></span>
                                    <span
                                        class="text-[10px] font-bold text-white/30 uppercase tracking-[0.4em] whitespace-nowrap">Subject:
                                        Nutrition Optimization</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Content Side --}}
                    <div class="lg:col-span-7" data-aos="fade-left">
                        <div class="max-w-xl">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-white/5 border border-white/10 text-white/40 text-[10px] font-bold uppercase tracking-widest mb-6">
                                Origin Story
                            </div>

                            <h2
                                class="text-4xl md:text-6xl font-black tracking-tighter uppercase italic leading-[0.9] mb-8">
                                Built by a <span class="text-flame">Gym Rat,</span><br />
                                For the <span class="text-white/20">Culture.</span>
                            </h2>

                            <div class="space-y-6 text-white/70 text-lg leading-relaxed font-medium">
                                <p>
                                    Gue capek liat opsi makanan sehat yang rasanya kayak kertas atau ribetnya minta
                                    ampun buat disiapin pas lagi sibuk-sibuknya ngejar porsi latihan.
                                </p>
                                <p>
                                    <span class="text-white">Flame Street</span> lahir dari satu masalah simpel: Gimana
                                    cara dapet protein berkualitas, rasa grill beneran, tapi bisa dimakan dalam hitungan
                                    menit tanpa debat macro?
                                </p>
                                <p class="text-sm border-l-2 border-flame pl-6 italic bg-flame/5 py-4 rounded-r-2xl">
                                    "Kita nggak jualan janji diet. Kita jualan infrastruktur nutrisi buat kamu yang
                                    serius sama progres."
                                </p>
                            </div>

                            {{-- Founder Stats --}}
                            <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-6 pt-10 border-t border-white/10">
                                <div>
                                    <div class="text-[10px] font-black text-white/30 uppercase tracking-widest">Vision
                                    </div>
                                    <div class="text-xl font-black text-white mt-1 uppercase">No Gimmick</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-black text-white/30 uppercase tracking-widest">Core
                                        Priority</div>
                                    <div class="text-xl font-black text-white mt-1 uppercase">Macros First</div>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <div class="text-[10px] font-black text-white/30 uppercase tracking-widest">
                                        Standard</div>
                                    <div class="text-xl font-black text-flame mt-1 uppercase italic tracking-tighter">
                                        Flame Level</div>
                                </div>
                            </div>

                            <div class="mt-12">
                                <a href="{{ url()->current() }}?page=about"
                                    class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-white group">
                                    Read The Full Story
                                    <div
                                        class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-flame group-hover:border-flame group-hover:text-black transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            {{-- Modern Industrial Testimonials: Athlete Field Reports --}}
            <section class="mt-20 mb-24 px-4 md:px-28">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10" data-aos="fade-up">
                    <div>
                        <div class="flex items-center gap-2 text-flame mb-2">
                            <div class="flex gap-1">
                                <div class="w-1 h-3 bg-flame"></div>
                                <div class="w-1 h-3 bg-flame/40"></div>
                                <div class="w-1 h-3 bg-flame/10"></div>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Field Reports</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black tracking-tighter uppercase italic leading-none">
                            Gym Rats <span class="text-white/20">Said.</span>
                        </h2>
                    </div>
                    <div class="hidden md:block">
                        <div
                            class="px-4 py-2 rounded-full border border-white/10 bg-white/5 text-[10px] font-bold text-white/40 uppercase tracking-widest">
                            Real Feedback • No Sugar Coating
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $testi = [
                            [
                                'name' => 'Raka "PR Hunter"',
                                'role' => 'Powerlifter',
                                'tag' => 'Mass Gain',
                                'text' =>
                                    'Microwave 2 menit, langsung kejar protein. Rasanya bukan makanan sedih yang hambar. Ini bahan bakar beneran.',
                            ],
                            [
                                'name' => 'Mika "Cut Season"',
                                'role' => 'Fitness Model',
                                'tag' => 'Shredding',
                                'text' =>
                                    'Kcal-nya jelas dan dominan. Anak gym butuh angka pasti, bukan puisi. Flame Street kasih apa yang gue butuh.',
                            ],
                            [
                                'name' => 'Dion "Leg Day Survivor"',
                                'role' => 'Bodybuilder',
                                'tag' => 'Recovery',
                                'text' =>
                                    'Charcoal grilled-nya kerasa banget. Clean tapi tetap nendang. Pas buat recovery setelah sesi kaki yang brutal.',
                            ],
                        ];
                    @endphp

                    @foreach ($testi as $i => $t)
                        <div class="group relative p-8 rounded-[2.5rem] bg-white/5 border border-white/10 overflow-hidden transition-all duration-500 hover:border-flame/40 hover:bg-white/[0.07]"
                            data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">

                            {{-- Decorative Quote Mark --}}
                            <div
                                class="absolute -top-4 -left-2 text-9xl font-black text-white/[0.03] select-none group-hover:text-flame/[0.05] transition-colors">
                                “
                            </div>

                            <div class="relative z-10 flex flex-col h-full">
                                {{-- Rating/Intensity Stars --}}
                                <div class="flex gap-1 mb-6">
                                    @for ($j = 0; $j < 5; $j++)
                                        <svg class="w-4 h-4 text-flame" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                {{-- Testimonial Text --}}
                                <blockquote
                                    class="text-xl font-medium text-white/80 leading-relaxed italic mb-8 group-hover:text-white transition-colors">
                                    “{{ $t['text'] }}”
                                </blockquote>

                                {{-- User Info --}}
                                <div class="mt-auto flex items-center gap-4 pt-6 border-t border-white/5">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-flame to-emerald-900 flex items-center justify-center text-black font-black text-xl border-2 border-white/10">
                                        {{ substr($t['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-white tracking-tight uppercase">
                                            {{ $t['name'] }}</div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-[10px] font-bold text-white/40 uppercase tracking-widest">{{ $t['role'] }}</span>
                                            <span class="w-1 h-1 rounded-full bg-flame"></span>
                                            <span
                                                class="text-[10px] font-black text-flame uppercase tracking-tighter">{{ $t['tag'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Featured Glow Effect --}}
                            <div
                                class="absolute -bottom-10 -right-10 w-32 h-32 bg-flame/5 blur-3xl rounded-full group-hover:bg-flame/10 transition-colors">
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Call to action footer --}}
                <div class="mt-12 text-center" data-aos="fade-up">
                    <p class="text-white/30 text-xs font-bold uppercase tracking-[0.2em]">
                        Join <span class="text-white/60">500+</span> Gym Rats who fueled their gains with us.
                    </p>
                </div>
            </section>
        @endif

        {{-- ===================== CATALOG ===================== --}}
        @if ($page === 'catalog')
            <section class="mt-8 mb-20 px-4 md:px-28">
                {{-- Header Section: Industrial Dashboard Style --}}
                <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-8 md:p-12"
                    data-aos="fade-up">
                    <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
                        <svg width="200" height="200" viewBox="0 0 100 100" fill="none" class="rotate-12">
                            <circle cx="50" cy="50" r="48" stroke="white" stroke-width="0.5"
                                stroke-dasharray="4 4" />
                            <path d="M50 2v96M2 50h98" stroke="white" stroke-width="0.2" />
                        </svg>
                    </div>

                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
                        <div class="max-w-xl">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-flame/20 border border-flame/30 text-flame text-[10px] font-black tracking-[0.2em] uppercase">
                                Fuel Inventory
                            </div>
                            <h1 class="text-4xl md:text-6xl font-black tracking-tighter mt-4 leading-none">
                                FUEL YOUR <br /><span class="text-white/40">AMBITION.</span>
                            </h1>
                            <p class="text-white/60 mt-6 text-lg leading-relaxed font-medium">
                                Pilih asupan berdasarkan target macro. Filter presisi untuk <span
                                    class="text-white">cutting, bulking,</span> atau <span
                                    class="text-white">maintaining.</span>
                            </p>
                        </div>

                        {{-- Kcal Control Panel --}}
                        <div
                            class="bg-base/60 backdrop-blur-xl border border-white/10 p-6 rounded-3xl w-full lg:w-96 shadow-2xl">
                            <div class="flex justify-between items-end mb-6">
                                <div>
                                    <span class="text-[10px] font-black text-white/40 uppercase tracking-widest">Target
                                        Limit</span>
                                    <div class="text-4xl font-black text-flame flex items-baseline gap-1">
                                        <span id="kcalLabel">500</span>
                                        <span class="text-sm text-white/40 font-bold uppercase">Kcal</span>
                                    </div>
                                </div>
                                <div
                                    class="h-10 w-10 rounded-full border border-white/10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/40"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>

                            <input id="kcalRange" type="range" min="200" max="700" value="500"
                                class="w-full h-1.5 bg-white/10 rounded-lg appearance-none cursor-pointer accent-flame">

                            <div
                                class="flex justify-between mt-4 text-[10px] font-black text-white/40 uppercase tracking-tighter">
                                <span>200 Kcal</span>
                                <span>700 Kcal</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Filter Bar: Modern Tabs --}}
                <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="flex flex-wrap items-center gap-2 bg-white/5 p-1.5 rounded-2xl border border-white/10">
                        <button
                            class="filterType px-6 py-2.5 rounded-xl text-sm font-black transition-all bg-flame text-black active-filter"
                            data-type="All">
                            ALL
                        </button>
                        @foreach ($proteinTypes as $t)
                            <button
                                class="filterType px-6 py-2.5 rounded-xl text-sm font-bold text-white/60 hover:text-white hover:bg-white/5 transition-all"
                                data-type="{{ $t }}">
                                {{ strtoupper($t) }}
                            </button>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-xs font-bold text-white/40 uppercase tracking-widest">
                            Results: <span id="countLabel"
                                class="text-white font-black">{{ count($products) }}</span>
                        </span>
                        <button id="resetFilters"
                            class="p-2.5 rounded-xl border border-white/10 bg-white/5 hover:bg-red-500/20 hover:border-red-500/50 group transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-white/60 group-hover:text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                    @foreach ($products as $p)
                        <article
                            class="productCard group relative flex flex-col bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:border-flame/40 hover:-translate-y-2"
                            data-type="{{ $p['type'] }}" data-kcal="{{ $p['kcal'] }}" data-aos="fade-up">

                            {{-- Image Wrapper --}}
                            <div class="relative h-72 overflow-hidden">
                                <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110">

                                {{-- Glossy Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-base via-base/20 to-transparent">
                                </div>

                                {{-- Floating Kcal Tag --}}
                                <div class="absolute top-6 right-6">
                                    <div
                                        class="bg-black/60 backdrop-blur-md border border-white/20 px-4 py-2 rounded-2xl">
                                        <span
                                            class="block text-[10px] font-black text-flame tracking-widest uppercase leading-none">Energy</span>
                                        <span
                                            class="text-xl font-black text-white leading-none">{{ $p['kcal'] }}</span>
                                    </div>
                                </div>

                                {{-- Macro Quick View (Always visible on mobile, hover on desktop) --}}
                                <div
                                    class="absolute inset-x-6 bottom-6 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                                    <div
                                        class="grid grid-cols-3 gap-2 p-3 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20">
                                        <div class="text-center">
                                            <div class="text-[8px] font-black text-white/50 uppercase">Protein</div>
                                            <div class="text-sm font-black text-white">{{ $p['protein'] }}g</div>
                                        </div>
                                        <div class="text-center border-x border-white/10">
                                            <div class="text-[8px] font-black text-white/50 uppercase">Carbs</div>
                                            <div class="text-sm font-black text-white">{{ $p['carbs'] }}g</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-[8px] font-black text-white/50 uppercase">Fat</div>
                                            <div class="text-sm font-black text-white">{{ $p['fat'] }}g</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8 pt-6 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="text-[10px] font-black text-flame tracking-widest uppercase">{{ $p['type'] }}</span>
                                        <div class="h-px flex-grow bg-white/10"></div>
                                    </div>
                                    <h3
                                        class="text-2xl font-black text-white tracking-tight group-hover:text-flame transition-colors">
                                        {{ $p['name'] }}
                                    </h3>
                                    <p class="text-white/50 mt-3 text-sm leading-relaxed line-clamp-2 font-medium">
                                        {{ $p['desc'] }}
                                    </p>
                                </div>

                                {{-- Order Buttons --}}
                                <div class="mt-8 grid grid-cols-2 gap-3">
                                    <div class="grid grid-cols-2 gap-2">
                                        <a href="{{ $p['order']['gofood'] }}" target="_blank"
                                            class="flex items-center justify-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all"
                                            title="GoFood">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Gojek_logo_2019.svg"
                                                class="h-4 brightness-0 invert opacity-60" alt="GoFood">
                                        </a>
                                        <a href="{{ $p['order']['grabfood'] }}" target="_blank"
                                            class="flex items-center justify-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all"
                                            title="GrabFood">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Grab_Logo.svg"
                                                class="h-3 brightness-0 invert opacity-60" alt="GrabFood">
                                        </a>
                                    </div>
                                    <a href="{{ $p['order']['wa'] }}" target="_blank"
                                        class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-flame text-black font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-[0_10px_30px_rgba(0,155,34,0.2)]">
                                        Order WA
                                    </a>
                                </div>
                            </div>

                            {{-- Featured Glow --}}
                            @if ($p['highlight'])
                                <div
                                    class="absolute inset-0 pointer-events-none border-2 border-flame/20 rounded-[2.5rem]">
                                </div>
                                <div class="absolute -top-12 -right-12 w-24 h-24 bg-flame/10 blur-3xl"></div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ===================== ABOUT ===================== --}}
        @if ($page === 'about')
            <section class="mt-12 mb-24 px-4 md:px-28">
                {{-- Header Section: The Manifesto --}}
                <div class="relative mb-20" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-flame font-black tracking-[0.4em] uppercase text-[10px]">Subject: Origin
                            Story</span>
                        <div class="h-px flex-grow bg-white/10"></div>
                    </div>
                    <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-[0.85] uppercase italic">
                        Lahir di <span class="text-white/20 text-not-italic">Gym,</span><br />
                        Besar di <span class="text-flame">Dapur.</span>
                    </h1>
                    <p class="text-white/50 mt-8 max-w-2xl text-lg md:text-xl leading-relaxed font-medium">
                        Flame Street bukan sekadar katering. Kami adalah <span class="text-white">Infrastruktur
                            Nutrisi</span> bagi mereka yang menganggap tubuh mereka sebagai aset paling berharga.
                    </p>
                </div>

                {{-- The Founder Dossier --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-20">
                    <div class="lg:col-span-7 group relative rounded-[2.5rem] border border-white/10 bg-white/5 p-8 md:p-12 overflow-hidden transition-all duration-500 hover:border-flame/40"
                        data-aos="fade-right">
                        <div class="absolute top-0 right-0 p-8 opacity-5">
                            <svg width="200" height="200" viewBox="0 0 100 100" fill="none" stroke="white">
                                <path d="M10 10h80v80h-80zM10 50h80M50 10v80" stroke-width="0.5" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-flame/10 border border-flame/20 text-flame text-[10px] font-black tracking-widest uppercase mb-8">
                                The Architect
                            </div>
                            <h2
                                class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase italic mb-6">
                                Evan Grimaldi</h2>

                            <div class="space-y-6 text-white/60 text-lg leading-relaxed">
                                <p>
                                    Flame Street lahir dari rasa frustrasi Evan Grimaldi saat menjalani masa <span
                                        class="text-white italic">cut season</span> yang brutal.
                                    Sulit mencari makanan yang praktis tapi tetap memiliki profil macro yang jujur.
                                </p>
                                <p>
                                    Filosofinya sederhana: <span
                                        class="text-white font-bold text-lg underline decoration-flame/40">"Jangan
                                        biarkan nutrisi buruk membunuh hasil latihanmu."</span> Kami membuang semua
                                    basa-basi pemasaran dan fokus pada apa yang benar-benar dibutuhkan ototmu.
                                </p>
                            </div>

                            <div class="mt-10 flex flex-wrap gap-3">
                                @foreach (['Macro-Obsessed', 'Consistency-First', 'No-Gimmick Policy'] as $tag)
                                    <div
                                        class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-[10px] font-black text-white/40 uppercase tracking-widest">
                                        {{ $tag }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5 rounded-[2.5rem] border border-white/10 overflow-hidden relative group"
                        data-aos="fade-left">
                        <img src="https://revaldyadhitya.com/storage/other/41e1b6e8-79b0-4742-8393-121452c4a252.webp"
                            alt="Flame Street vibe"
                            class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-base via-base/20 to-transparent"></div>
                        <div class="relative p-8 h-full flex flex-col justify-end">
                            <div
                                class="bg-base/60 backdrop-blur-xl border border-white/10 p-6 rounded-3xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="text-flame text-[10px] font-black tracking-[0.3em] uppercase mb-2">The
                                    Vision</div>
                                <div class="text-2xl font-black text-white italic uppercase leading-tight">
                                    "Protein Cepat. Rasa Serius. Tanpa Ribet."
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- The Science / Golden Window Section --}}
                <section id="golden-window"
                    class="relative rounded-[3rem] border border-white/10 bg-white/5 overflow-hidden p-8 md:p-16 mb-20"
                    data-aos="fade-up">
                    {{-- Background Spec Grid --}}
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                        style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 30px 30px;">
                    </div>

                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <div class="flex items-center gap-3 text-flame mb-6">
                                <span class="w-12 h-px bg-flame"></span>
                                <span class="text-[10px] font-black uppercase tracking-[0.4em]">Biological
                                    Timing</span>
                            </div>
                            <h2
                                class="text-4xl md:text-6xl font-black text-white tracking-tighter uppercase italic leading-[0.9] mb-8">
                                The <span class="text-flame">Golden</span> <br />Window.
                            </h2>
                            <p class="text-white/60 text-lg leading-relaxed mb-8">
                                <strong class="text-white font-black italic uppercase">Don't Waste Your
                                    Workout.</strong><br />
                                Jendela anabolik pasca-latihan sangat krusial. Tubuhmu butuh asupan protein yang cepat
                                diserap untuk memulai perbaikan serat otot yang rusak.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ url()->current() }}?page=catalog"
                                    class="px-8 py-4 rounded-2xl bg-flame text-black font-black text-xs uppercase tracking-widest hover:brightness-110 transition shadow-[0_10px_40px_rgba(0,155,34,0.3)] text-center">
                                    Gas Order Sekarang
                                </a>
                                <a href="{{ url()->current() }}?page=home"
                                    class="px-8 py-4 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-xs font-black uppercase tracking-widest text-center text-white/60 hover:text-white">
                                    Back to Base
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            {{-- Detail Cards --}}
                            <div
                                class="bg-base/40 border border-white/10 p-6 rounded-3xl hover:border-flame/40 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="text-3xl font-black text-flame/30 italic">01</div>
                                    <div>
                                        <h3 class="text-lg font-black text-white uppercase italic tracking-tight mb-2">
                                            Charcoal Precision</h3>
                                        <p class="text-sm text-white/50 leading-relaxed">Teknik grill menggunakan arang
                                            asli menjaga kadar air dalam daging (juiciness) sambil memberikan aroma
                                            smoky yang autentik tanpa lemak tambahan.</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-base/40 border border-white/10 p-6 rounded-3xl hover:border-flame/40 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="text-3xl font-black text-flame/30 italic">02</div>
                                    <div>
                                        <h3 class="text-lg font-black text-white uppercase italic tracking-tight mb-2">
                                            2-Minute Deployment</h3>
                                        <p class="text-sm text-white/50 leading-relaxed">Waktu adalah segalanya. Sistem
                                            microwave-friendly kami memastikan makanan siap saji dalam 120 detik, tepat
                                            saat ototmu membutuhkannya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- NEW SECTION: The Performance Stats --}}
                <section class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                    @php
                        $stats = [
                            ['label' => 'Avg Protein', 'value' => '40g+', 'sub' => 'Per Serving'],
                            ['label' => 'Prep Time', 'value' => '2 Min', 'sub' => 'Ready to Eat'],
                            ['label' => 'Standard', 'value' => 'Grade A', 'sub' => 'Chicken Breast'],
                            ['label' => 'Vibe', 'value' => 'Industrial', 'sub' => 'Clean Build'],
                        ];
                    @endphp
                    @foreach ($stats as $s)
                        <div
                            class="p-8 rounded-[2.5rem] border border-white/10 bg-white/5 text-center group hover:bg-flame/5 transition-colors duration-500">
                            <div class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em] mb-2">
                                {{ $s['label'] }}</div>
                            <div
                                class="text-3xl md:text-4xl font-black text-white group-hover:text-flame transition-colors">
                                {{ $s['value'] }}</div>
                            <div class="text-[10px] font-bold text-white/20 uppercase mt-1">{{ $s['sub'] }}</div>
                        </div>
                    @endforeach
                </section>

                {{-- Footer Call to Action --}}
                <div class="mt-24 text-center" data-aos="fade-up">
                    <h2 class="text-2xl md:text-4xl font-black text-white uppercase italic tracking-tighter mb-8">Ready
                        to Optimize Your Gains?</h2>
                    <div class="flex justify-center">
                        <a href="{{ url()->current() }}?page=catalog"
                            class="group flex items-center gap-4 text-flame font-black uppercase tracking-[0.3em] text-sm">
                            Open The Catalog
                            <span class="w-16 h-px bg-flame group-hover:w-24 transition-all"></span>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- ===================== FLAME FIT (MEMBERSHIP) ===================== --}}
        @if ($page === 'flame-fit')
            <section class="mb-24 overflow-x-hidden">
                {{-- Hero Membership with Background Image --}}
                <div class="relative px-4 md:px-28 border border-white/10 overflow-hidden p-8 md:p-24 text-center group"
                    data-aos="fade-up">

                    {{-- Background Layer --}}
                    <div class="absolute inset-0 z-0">
                        <img src="https://revaldyadhitya.com/storage/other/af0b5464-7c17-4c97-ab59-440831c7a49b.webp"
                            alt="Gym Background"
                            class="h-full w-full object-cover scale-[1.05] group-hover:scale-110 transition duration-1000">
                        {{-- Overlays for Readability --}}
                        <div class="absolute inset-0 bg-gradient-to-b from-base/40 via-base/30 to-base"></div>
                        {{-- <div class="absolute inset-0 bg-gradient-to-r from-base/40 via-transparent to-base/40"></div> --}}


                    </div>

                    {{-- Content --}}
                    <div class="relative z-10">
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-flame/30 bg-flame/10 backdrop-blur-md text-flame text-[10px] font-black tracking-[0.4em] uppercase mb-10">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-flame opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-flame"></span>
                            </span>
                            Elite Access Only
                        </div>

                        <h1 class="text-6xl md:text-8xl font-black uppercase italic mb-8 text-white">
                            FLAME <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-flame to-emerald-400 text-not-italic">FIT</span>
                        </h1>

                        <p
                            class="text-white/80 text-lg md:text-2xl max-w-2xl mx-auto leading-relaxed font-medium mb-12">
                            Program membership khusus <span
                                class="text-white underline decoration-flame/50 font-bold">"Gym Rats"</span> yang
                            serius.
                            Nutrisi presisi, diantar langsung ke loker atau resepsionis gym pilihanmu.
                        </p>

                        <div class="flex flex-col sm:flex-row justify-center gap-5">
                            <a href="#join"
                                class="px-10 py-5 rounded-2xl bg-flame text-black font-black text-sm uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-[0_20px_50px_rgba(0,155,34,0.4)]">
                                Join Membership
                            </a>
                            <a href="#gym-partners"
                                class="px-10 py-5 rounded-2xl border border-white/20 bg-white/5 backdrop-blur-md hover:bg-white/10 transition-all text-sm font-black uppercase tracking-widest text-white">
                                Check Partner Gyms
                            </a>
                        </div>
                    </div>

                    {{-- Decorative Border Light --}}
                    <div
                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-flame to-transparent opacity-50">
                    </div>
                </div>

                {{-- Section: Why Flame Fit? --}}
                <div class="mt-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center px-4 md:px-28">
                    <div data-aos="fade-right">
                        <div class="flex items-center gap-3 text-flame mb-6">
                            <span class="w-12 h-px bg-flame"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.4em]">The Logic</span>
                        </div>
                        <h2 class="text-4xl font-black text-white tracking-tighter uppercase italic mb-8">
                            Zero Friction, <br /> <span class="text-white/30">Maximum Gains.</span>
                        </h2>
                        <div class="space-y-6 text-white/60 text-lg leading-relaxed font-medium">
                            <p>
                                Masalah klasik member gym: <span class="text-white italic">"Habis latihan, belum masak,
                                    akhirnya makan sembarangan di jalan."</span>
                            </p>
                            <p>
                                <span class="text-flame font-bold">Flame Fit</span> memutus rantai itu. Kami
                                bekerjasama dengan gym pilihanmu untuk memastikan makanan high-protein kamu sudah
                                menunggu begitu kamu selesai mandi pasca-workout.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4" data-aos="fade-left">
                        <div
                            class="p-6 rounded-3xl bg-white/5 border border-white/10 flex gap-6 items-start group hover:border-flame/40 transition-colors">
                            <div class="w-12 h-12 rounded-2xl bg-flame/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-flame" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-black uppercase italic tracking-tight">Direct Gym Delivery
                                </h3>
                                <p class="text-sm text-white/40 mt-1">Lupakan alamat rumah. Makanan langsung diantar ke
                                    gym partner tempat kamu latihan.</p>
                            </div>
                        </div>
                        <div
                            class="p-6 rounded-3xl bg-white/5 border border-white/10 flex gap-6 items-start group hover:border-flame/40 transition-colors">
                            <div class="w-12 h-12 rounded-2xl bg-flame/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-flame" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-black uppercase italic tracking-tight">Priority Stock</h3>
                                <p class="text-sm text-white/40 mt-1">Member Flame Fit dapat jatah stock duluan untuk
                                    menu banger yang sering sold out.</p>
                            </div>
                        </div>
                        <div
                            class="p-6 rounded-3xl bg-white/5 border border-white/10 flex gap-6 items-start group hover:border-flame/40 transition-colors">
                            <div class="w-12 h-12 rounded-2xl bg-flame/10 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-flame" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-black uppercase italic tracking-tight">Monthly Macro Report
                                </h3>
                                <p class="text-sm text-white/40 mt-1">Rekapan total protein, carbs, dan fat yang sudah
                                    kamu konsumsi lewat Flame Street.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Partner Gyms Hub --}}
                <section id="gym-partners" class="mt-32 px-4 md:px-28">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl md:text-5xl font-black text-white uppercase italic tracking-tighter">
                            Delivery <span class="text-flame">Hubs.</span>
                        </h2>
                        <p class="text-white/40 mt-4 uppercase text-xs font-black tracking-[0.3em]">Currently Active
                            Gym Partners</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
                        @foreach ($brandLogos as $gym)
                            <div
                                class="group relative rounded-3xl border border-white/10 bg-white/5 p-6 flex flex-col items-center text-center transition-all hover:border-flame/40">
                                <img src="{{ $gym['img'] }}" alt="{{ $gym['name'] }}"
                                    class="h-16 w-16 rounded-2xl object-cover mb-4 grayscale group-hover:grayscale-0 transition-all">
                                <div class="font-black text-white uppercase text-sm tracking-tight">
                                    {{ $gym['name'] }}</div>
                                <div class="text-[10px] text-flame font-bold uppercase mt-1 tracking-widest italic">
                                    Active Hub</div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Membership CTA Form --}}
                <section id="join"
                    class="mt-32 px-4 md:px-28 relative overflow-hidden rounded-[3rem] border border-white/10 bg-white/5 p-8 md:p-16">
                    <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none hidden lg:block">
                        <svg width="300" height="300" viewBox="0 0 100 100" fill="none" stroke="white">
                            <circle cx="50" cy="50" r="40" stroke-width="0.5"
                                stroke-dasharray="4 2" />
                            <path d="M50 10v80M10 50h80" stroke-width="0.2" />
                        </svg>
                    </div>

                    <div class="relative z-10 max-w-2xl">
                        <h2
                            class="text-4xl md:text-6xl font-black text-white tracking-tighter uppercase italic leading-none mb-6">
                            Ready to <br /><span class="text-flame">Level Up?</span>
                        </h2>
                        <p class="text-white/60 text-lg mb-10 font-medium">
                            Isi data di bawah, tim kami akan memverifikasi status membership kamu dan menghubungkan
                            akunmu dengan Gym pilihanmu.
                        </p>

                        <form action="#" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" placeholder="FULL NAME"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder:text-white/20 focus:outline-none focus:border-flame/50 transition-all font-bold text-sm">
                                <input type="text" placeholder="PHONE NUMBER (WA)"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder:text-white/20 focus:outline-none focus:border-flame/50 transition-all font-bold text-sm">
                            </div>
                            <select
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white/50 focus:outline-none focus:border-flame/50 transition-all font-bold text-sm appearance-none">
                                <option value="">SELECT YOUR GYM HUB</option>
                                @foreach ($brandLogos as $gym)
                                    <option value="{{ $gym['name'] }}">{{ strtoupper($gym['name']) }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="w-full py-5 rounded-2xl bg-flame text-black font-black text-xs uppercase tracking-[0.2em] hover:brightness-110 transition shadow-[0_10px_40px_rgba(0,155,34,0.3)]">
                                Apply for Membership
                            </button>
                        </form>
                    </div>
                </section>
            </section>
        @endif


    </main>

    {{-- Modern Industrial Footer --}}
    <footer class="relative mt-20 border-t border-white/10 bg-base overflow-hidden">
        {{-- Giant Background Text (SaaS Style) --}}
        <div class="absolute -bottom-12 -left-10 select-none pointer-events-none">
            <h2 class="text-[12rem] md:text-[20rem] font-black text-white/[0.02] leading-none tracking-tighter">
                STREET
            </h2>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 pt-20 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 md:gap-8">

                {{-- Brand Column --}}
                <div class="space-y-6">
                    <div>
                        <a href="{{ url()->current() }}?page=home"
                            class="text-2xl font-black tracking-tighter flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-lg bg-flame flex items-center justify-center text-black italic">F</span>
                            FLAME STREET
                        </a>
                        <p class="mt-4 text-white/50 text-sm leading-relaxed max-w-xs font-medium">
                            Premium high-protein meal prep designed for high-performance individuals. Real food, zero
                            fluff.
                        </p>
                    </div>
                    {{-- Operational Status --}}
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/5 bg-white/[0.02]">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-flame opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-flame"></span>
                        </span>
                        <span class="text-[10px] font-black text-white/40 uppercase tracking-widest">Kitchen Status:
                            Online</span>
                    </div>
                </div>

                {{-- Navigation --}}
                <div>
                    <h4 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-8">Navigation</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ url()->current() }}?page=home"
                                class="text-sm font-bold text-white/50 hover:text-flame transition-colors">Home
                                Base</a></li>
                        <li><a href="{{ url()->current() }}?page=catalog"
                                class="text-sm font-bold text-white/50 hover:text-flame transition-colors">Fuel
                                Catalog</a></li>
                        <li><a href="{{ url()->current() }}?page=about"
                                class="text-sm font-bold text-white/50 hover:text-flame transition-colors">The
                                Manifesto</a></li>
                    </ul>
                </div>

                {{-- Social & Contact --}}
                <div>
                    <h4 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-8">Connect</h4>
                    <ul class="space-y-4">
                        <li><a href="#"
                                class="group flex items-center gap-3 text-sm font-bold text-white/50 hover:text-white transition-colors">
                                <span class="w-8 h-px bg-white/10 group-hover:bg-flame transition-all"></span>
                                Instagram
                            </a></li>
                        <li><a href="#"
                                class="group flex items-center gap-3 text-sm font-bold text-white/50 hover:text-white transition-colors">
                                <span class="w-8 h-px bg-white/10 group-hover:bg-flame transition-all"></span> WhatsApp
                            </a></li>
                        <li><a href="#"
                                class="group flex items-center gap-3 text-sm font-bold text-white/50 hover:text-white transition-colors">
                                <span class="w-8 h-px bg-white/10 group-hover:bg-flame transition-all"></span> GrabFood
                            </a></li>
                    </ul>
                </div>

                {{-- CTA Column --}}
                <div class="relative">
                    <div class="p-6 rounded-3xl bg-white/[0.03] border border-white/10 backdrop-blur-sm">
                        <h4 class="text-sm font-black text-white uppercase tracking-tight mb-2">Ready to grow?</h4>
                        <p class="text-xs text-white/40 leading-relaxed mb-6 font-medium">
                            Join our network and start optimizing your nutrition window today.
                        </p>
                        <a href="{{ url()->current() }}?page=catalog"
                            class="flex items-center justify-center w-full py-3 rounded-xl bg-flame text-black font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-[0_10px_30px_rgba(0,155,34,0.2)]">
                            Order Now
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div
                class="mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-[10px] font-bold text-white/20 uppercase tracking-[0.3em]">
                    © {{ date('Y') }} FLAME STREET • ANTI BASA-BASI
                </div>

                <div class="flex items-center gap-8">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-1 rounded-full bg-white/20"></div>
                        <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Terms</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-1 rounded-full bg-white/20"></div>
                        <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Privacy</span>
                    </div>
                </div>

                <div class="text-[10px] font-bold text-white/40">
                    MADE BY <span class="text-white hover:text-flame transition-colors cursor-pointer">EVAN
                        GRIMALDI</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Mobile menu
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        if (btn && menu) btn.addEventListener('click', () => menu.classList.toggle('hidden'));

        // AOS
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 80,
        });

        // Swiper (Home)
        const sliderEl = document.querySelector('.product-slider');
        if (sliderEl) {
            new Swiper('.product-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                breakpoints: {
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
            });
        }

        // Catalog filters
        const productCards = Array.from(document.querySelectorAll('.productCard'));
        const typeButtons = Array.from(document.querySelectorAll('.filterType'));
        const kcalRange = document.getElementById('kcalRange');
        const kcalLabel = document.getElementById('kcalLabel');
        const countLabel = document.getElementById('countLabel');
        const resetBtn = document.getElementById('resetFilters');

        let activeType = 'All';
        let maxKcal = kcalRange ? parseInt(kcalRange.value, 10) : 9999;

        function setActiveTypeButton() {
            typeButtons.forEach(b => {
                const isActive = b.dataset.type === activeType;
                b.classList.toggle('bg-flame', isActive);
                b.classList.toggle('text-black', isActive);
                b.classList.toggle('shadow-[0_0_45px_rgba(0,155,34,0.20)]', isActive);
                if (!isActive) {
                    b.classList.remove('bg-flame', 'text-black', 'shadow-[0_0_45px_rgba(0,155,34,0.20)]');
                }
            });
        }

        function applyFilters() {
            let shown = 0;
            productCards.forEach(card => {
                const type = card.dataset.type;
                const kcal = parseInt(card.dataset.kcal, 10);

                const matchType = (activeType === 'All') || (type === activeType);
                const matchKcal = kcal <= maxKcal;

                const show = matchType && matchKcal;
                card.style.display = show ? '' : 'none';
                if (show) shown++;
            });

            if (countLabel) countLabel.textContent = shown;
        }

        if (typeButtons.length) {
            typeButtons.forEach(b => {
                b.addEventListener('click', () => {
                    activeType = b.dataset.type || 'All';
                    setActiveTypeButton();
                    applyFilters();
                });
            });
            setActiveTypeButton();
        }

        if (kcalRange && kcalLabel) {
            kcalLabel.textContent = kcalRange.value;
            kcalRange.addEventListener('input', (e) => {
                maxKcal = parseInt(e.target.value, 10);
                kcalLabel.textContent = maxKcal;
                applyFilters();
            });
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                activeType = 'All';
                if (kcalRange) kcalRange.value = 500;
                maxKcal = 500;
                if (kcalLabel) kcalLabel.textContent = '500';
                setActiveTypeButton();
                applyFilters();
            });
        }

        // Initial apply on catalog
        if (productCards.length) applyFilters();
    </script>
</body>

</html>
