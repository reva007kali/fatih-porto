<div class="max-w-8xl mx-auto mb-20 p-8 bg-zinc-900 shadow-2xl rounded-3xl border-t-8 border-orange-500 relative text-zinc-100">
    <!-- Header Logo & Alamat -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-orange-500 tracking-tighter">REVA</h1>
        <p class="text-[10px] text-zinc-500 uppercase tracking-widest mt-1">
            Dyah Residence I No D6 Tonjong, Kab. Bogor
        </p>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-white">Form Pemesanan</h2>
        <p class="text-sm text-zinc-400">Jelaskan kebutuhan website Anda secara detail.</p>
    </div>

    <form wire:submit.prevent="submit" class="space-y-5">
        <!-- Data Diri -->
        <div>
            <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">Nama Lengkap</label>
            <input type="text" wire:model="name" placeholder="Contoh: Budi Santoso" 
                class="w-full bg-zinc-800 border-zinc-700 rounded-xl focus:ring-orange-500 focus:border-orange-500 text-white placeholder-zinc-600 text-sm py-3">
            @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">WhatsApp</label>
                <input type="text" wire:model="whatsapp" placeholder="0812..." 
                    class="w-full bg-zinc-800 border-zinc-700 rounded-xl focus:ring-orange-500 focus:border-orange-500 text-white placeholder-zinc-600 text-sm py-3">
                @error('whatsapp') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">Email</label>
                <input type="email" wire:model="email" placeholder="budi@mail.com" 
                    class="w-full bg-zinc-800 border-zinc-700 rounded-xl focus:ring-orange-500 focus:border-orange-500 text-white placeholder-zinc-600 text-sm py-3">
                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Deskripsi Fleksibel -->
        <div>
            <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">Detail Kebutuhan Website</label>
            <textarea wire:model="website_description" rows="4" placeholder="Sebutkan fitur yang diinginkan..." 
                class="w-full bg-zinc-800 border-zinc-700 rounded-xl focus:ring-orange-500 focus:border-orange-500 text-white placeholder-zinc-600 text-sm"></textarea>
            @error('website_description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Input Harga Manual -->
        <div>
            <label class="block text-xs font-bold text-orange-500 uppercase mb-1">Budget / Kesepakatan Harga (Rp)</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500 font-bold">Rp</span>
                <input type="number" wire:model="estimated_price" 
                    class="w-full bg-zinc-800 border-orange-500/30 rounded-xl focus:ring-orange-500 focus:border-orange-500 text-white font-bold text-xl py-4 pl-12">
            </div>
            @error('estimated_price') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Section Included & Info -->
        <div class="bg-zinc-800/50 p-5 rounded-2xl border border-zinc-800 space-y-4">
            <div>
                <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest">Included :</span>
                <ul class="text-[11px] text-zinc-300 mt-2 grid grid-cols-2 gap-y-2 gap-x-4 leading-relaxed">
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Domain .com (1 Thn)
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Hosting Unlimited
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        SSL Security
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Desain Responsive
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Integrasi WA
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Revisi Minor 3x
                    </li>
                </ul>
            </div>
            
            <div class="pt-3 border-t border-zinc-700">
                <span class="text-[10px] font-black text-zinc-400 uppercase italic tracking-wider">Termin Pembayaran:</span>
                <p class="text-[11px] text-zinc-500 mt-1 leading-snug">DP 50% untuk mulai pengerjaan & 50% pelunasan setelah website online/live.</p>
            </div>
        </div>

        <!-- Info Rekening -->
        <div class="text-center p-5 border-2 border-dashed border-zinc-800 rounded-2xl bg-zinc-950/50">
            <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Pembayaran via Bank BCA</p>
            <p class="text-lg font-black text-zinc-200 tracking-wider">0561621828</p>
            <p class="text-[10px] text-orange-500 font-bold uppercase mt-1">Revaldy Adhityawiguna Sahabu</p>
        </div>

        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-orange-900/20 transition duration-300 transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-sm">
            Buat Invoice & Pesan
        </button>
    </form>
</div>