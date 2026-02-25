<div class="max-w-6xl mx-auto mt-10 p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Pesanan</h2>
            <p class="text-zinc-400 text-sm">Kelola semua invoice yang telah digenerate.</p>
        </div>
        
        <!-- Input Pencarian -->
        <div class="relative w-64">
            <input wire:model.live="search" type="text" placeholder="Cari Nama / Invoice..." 
                class="w-full bg-zinc-900 border-zinc-800 rounded-xl text-white text-sm focus:ring-orange-500 focus:border-orange-500">
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500/10 border border-green-500/50 text-green-500 rounded-xl text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-zinc-900 border border-zinc-800 rounded-3xl overflow-hidden shadow-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-zinc-800/50 text-zinc-400 uppercase text-[10px] font-black tracking-widest">
                    <th class="px-6 py-4">Tgl Order</th>
                    <th class="px-6 py-4">Invoice</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Total Harga</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-800 text-sm text-zinc-300">
                @forelse($orders as $order)
                <tr class="hover:bg-zinc-800/30 transition">
                    <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 font-mono text-orange-500">{{ $order->invoice_number }}</td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-white">{{ $order->name }}</div>
                        <div class="text-xs text-zinc-500">{{ $order->whatsapp }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-white">
                        Rp {{ number_format($order->total_price) }}
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <!-- Tombol Lihat Invoice -->
                        <a href="{{ route('invoice', $order->id) }}" target="_blank" 
                            class="inline-flex items-center px-3 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 rounded-lg transition text-xs font-bold">
                            👁️ Lihat
                        </a>
                        
                        <!-- Tombol Hapus -->
                        <button wire:click="deleteOrder({{ $order->id }})" 
                            wire:confirm="Yakin ingin menghapus data ini?"
                            class="inline-flex items-center px-3 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 rounded-lg transition text-xs font-bold">
                            🗑️ Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-zinc-500">
                        Belum ada pesanan yang masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
