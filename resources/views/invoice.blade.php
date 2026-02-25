<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->invoice_number }}</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        @media print {
            .no-print { display: none; }
            body { background: white !important; padding: 0; }
            .invoice-card { border: none !important; shadow: none !important; margin: 0 !important; width: 100% !important; }
        }
    </style>
</head>
<body class="bg-zinc-950 py-12 px-4 antialiased">
    <!-- Tombol Kembali/Cetak (Hanya Muncul di Layar) -->
    <div class="max-w-3xl mx-auto mb-6 flex justify-between items-center no-print">
        <a href="{{ route('admin.orders.index') }}" class="text-zinc-400 hover:text-orange-500 flex items-center gap-2 text-sm transition">
            ← Kembali ke Daftar
        </a>
        <button onclick="window.print()" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full text-xs font-bold shadow-lg shadow-orange-500/20 transition">
            Cetak Invoice
        </button>
    </div>

    <div class="invoice-card max-w-3xl mx-auto bg-white shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden relative">
        
        <!-- Header Strip Orange -->
        <div class="h-2 bg-orange-500 w-full"></div>

        <div class="p-12">
            <!-- Top Section: Branding & Info -->
            <div class="flex justify-between items-start mb-16">
                <div>
                    <h1 class="text-5xl font-black text-zinc-900 tracking-tighter mb-2">REVA<span class="text-orange-500">.</span></h1>
                    <div class="text-[10px] text-zinc-400 leading-relaxed uppercase tracking-[0.2em] font-semibold">
                        Dyah Residence I No D6 Tonjong,<br>
                        Kabupaten Bogor, Jawa Barat 16320
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="text-xs font-black text-orange-500 uppercase tracking-widest mb-1">Status Penagihan</h2>
                    <div class="inline-block bg-orange-100 text-orange-600 px-3 py-1 rounded text-[10px] font-bold uppercase mb-4">
                        Menunggu Pembayaran
                    </div>
                    <p class="text-[10px] text-zinc-400 uppercase tracking-widest font-bold">Nomor Invoice</p>
                    <p class="text-lg font-bold text-zinc-900 leading-none">#{{ $order->invoice_number }}</p>
                </div>
            </div>

            <!-- Client & Date Info -->
            <div class="grid grid-cols-2 gap-12 mb-16 pb-12 border-b border-zinc-100">
                <div>
                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-3">Ditujukan Kepada:</h3>
                    <p class="text-xl font-bold text-zinc-900">{{ $order->name }}</p>
                    <div class="text-sm text-zinc-500 space-y-1 mt-1 font-medium">
                        <p>{{ $order->whatsapp }}</p>
                        <p>{{ $order->email }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-3">Tanggal Terbit:</h3>
                    <p class="text-sm font-bold text-zinc-900">{{ $order->created_at->format('d F, Y') }}</p>
                    <p class="text-xs text-zinc-400 mt-1 italic">Berlaku selama 7 hari sejak diterbitkan.</p>
                </div>
            </div>

            <!-- Table Section -->
            <table class="w-full mb-10">
                <thead>
                    <tr class="text-left">
                        <th class="pb-6 text-[10px] font-black text-zinc-400 uppercase tracking-widest">Deskripsi Layanan</th>
                        <th class="pb-6 text-right text-[10px] font-black text-zinc-400 uppercase tracking-widest">Harga Satuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    <tr>
                        <td class="py-8 pr-10">
                            <p class="font-bold text-zinc-900 text-lg mb-2">Pengembangan Website (Custom)</p>
                            <p class="text-sm text-zinc-500 leading-relaxed mb-4 italic">"{{ $order->description }}"</p>
                            <div class="flex flex-wrap gap-4">
                                <span class="flex items-center gap-1.5 text-[9px] font-bold text-orange-600 uppercase bg-orange-50 px-2 py-1 rounded">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293l-9 9-4.707-4.707-1.414 1.414 6.121 6.121 10.414-10.414-1.414-1.414z"></path></svg>
                                    Domain & Hosting
                                </span>
                                <span class="flex items-center gap-1.5 text-[9px] font-bold text-orange-600 uppercase bg-orange-50 px-2 py-1 rounded">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293l-9 9-4.707-4.707-1.414 1.414 6.121 6.121 10.414-10.414-1.414-1.414z"></path></svg>
                                    SSL Certificate
                                </span>
                                <span class="flex items-center gap-1.5 text-[9px] font-bold text-orange-600 uppercase bg-orange-50 px-2 py-1 rounded">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293l-9 9-4.707-4.707-1.414 1.414 6.121 6.121 10.414-10.414-1.414-1.414z"></path></svg>
                                    3x Revisi Minor
                                </span>
                            </div>
                        </td>
                        <td class="py-8 text-right align-top">
                            <p class="text-lg font-bold text-zinc-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Summary & Payment Info -->
            <div class="grid grid-cols-2 gap-12 items-end pt-10 border-t-2 border-zinc-100">
                <div>
                    <div class="bg-zinc-50 p-6 rounded-2xl border border-zinc-100">
                        <h4 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-4">Metode Pembayaran (Transfer Bank):</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-[10px] text-zinc-400 uppercase font-bold">Nama Bank</p>
                                <p class="text-sm font-bold text-zinc-800 tracking-tight">BANK BCA (Bank Central Asia)</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-zinc-400 uppercase font-bold">Nomor Rekening</p>
                                <p class="text-lg font-black text-orange-500 tracking-widest">0561621828</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-zinc-400 uppercase font-bold">Atas Nama</p>
                                <p class="text-sm font-bold text-zinc-800">REVALDY ADHITYAWIGUNA SAHABU</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-sm font-medium text-zinc-500 px-2">
                        <span>DP Pembayaran (50%)</span>
                        <span>Rp {{ number_format($order->total_price / 2, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-medium text-zinc-500 px-2">
                        <span>Pelunasan (50%)</span>
                        <span>Rp {{ number_format($order->total_price / 2, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center bg-zinc-900 text-white p-5 rounded-2xl shadow-xl shadow-zinc-200">
                        <span class="text-xs font-bold uppercase tracking-widest">Total Tagihan</span>
                        <span class="text-2xl font-black text-orange-500">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-20 text-center">
                <p class="text-sm font-bold text-zinc-900 mb-1">Terima Kasih Atas Kerjasamanya!</p>
                <p class="text-[10px] text-zinc-400 leading-relaxed">
                    Pekerjaan akan dimulai segera setelah DP 50% diterima.<br>
                    Invoice ini sah dan dihasilkan secara otomatis oleh sistem REVA.
                </p>
            </div>
        </div>

        <!-- Decorative Footer Box -->
        <div class="bg-zinc-50 py-4 text-center border-t border-zinc-100">
            <p class="text-[9px] font-bold text-zinc-400 uppercase tracking-[0.3em]">Professional Web Developer & Digital Solution</p>
        </div>
    </div>
    
    <p class="text-center text-zinc-600 text-[10px] mt-8 no-print uppercase tracking-widest">© {{ date('Y') }} REVALDY ADHITYAWIGUNA SAHABU. All Rights Reserved.</p>
</body>
</html>