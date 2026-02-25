<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->invoice_number }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black/90 py-10 antialiased">
    <div class="max-w-2xl mx-auto p-10 border bg-white border-gray-600 shadow-sm relative  overflow-hidden">
        <!-- Watermark/Aksen -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 -mr-16 -mt-16 rotate-45"></div>

        <div class="flex justify-between items-start mb-12">
            <div>
                <h1 class="text-4xl font-black text-orange-500 tracking-tighter">REVA</h1>
                <div class="text-[11px] text-gray-400 mt-2 leading-relaxed uppercase tracking-widest">
                    Dyah Residence I No D6 Tonjong,<br>
                    Kabupaten Bogor, Jawa Barat
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-2xl font-light text-gray-400 uppercase tracking-widest">Invoice</h2>
                <p class="text-lg font-bold text-gray-800">#{{ $order->invoice_number }}</p>
                <p class="text-xs text-gray-500">{{ $order->created_at->format('d F Y') }}</p>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-xs font-black text-orange-500 uppercase tracking-widest mb-2">Klien:</h3>
            <p class="text-lg font-bold text-gray-800">{{ $order->name }}</p>
            <p class="text-sm text-gray-600">{{ $order->whatsapp }} / {{ $order->email }}</p>
        </div>

        <table class="w-full mb-10">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase">Deskripsi Pekerjaan</th>
                    <th class="py-3 px-4 text-right text-xs font-bold text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="py-6 px-4">
                        <p class="font-bold text-gray-800 mb-1">Pengembangan Website (Custom Request)</p>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $order->description }}</p>
                        <ul class="mt-2 text-[10px] text-orange-500 font-bold flex gap-4 uppercase">
                            <li>• Incl. Domain & Hosting</li>
                            <li>• Incl. SSL Security</li>
                            <li>• Max 3x Revisions</li>
                        </ul>
                    </td>
                    <td class="py-6 px-4 text-right align-top font-bold text-gray-800">
                        Rp {{ number_format($order->total_price) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Termin Detail -->
        <div class="grid grid-cols-2 gap-10 mb-10">
            <div class="bg-orange-50 p-4 rounded-xl border border-orange-100">
                <h4 class="text-[10px] font-black text-orange-600 uppercase mb-2">Termin Pembayaran:</h4>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-600">DP (50%)</span>
                    <span class="font-bold text-gray-800">Rp {{ number_format($order->total_price / 2) }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Pelunasan (50%)</span>
                    <span class="font-bold text-gray-800">Rp {{ number_format($order->total_price / 2) }}</span>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase">Total yang dibayarkan:</p>
                <p class="text-3xl font-black text-orange-500">Rp {{ number_format($order->total_price) }}</p>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8 flex justify-between items-end">
            <div class="text-[11px] text-gray-400 leading-relaxed">
                <p class="font-bold text-gray-600 uppercase mb-1 underline">Informasi Transfer:</p>
                <p>Bank BCA - 0561621828</p>
                <p>A/N Revaldy Adhityawiguna Sahabu</p>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="bg-gray-900 text-white px-8 py-3 rounded-full text-xs font-bold hover:bg-black transition">Cetak Invoice</button>
            </div>
        </div>
    </div>
</body>
</html>