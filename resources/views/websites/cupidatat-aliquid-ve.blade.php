{{-- resources/views/catering.blade.php --}}
@php
  $p = request('p', 'beranda');

  $nav = [
    'beranda' => 'Beranda',
    'menu' => 'Menu',
    'paket' => 'Paket Acara',
    'galeri' => 'Galeri',
    'testimoni' => 'Testimoni',
    'kontak' => 'Kontak',
  ];

  $site = [
    'brand' => 'CC Bohay',
    'tagline' => 'Cita rasa rumahan, rapi untuk acara.',
    'city' => 'Jakarta & Sekitarnya',
    'wa_number' => '6281234567890', // ganti nomor WA kamu (format 62xxx, tanpa +)
  ];

  $menuKategori = [
    'Nasi Box' => [
      ['nama'=>'Nasi Box Ayam Bakar + Sambal + Lalap', 'harga'=>'Rp 35.000', 'img'=>'https://images.unsplash.com/photo-1604909053209-6bb85fdfb8d5?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Nasi Box Rendang + Sayur + Kerupuk', 'harga'=>'Rp 45.000', 'img'=>'https://images.unsplash.com/photo-1604908176997-125f25cc5004?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Nasi Box Ikan Balado + Tumis Buncis', 'harga'=>'Rp 40.000', 'img'=>'https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=1400&q=80'],
    ],
    'Prasmanan' => [
      ['nama'=>'Paket Prasmanan 50 pax (2 lauk + sayur + nasi + dessert)', 'harga'=>'Mulai Rp 3.500.000', 'img'=>'https://images.unsplash.com/photo-1555243896-c709bfa0b564?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Paket Prasmanan 100 pax (3 lauk + sayur + minum + buah)', 'harga'=>'Mulai Rp 7.500.000', 'img'=>'https://images.unsplash.com/photo-1555992336-03a23c7b20b1?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Live Station (Soto / Bakso / Sate) — add-on', 'harga'=>'Mulai Rp 1.250.000', 'img'=>'https://images.unsplash.com/photo-1604908177225-6f5b7e1b8d0f?auto=format&fit=crop&w=1400&q=80'],
    ],
    'Snack Box' => [
      ['nama'=>'Snack Box 3 macam kue + air mineral', 'harga'=>'Rp 18.000', 'img'=>'https://images.unsplash.com/photo-1523986371872-9d3ba2e2f5c8?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Snack Box 4 macam (kue tradisional mix) + teh', 'harga'=>'Rp 25.000', 'img'=>'https://images.unsplash.com/photo-1548940740-204726a19be3?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Coffee Break Kantor (snack + kopi/teh)', 'harga'=>'Mulai Rp 28.000', 'img'=>'https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1400&q=80'],
    ],
    'Tumpeng' => [
      ['nama'=>'Tumpeng Mini (10–12 porsi)', 'harga'=>'Mulai Rp 650.000', 'img'=>'https://images.unsplash.com/photo-1625944527474-5d8c2c8e85b0?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Tumpeng Sedang (20–25 porsi)', 'harga'=>'Mulai Rp 1.250.000', 'img'=>'https://images.unsplash.com/photo-1625944527375-1a289d80f048?auto=format&fit=crop&w=1400&q=80'],
      ['nama'=>'Tumpeng Besar (40–50 porsi)', 'harga'=>'Mulai Rp 2.350.000', 'img'=>'https://images.unsplash.com/photo-1625944527336-6b0f9d6c5a1f?auto=format&fit=crop&w=1400&q=80'],
    ],
  ];

  $paket = [
    [
      'judul' => 'Paket Pernikahan Prasmanan',
      'untuk' => 'Resepsi / Akad / After party',
      'badge' => 'Paling Favorit',
      'harga' => 'Mulai Rp 85.000/pax',
      'include' => [
        'Nasi putih / nasi kebuli (opsional)',
        '3 lauk utama + 2 lauk pendamping + 1 sayur',
        'Sambal, acar, kerupuk',
        'Es buah / dessert + minuman',
        'Peralatan saji & pemanas',
        'Pramusaji (sesuai pax)',
      ],
      'img' => 'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=1400&q=80'
    ],
    [
      'judul' => 'Paket Akikah',
      'untuk' => 'Akikah / Syukuran bayi',
      'badge' => 'Praktis',
      'harga' => 'Mulai Rp 35.000/box',
      'include' => [
        'Nasi box (ayam bumbu rujak / gulai / rendang)',
        'Sayur + sambal + kerupuk',
        'Label nama (opsional)',
        'Gratis sendok + tisu',
      ],
      'img' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=1400&q=80'
    ],
    [
      'judul' => 'Paket Arisan & Pengajian',
      'untuk' => 'Arisan, pengajian rutin, yasinan',
      'badge' => 'Hemat',
      'harga' => 'Mulai Rp 18.000/pax',
      'include' => [
        'Snack box 3–4 item (kue tradisional mix)',
        'Air mineral / teh manis',
        'Bisa upgrade jadi nasi box',
      ],
      'img' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=1400&q=80'
    ],
    [
      'judul' => 'Paket Ulang Tahun',
      'untuk' => 'Ulang tahun anak/dewasa',
      'badge' => 'Custom',
      'harga' => 'Mulai Rp 55.000/pax',
      'include' => [
        'Prasmanan mini / nasi box',
        'Menu kids-friendly (opsional)',
        'Puding/cup dessert',
        'Dekor meja saji sederhana (opsional)',
      ],
      'img' => 'https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?auto=format&fit=crop&w=1400&q=80'
    ],
    [
      'judul' => 'Paket Rapat & Kantor',
      'untuk' => 'Meeting, training, event kantor',
      'badge' => 'On-time',
      'harga' => 'Mulai Rp 28.000/pax',
      'include' => [
        'Coffee break (snack + kopi/teh) atau nasi box',
        'Pengantaran tepat waktu',
        'Invoice & kebutuhan admin',
      ],
      'img' => 'https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=1400&q=80'
    ],
    [
      'judul' => 'Paket Buka Puasa (Ramadhan)',
      'untuk' => 'Bukber kantor/keluarga/komunitas',
      'badge' => 'Musiman',
      'harga' => 'Mulai Rp 45.000/pax',
      'include' => [
        'Takjil (kolak / es campur / kurma)',
        'Nasi + 2 lauk + sayur',
        'Air mineral/teh',
      ],
      'img' => 'https://images.unsplash.com/photo-1540914124281-342587941389?auto=format&fit=crop&w=1400&q=80'
    ],
  ];

  $galeri = [
    'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1555992336-03a23c7b20b1?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?auto=format&fit=crop&w=1600&q=80',
    'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=1600&q=80',
  ];

  $testimoni = [
    ['nama'=>'Mbak Rani — Cilandak', 'teks'=>'Rapi banget, datang tepat waktu. Rasa ayam bakarnya juara, tamu pada nambah.'],
    ['nama'=>'Pak Dimas — Bekasi', 'teks'=>'Pesan untuk rapat kantor 80 pax, administrasinya enak, invoice lengkap, pengiriman on-time.'],
    ['nama'=>'Bu Sari — Depok', 'teks'=>'Snack box untuk pengajian, kuenya fresh dan packagingnya bagus. Harga juga bersahabat.'],
  ];

  $waPrefill = rawurlencode("Halo {$site['brand']}, saya mau tanya catering.\n\n- Nama:\n- Tanggal acara:\n- Lokasi:\n- Jenis acara (nikah/arisan/akikah/kantor/dll):\n- Perkiraan pax:\n- Preferensi (nasi box/prasmanan/snack box/tumpeng):\n\nTerima kasih.");
  $waLink = "https://wa.me/{$site['wa_number']}?text={$waPrefill}";
@endphp

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $site['brand'] }} — Catering Indonesia</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', 'sans-serif'],
            display: ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            ink: '#0b0b0b',
            coal: '#121212',
            card: '#171717',
            line: 'rgba(255,255,255,.12)',
            accent: '#E35D2F',
            accent2: '#F3B53F'
          },
          letterSpacing: { wide2: '0.18em' }
        }
      }
    }
  </script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">

  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>

  <style>
    :root { color-scheme: dark; }
    body { background:#0b0b0b; }
    .tiny { font-size: 11px; letter-spacing: .18em; text-transform: uppercase; }
    .hairline { height: 1px; background: rgba(255,255,255,.12); }
    .bg-grid {
      background-image:
        radial-gradient(circle at 1px 1px, rgba(255,255,255,.06) 1px, transparent 0);
      background-size: 20px 20px;
    }
  </style>
</head>

<body class="text-white font-sans">
  {{-- Top bar --}}
  <div class="bg-coal/60 backdrop-blur border-b border-white/10">
    <div class="mx-auto max-w-7xl px-5 sm:px-8 py-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
      <div class="text-xs text-white/70">
        <span class="font-medium text-white/85">{{ $site['city'] }}</span>
        <span class="mx-2 text-white/30">•</span>
        Prasmanan • Nasi Box • Snack Box • Tumpeng
      </div>
      <div class="flex items-center gap-3 text-xs">
        <span class="text-white/50">Jam operasional:</span>
        <span class="text-white/80">08.00–20.00</span>
        <span class="mx-2 text-white/30">|</span>
        <a href="{{ $waLink }}" class="text-white/85 hover:text-white underline underline-offset-4">WhatsApp</a>
      </div>
    </div>
  </div>

  {{-- Header / Nav --}}
  <header class="sticky top-0 z-40 bg-ink/75 backdrop-blur border-b border-white/10">
    <div class="mx-auto max-w-7xl px-5 sm:px-8 py-4 flex items-center justify-between gap-4">
      <a href="{{ request()->url() }}?p=beranda" class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-accent to-accent2 grid place-items-center shadow-lg shadow-black/30">
          <span class="font-display font-bold">DN</span>
        </div>
        <div>
          <div class="font-display font-semibold leading-tight">{{ $site['brand'] }}</div>
          <div class="tiny text-white/55">{{ $site['tagline'] }}</div>
        </div>
      </a>

      <nav class="hidden lg:flex items-center gap-1">
        @foreach($nav as $key => $label)
          <a href="{{ request()->url() }}?p={{ $key }}"
             class="px-4 py-2 rounded-full text-sm transition
                    {{ $p===$key ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
            {{ $label }}
          </a>
        @endforeach
      </nav>

      <div class="flex items-center gap-2">
        <a href="{{ request()->url() }}?p=kontak"
           class="hidden sm:inline-flex items-center gap-2 rounded-full bg-white text-ink px-4 py-2 text-sm font-semibold hover:bg-white/90 transition">
          Minta Penawaran
          <span aria-hidden="true">→</span>
        </a>

        <button id="btnMobile" class="lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl border border-white/15 hover:bg-white/5 transition"
                aria-label="Buka menu">
          ☰
        </button>
      </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="lg:hidden hidden border-t border-white/10 bg-ink">
      <div class="mx-auto max-w-7xl px-5 sm:px-8 py-3 grid gap-1">
        @foreach($nav as $key => $label)
          <a href="{{ request()->url() }}?p={{ $key }}"
             class="px-4 py-3 rounded-xl text-sm transition
                    {{ $p===$key ? 'bg-white/10 text-white' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
            {{ $label }}
          </a>
        @endforeach
        <a href="{{ $waLink }}" class="mt-2 px-4 py-3 rounded-xl bg-accent text-white font-semibold text-sm text-center hover:brightness-110 transition">
          Pesan via WhatsApp
        </a>
      </div>
    </div>
  </header>

  {{-- Page content --}}
  <main>
    {{-- BERANDA --}}
    @if($p === 'beranda')
      <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-40"></div>
        <div class="absolute inset-0">
          <img class="h-full w-full object-cover opacity-30"
               src="https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=2200&q=80"
               alt="Catering Indonesia" />
          <div class="absolute inset-0 bg-gradient-to-b from-ink/40 via-ink/70 to-ink"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-5 sm:px-8 py-16 sm:py-20">
          <div class="grid gap-10 lg:grid-cols-12 items-center">
            <div class="lg:col-span-7" data-aos="fade-up" data-aos-duration="900">
              <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs text-white/75">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Bisa untuk acara keluarga & kantor
              </div>

              <h1 class="mt-6 font-display font-bold tracking-tight text-4xl sm:text-5xl md:text-6xl leading-[1.02]">
                Catering Indonesia yang <span class="text-accent">Enak</span>, Rapi, dan Tepat Waktu.
              </h1>

              <p class="mt-5 text-white/70 text-base sm:text-lg leading-relaxed max-w-2xl">
                Dari <b>nasi box</b> sampai <b>prasmanan</b> untuk pernikahan, arisan, akikah, rapat kantor,
                pengajian, syukuran rumah, hingga buka puasa. Menu bisa disesuaikan budget & selera.
              </p>

              <div class="mt-7 flex flex-col sm:flex-row gap-3">
                <a href="{{ request()->url() }}?p=paket"
                   class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-6 py-3 font-semibold hover:brightness-110 transition">
                  Lihat Paket Acara
                  <span aria-hidden="true">→</span>
                </a>
                <a href="{{ $waLink }}"
                   class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3 font-semibold text-white/90 hover:bg-white/10 transition">
                  Konsultasi via WhatsApp
                  <span aria-hidden="true">↗</span>
                </a>
              </div>

              <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                  ['judul'=>'On-time', 'desc'=>'Pengiriman & setup rapi'],
                  ['judul'=>'Halal', 'desc'=>'Bahan segar & bersih'],
                  ['judul'=>'Custom', 'desc'=>'Menu & budget fleksibel'],
                  ['judul'=>'Event-ready', 'desc'=>'Pramusaji & peralatan'],
                ] as $stat)
                  <div class="rounded-2xl border border-white/10 bg-white/5 p-4" data-aos="fade-up">
                    <div class="font-display font-semibold">{{ $stat['judul'] }}</div>
                    <div class="text-sm text-white/65 mt-1">{{ $stat['desc'] }}</div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="lg:col-span-5" data-aos="fade-left" data-aos-duration="900">
              <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden shadow-2xl shadow-black/40">
                <img class="h-72 sm:h-80 w-full object-cover"
                     src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=1600&q=80"
                     alt="Prasmanan" />
                <div class="p-6">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="tiny text-white/55">Paket cepat</div>
                      <div class="font-display font-semibold text-xl mt-1">Nasi Box Corporate</div>
                    </div>
                    <div class="text-right">
                      <div class="text-white/60 text-sm">mulai</div>
                      <div class="font-display font-bold text-accent text-xl">Rp 28K</div>
                    </div>
                  </div>
                  <div class="hairline my-4"></div>
                  <ul class="text-sm text-white/70 grid gap-2">
                    <li>• Minimal order 30 box</li>
                    <li>• Bisa request level pedas</li>
                    <li>• Free label perusahaan (min. 50 box)</li>
                  </ul>
                  <a class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white hover:text-white/90"
                     href="{{ request()->url() }}?p=kontak">
                    Minta menu hari ini <span aria-hidden="true">→</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14">
        <div class="grid gap-10 lg:grid-cols-12 items-start">
          <div class="lg:col-span-5" data-aos="fade-up">
            <div class="tiny text-white/55">Acara yang umum di Indonesia</div>
            <h2 class="mt-3 font-display font-bold text-3xl sm:text-4xl">Kami bisa handle dari kecil sampai besar</h2>
            <p class="mt-4 text-white/70 leading-relaxed">
              Cocok untuk: <b>pernikahan</b>, <b>akikah</b>, <b>arisan</b>, <b>ulang tahun</b>, <b>rapat kantor</b>,
              <b>pengajian/yasinan</b>, <b>tahlilan</b>, <b>syukuran rumah</b>, dan <b>buka puasa</b>.
            </p>
          </div>

          <div class="lg:col-span-7 grid sm:grid-cols-2 gap-4" data-aos="fade-up" data-aos-delay="100">
            @foreach([
              ['t'=>'Pernikahan', 'd'=>'Prasmanan lengkap + pramusaji'],
              ['t'=>'Akikah', 'd'=>'Nasi box, praktis untuk dibagi'],
              ['t'=>'Arisan', 'd'=>'Snack box / prasmanan mini'],
              ['t'=>'Rapat Kantor', 'd'=>'Coffee break / nasi box on-time'],
              ['t'=>'Pengajian & Tahlilan', 'd'=>'Menu rumahan, rapi & sopan'],
              ['t'=>'Buka Puasa', 'd'=>'Takjil + menu utama'],
            ] as $item)
              <div class="rounded-2xl border border-white/10 bg-card p-5">
                <div class="font-display font-semibold text-lg">{{ $item['t'] }}</div>
                <div class="text-white/65 text-sm mt-1">{{ $item['d'] }}</div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    {{-- MENU --}}
    @if($p === 'menu')
      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
          <div data-aos="fade-up">
            <div class="tiny text-white/55">Menu Nusantara</div>
            <h1 class="mt-2 font-display font-bold text-3xl sm:text-4xl md:text-5xl">Pilihan Menu Catering</h1>
            <p class="mt-3 text-white/70 max-w-2xl leading-relaxed">
              Menu di bawah contoh favorit pelanggan. Kamu bisa request: <b>nasi uduk</b>, <b>nasi kebuli</b>,
              <b>rendang</b>, <b>ayam bakar</b>, <b>sate</b>, <b>soto</b>, kue tradisional, dll.
            </p>
          </div>

          <a href="{{ $waLink }}"
             class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-6 py-3 font-semibold hover:brightness-110 transition"
             data-aos="fade-left">
            Tanya Menu & Harga via WA <span aria-hidden="true">↗</span>
          </a>
        </div>

        <div class="mt-10 grid gap-10">
          @foreach($menuKategori as $kat => $items)
            <div>
              <div class="flex items-center justify-between gap-4">
                <h2 class="font-display font-bold text-2xl sm:text-3xl" data-aos="fade-up">{{ $kat }}</h2>
                <div class="hidden sm:block hairline flex-1"></div>
              </div>

              <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($items as $i => $m)
                  <article class="rounded-2xl overflow-hidden border border-white/10 bg-card group"
                           data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="relative">
                      <img class="h-48 w-full object-cover group-hover:scale-[1.03] transition duration-500"
                           src="{{ $m['img'] }}" alt="{{ $m['nama'] }}">
                      <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                      <div class="absolute left-4 bottom-4 right-4 flex items-end justify-between">
                        <div class="text-sm font-semibold">{{ $m['nama'] }}</div>
                        <div class="text-sm font-bold text-accent2 whitespace-nowrap">{{ $m['harga'] }}</div>
                      </div>
                    </div>

                    <div class="p-5">
                      <ul class="text-sm text-white/70 grid gap-2">
                        <li>• Bisa request level pedas</li>
                        <li>• Bisa tambah buah/dessert</li>
                        <li>• Cocok untuk acara & kantor</li>
                      </ul>
                      <button
                        class="mt-5 w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm font-semibold hover:bg-white/10 transition"
                        onclick="openOrder('{{ addslashes($m['nama']) }}', '{{ $m['harga'] }}')">
                        Pesan Menu Ini
                      </button>
                    </div>
                  </article>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </section>
    @endif

    {{-- PAKET --}}
    @if($p === 'paket')
      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="grid gap-8 lg:grid-cols-12 items-end">
          <div class="lg:col-span-8" data-aos="fade-up">
            <div class="tiny text-white/55">Paket Catering Acara</div>
            <h1 class="mt-2 font-display font-bold text-3xl sm:text-4xl md:text-5xl">
              Paket untuk acara yang biasa di Indonesia
            </h1>
            <p class="mt-4 text-white/70 leading-relaxed max-w-3xl">
              Kamu bisa pilih paket sesuai kebutuhan: pernikahan, akikah, arisan/pengajian, ulang tahun,
              rapat kantor, sampai buka puasa. Menu dapat diubah (upgrade/downgrade) sesuai budget.
            </p>
          </div>
          <div class="lg:col-span-4" data-aos="fade-left">
            <div class="rounded-2xl border border-white/10 bg-card p-5">
              <div class="font-display font-semibold">Add-on Populer</div>
              <ul class="mt-3 text-sm text-white/70 grid gap-2">
                <li>• Live station: soto/bakso/sate</li>
                <li>• Es teh/infused water dispenser</li>
                <li>• Dekor meja saji sederhana</li>
                <li>• Pramusaji tambahan</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="mt-10 grid lg:grid-cols-2 gap-6">
          @foreach($paket as $idx => $pk)
            <article class="rounded-3xl overflow-hidden border border-white/10 bg-card"
                     data-aos="fade-up" data-aos-delay="{{ $idx * 90 }}">
              <div class="relative">
                <img class="h-56 w-full object-cover"
                     src="{{ $pk['img'] }}" alt="{{ $pk['judul'] }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                <div class="absolute left-5 bottom-5 right-5">
                  <div class="flex items-center justify-between gap-3">
                    <div>
                      <div class="inline-flex items-center gap-2">
                        <span class="rounded-full bg-accent px-3 py-1 text-xs font-semibold">{{ $pk['badge'] }}</span>
                        <span class="text-xs text-white/70">{{ $pk['untuk'] }}</span>
                      </div>
                      <h2 class="mt-2 font-display font-bold text-2xl">{{ $pk['judul'] }}</h2>
                    </div>
                    <div class="text-right">
                      <div class="text-white/60 text-sm">Harga</div>
                      <div class="font-display font-bold text-accent2 text-lg">{{ $pk['harga'] }}</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="p-6">
                <div class="tiny text-white/55">Termasuk</div>
                <ul class="mt-3 grid gap-2 text-sm text-white/75">
                  @foreach($pk['include'] as $inc)
                    <li>• {{ $inc }}</li>
                  @endforeach
                </ul>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                  <button
                    class="flex-1 rounded-xl bg-accent px-4 py-3 text-sm font-semibold hover:brightness-110 transition"
                    onclick="openOrder('{{ addslashes($pk['judul']) }}', '{{ $pk['harga'] }}')">
                    Minta Penawaran
                  </button>
                  <a class="flex-1 rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm font-semibold text-center hover:bg-white/10 transition"
                     href="{{ request()->url() }}?p=menu">
                    Lihat Menu
                  </a>
                </div>

                <p class="mt-4 text-xs text-white/45">
                  Catatan: harga tergantung lokasi, jumlah pax, dan pilihan menu. Minimal order dapat berbeda per paket.
                </p>
              </div>
            </article>
          @endforeach
        </div>
      </section>
    @endif

    {{-- GALERI --}}
    @if($p === 'galeri')
      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
          <div data-aos="fade-up">
            <div class="tiny text-white/55">Galeri</div>
            <h1 class="mt-2 font-display font-bold text-3xl sm:text-4xl md:text-5xl">Preview Setup & Hidangan</h1>
            <p class="mt-3 text-white/70 max-w-2xl leading-relaxed">
              Dokumentasi contoh (ilustrasi). Untuk foto event asli, minta katalog via WhatsApp.
            </p>
          </div>
          <a href="{{ $waLink }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-6 py-3 font-semibold hover:brightness-110 transition"
             data-aos="fade-left">
            Minta Katalog Lengkap <span aria-hidden="true">↗</span>
          </a>
        </div>

        <div class="mt-10 grid grid-cols-2 lg:grid-cols-4 gap-4">
          @foreach($galeri as $i => $img)
            <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-card"
                 data-aos="zoom-in" data-aos-delay="{{ $i * 60 }}">
              <img src="{{ $img }}" alt="Galeri {{ $i+1 }}"
                   class="h-40 sm:h-48 lg:h-56 w-full object-cover hover:scale-[1.04] transition duration-500">
            </div>
          @endforeach
        </div>
      </section>
    @endif

    {{-- TESTIMONI --}}
    @if($p === 'testimoni')
      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="grid gap-8 lg:grid-cols-12 items-start">
          <div class="lg:col-span-5" data-aos="fade-up">
            <div class="tiny text-white/55">Testimoni</div>
            <h1 class="mt-2 font-display font-bold text-3xl sm:text-4xl md:text-5xl">Kata pelanggan</h1>
            <p class="mt-4 text-white/70 leading-relaxed">
              Fokus kami: rasa konsisten, packaging rapi, dan komunikasi enak. Cocok untuk kebutuhan keluarga maupun kantor.
            </p>

            <div class="mt-7 rounded-2xl border border-white/10 bg-card p-5">
              <div class="font-display font-semibold">Butuh cepat?</div>
              <p class="mt-2 text-sm text-white/70">Kirim tanggal, lokasi, dan perkiraan pax. Kami bantu rekomendasikan paket.</p>
              <a href="{{ $waLink }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-accent2 hover:underline underline-offset-4">
                Chat WhatsApp sekarang <span aria-hidden="true">→</span>
              </a>
            </div>
          </div>

          <div class="lg:col-span-7 grid gap-4" data-aos="fade-up" data-aos-delay="100">
            @foreach($testimoni as $t)
              <div class="rounded-2xl border border-white/10 bg-card p-6">
                <div class="flex items-start justify-between gap-4">
                  <div class="font-display font-semibold">{{ $t['nama'] }}</div>
                  <div class="text-xs text-white/40">★★★★★</div>
                </div>
                <p class="mt-3 text-white/75 leading-relaxed">“{{ $t['teks'] }}”</p>
              </div>
            @endforeach

            <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-card to-white/5 p-6">
              <div class="font-display font-semibold">Garansi kepuasan (versi kami)</div>
              <p class="mt-2 text-sm text-white/70">
                Kalau ada item yang kurang saat pengiriman, tim kami siap kirim susulan secepatnya (sesuai kondisi area).
              </p>
            </div>
          </div>
        </div>
      </section>
    @endif

    {{-- KONTAK --}}
    @if($p === 'kontak')
      <section class="mx-auto max-w-7xl px-5 sm:px-8 py-14 sm:py-16">
        <div class="grid gap-10 lg:grid-cols-12 items-start">
          <div class="lg:col-span-6" data-aos="fade-up">
            <div class="tiny text-white/55">Kontak & Pemesanan</div>
            <h1 class="mt-2 font-display font-bold text-3xl sm:text-4xl md:text-5xl">Minta penawaran catering</h1>
            <p class="mt-4 text-white/70 leading-relaxed max-w-xl">
              Isi form singkat di kanan, nanti otomatis dibuatkan pesan WhatsApp (lebih cepat).
              Kamu juga bisa langsung klik tombol WA di bawah.
            </p>

            <div class="mt-8 grid gap-3 text-sm">
              <div class="flex items-center justify-between border-b border-white/10 py-3">
                <span class="text-white/60">Area layanan</span>
                <span class="text-white/85">{{ $site['city'] }}</span>
              </div>
              <div class="flex items-center justify-between border-b border-white/10 py-3">
                <span class="text-white/60">Minimum order</span>
                <span class="text-white/85">Mulai 20–30 pax (tergantung paket)</span>
              </div>
              <div class="flex items-center justify-between border-b border-white/10 py-3">
                <span class="text-white/60">Metode</span>
                <span class="text-white/85">Transfer / QRIS (opsional)</span>
              </div>
            </div>

            <a href="{{ $waLink }}"
               class="mt-8 inline-flex items-center justify-center gap-2 rounded-full bg-accent px-6 py-3 font-semibold hover:brightness-110 transition">
              Chat WhatsApp <span aria-hidden="true">↗</span>
            </a>
          </div>

          <div class="lg:col-span-6" data-aos="fade-left" data-aos-duration="900">
            <div class="rounded-3xl border border-white/10 bg-card p-6 sm:p-8">
              <div class="font-display font-semibold text-xl">Form Pemesanan Cepat</div>
              <p class="mt-2 text-sm text-white/60">Klik “Kirim ke WhatsApp” untuk membuka chat otomatis.</p>

              <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <label class="block">
                  <span class="text-xs text-white/60">Nama</span>
                  <input id="fNama" type="text" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                         placeholder="Nama kamu">
                </label>
                <label class="block">
                  <span class="text-xs text-white/60">No. HP (opsional)</span>
                  <input id="fHp" type="text" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                         placeholder="08xxxxxxxxxx">
                </label>

                <label class="block">
                  <span class="text-xs text-white/60">Tanggal Acara</span>
                  <input id="fTanggal" type="date" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white/15">
                </label>

                <label class="block">
                  <span class="text-xs text-white/60">Perkiraan Pax</span>
                  <input id="fPax" type="number" min="1" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                         placeholder="misal: 80">
                </label>

                <label class="block sm:col-span-2">
                  <span class="text-xs text-white/60">Jenis Acara</span>
                  <select id="fAcara" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white/15">
                    <option>Pernikahan</option>
                    <option>Akikah</option>
                    <option>Arisan</option>
                    <option>Pengajian / Yasinan</option>
                    <option>Tahlilan</option>
                    <option>Ulang Tahun</option>
                    <option>Rapat / Event Kantor</option>
                    <option>Buka Puasa (Ramadhan)</option>
                    <option>Syukuran Rumah</option>
                    <option>Lainnya</option>
                  </select>
                </label>

                <label class="block sm:col-span-2">
                  <span class="text-xs text-white/60">Preferensi Paket</span>
                  <select id="fPreferensi" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white/15">
                    <option>Prasmanan</option>
                    <option>Nasi Box</option>
                    <option>Snack Box / Coffee Break</option>
                    <option>Tumpeng</option>
                    <option>Masih bingung (minta rekomendasi)</option>
                  </select>
                </label>

                <label class="block sm:col-span-2">
                  <span class="text-xs text-white/60">Lokasi</span>
                  <input id="fLokasi" type="text" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                         placeholder="Kecamatan/Kota, patokan (opsional)">
                </label>

                <label class="block sm:col-span-2">
                  <span class="text-xs text-white/60">Catatan</span>
                  <textarea id="fCatatan" rows="4" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                            placeholder="Menu favorit, pantangan, request pedas, dll."></textarea>
                </label>
              </div>

              <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <button onclick="sendToWA()"
                        class="flex-1 rounded-xl bg-accent px-5 py-3 text-sm font-semibold hover:brightness-110 transition">
                  Kirim ke WhatsApp
                </button>
                <a href="{{ request()->url() }}?p=paket"
                   class="flex-1 rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-center hover:bg-white/10 transition">
                  Lihat Paket
                </a>
              </div>

              <p class="mt-4 text-xs text-white/45">
                Form ini tidak menyimpan data. Tombol akan membuka WhatsApp dengan template pesan.
              </p>
            </div>
          </div>
        </div>
      </section>
    @endif
  </main>

  {{-- Footer --}}
  <footer class="border-t border-white/10 bg-coal">
    <div class="mx-auto max-w-7xl px-5 sm:px-8 py-10">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-5">
          <div class="font-display font-semibold text-xl">{{ $site['brand'] }}</div>
          <p class="mt-3 text-sm text-white/65 leading-relaxed max-w-md">
            Catering Indonesia untuk berbagai acara: pernikahan, akikah, arisan, kantor, pengajian, tahlilan, syukuran, dan Ramadhan.
          </p>
          <a class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-accent2 hover:underline underline-offset-4"
             href="{{ $waLink }}">
            Pesan via WhatsApp <span aria-hidden="true">↗</span>
          </a>
        </div>

        <div class="lg:col-span-7 grid sm:grid-cols-3 gap-6">
          <div>
            <div class="tiny text-white/55">Halaman</div>
            <div class="mt-3 grid gap-2 text-sm">
              @foreach($nav as $key => $label)
                <a class="text-white/70 hover:text-white" href="{{ request()->url() }}?p={{ $key }}">{{ $label }}</a>
              @endforeach
            </div>
          </div>
          <div>
            <div class="tiny text-white/55">Layanan</div>
            <div class="mt-3 grid gap-2 text-sm text-white/70">
              <div>Prasmanan</div>
              <div>Nasi Box</div>
              <div>Snack Box / Coffee Break</div>
              <div>Tumpeng</div>
              <div>Live Station (Add-on)</div>
            </div>
          </div>
          <div>
            <div class="tiny text-white/55">Catatan</div>
            <div class="mt-3 text-sm text-white/70 leading-relaxed">
              Harga bisa berubah sesuai lokasi, pax, dan menu. Untuk penawaran final, konsultasi via WhatsApp.
            </div>
          </div>
        </div>
      </div>

      <div class="hairline my-8"></div>
      <div class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-between text-xs text-white/45">
        <div>© {{ date('Y') }} {{ $site['brand'] }} — Demo layout</div>
        <div>Built with Tailwind + AOS (single Blade file)</div>
      </div>
    </div>
  </footer>

  {{-- Floating WA button --}}
  <a href="{{ $waLink }}"
     class="fixed bottom-5 right-5 z-50 rounded-full bg-accent shadow-2xl shadow-black/50 px-5 py-3 text-sm font-semibold hover:brightness-110 transition">
    WhatsApp
  </a>

  {{-- Order Modal (dipakai oleh halaman Menu & Paket) --}}
  <div id="orderModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeOrder()"></div>
    <div class="absolute left-1/2 top-1/2 w-[92vw] max-w-xl -translate-x-1/2 -translate-y-1/2 rounded-3xl border border-white/10 bg-card p-6 sm:p-8">
      <div class="flex items-start justify-between gap-4">
        <div>
          <div class="tiny text-white/55">Pesan cepat</div>
          <div class="font-display font-semibold text-xl mt-1" id="orderTitle">—</div>
          <div class="text-sm text-white/60 mt-1" id="orderPrice">—</div>
        </div>
        <button class="h-10 w-10 rounded-xl border border-white/15 hover:bg-white/5 transition" onclick="closeOrder()" aria-label="Tutup">
          ✕
        </button>
      </div>

      <div class="mt-6 grid gap-4 sm:grid-cols-2">
        <label class="block">
          <span class="text-xs text-white/60">Nama</span>
          <input id="oNama" type="text" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                 placeholder="Nama kamu">
        </label>
        <label class="block">
          <span class="text-xs text-white/60">Perkiraan Pax</span>
          <input id="oPax" type="number" min="1" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                 placeholder="misal: 50">
        </label>
        <label class="block sm:col-span-2">
          <span class="text-xs text-white/60">Tanggal & Lokasi (singkat)</span>
          <input id="oInfo" type="text" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                 placeholder="cth: 12/05, Tebet Jakarta Selatan">
        </label>
        <label class="block sm:col-span-2">
          <span class="text-xs text-white/60">Catatan</span>
          <textarea id="oCatatan" rows="3" class="mt-2 w-full rounded-xl bg-ink/60 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/30 focus:outline-none focus:ring-2 focus:ring-white/15"
                    placeholder="Request menu, pedas, dll."></textarea>
        </label>
      </div>

      <div class="mt-6 flex flex-col sm:flex-row gap-3">
        <button class="flex-1 rounded-xl bg-accent px-5 py-3 text-sm font-semibold hover:brightness-110 transition"
                onclick="sendOrderToWA()">
          Kirim ke WhatsApp
        </button>
        <button class="flex-1 rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold hover:bg-white/10 transition"
                onclick="closeOrder()">
          Nanti dulu
        </button>
      </div>

      <p class="mt-4 text-xs text-white/45">
        *Template WhatsApp akan otomatis berisi item yang dipilih.
      </p>
    </div>
  </div>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-out-cubic',
      offset: 120,
      disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches
    });

    // mobile menu
    const btnMobile = document.getElementById('btnMobile');
    const mobileMenu = document.getElementById('mobileMenu');
    if (btnMobile) {
      btnMobile.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    }

    // modal order
    const orderModal = document.getElementById('orderModal');
    const orderTitle = document.getElementById('orderTitle');
    const orderPrice = document.getElementById('orderPrice');

    let selectedItem = { title: '', price: '' };

    function openOrder(title, price) {
      selectedItem = { title, price };
      orderTitle.textContent = title || '—';
      orderPrice.textContent = price || '';
      orderModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
    function closeOrder() {
      orderModal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    function waLink(text) {
      const number = "{{ $site['wa_number'] }}";
      return `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
    }

    function sendOrderToWA() {
      const nama = document.getElementById('oNama').value.trim();
      const pax = document.getElementById('oPax').value.trim();
      const info = document.getElementById('oInfo').value.trim();
      const catatan = document.getElementById('oCatatan').value.trim();

      const msg =
`Halo {{ $site['brand'] }}, saya mau pesan/cek ketersediaan.

Item: ${selectedItem.title}
Estimasi harga: ${selectedItem.price}

Nama: ${nama || '-'}
Pax: ${pax || '-'}
Tanggal & lokasi: ${info || '-'}
Catatan: ${catatan || '-'}

Tolong info rekomendasi paket & total estimasinya ya. Terima kasih.`;

      window.open(waLink(msg), '_blank');
    }

    function sendToWA() {
      const nama = document.getElementById('fNama').value.trim();
      const hp = document.getElementById('fHp').value.trim();
      const tanggal = document.getElementById('fTanggal').value;
      const pax = document.getElementById('fPax').value.trim();
      const acara = document.getElementById('fAcara').value;
      const preferensi = document.getElementById('fPreferensi').value;
      const lokasi = document.getElementById('fLokasi').value.trim();
      const catatan = document.getElementById('fCatatan').value.trim();

      const msg =
`Halo {{ $site['brand'] }}, saya mau minta penawaran catering.

Nama: ${nama || '-'}
No HP: ${hp || '-'}
Tanggal acara: ${tanggal || '-'}
Jenis acara: ${acara || '-'}
Perkiraan pax: ${pax || '-'}
Preferensi: ${preferensi || '-'}
Lokasi: ${lokasi || '-'}
Catatan: ${catatan || '-'}

Terima kasih.`;

      window.open(waLink(msg), '_blank');
    }
  </script>
</body>
Fugiat suscipit ab e