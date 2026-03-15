<div x-data="{ open: false }" class="relative">

    {{-- Toggle Button --}}
    <button
        @click="open = !open"
        class="group relative w-full flex items-center justify-between px-8 py-6 rounded-2xl border border-white/10 bg-white/[0.03] hover:bg-white/[0.05] hover:border-cyan-400/25 transition-all duration-300 active:scale-[0.99]"
    >
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300 group-hover:border-cyan-400/30"
                style="background: rgba(103,232,249,0.07); border: 1px solid rgba(103,232,249,0.14);">
                <svg class="w-3.5 h-3.5 transition-transform duration-500" :class="open ? 'rotate-45' : ''"
                    style="color: rgba(103,232,249,0.7);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div class="text-left">
                <h3 class="text-base font-bold tracking-tight text-white/70 group-hover:text-white transition-colors duration-300">
                    Share Your Story
                </h3>
                <p class="text-[10px] font-medium text-white/25 uppercase tracking-[0.25em]">Leave a testimonial</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <span class="relative flex h-1.5 w-1.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-400"></span>
            </span>
            <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-emerald-400/70">Open</span>
        </div>
    </button>

    {{-- Form --}}
    <div
        x-show="open"
        x-collapse
        x-cloak
        class="mt-3 rounded-2xl border border-white/[0.07] overflow-hidden"
        style="background: rgba(255,255,255,0.02);"
    >
        <div class="p-8 md:p-12">

            {{-- Success message --}}
            @if (session()->has('message'))
            <div class="flex items-center gap-3 px-5 py-4 rounded-xl mb-10 text-sm font-semibold text-emerald-400"
                style="background: rgba(52,211,153,0.08); border: 1px solid rgba(52,211,153,0.2);">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('message') }}
            </div>
            @endif

            <form wire:submit.prevent="submit" class="space-y-8">

                {{-- Name + Position row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Name --}}
                    <div class="space-y-2">
                        <label class="block text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">
                            01 · Full Name
                        </label>
                        <input wire:model="name" type="text" placeholder="Your name"
                            class="w-full px-4 py-3.5 rounded-xl text-sm font-light text-white placeholder-white/20 focus:outline-none transition-all duration-300 border"
                            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.07);"
                            onfocus="this.style.borderColor='rgba(103,232,249,0.25)'; this.style.background='rgba(103,232,249,0.03)';"
                            onblur="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='rgba(255,255,255,0.04)';">
                        @error('name')
                        <span class="text-red-400 text-[10px] font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Position --}}
                    <div class="space-y-2">
                        <label class="block text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">
                            02 · Position / Company
                        </label>
                        <input wire:model="position" type="text" placeholder="Your role"
                            class="w-full px-4 py-3.5 rounded-xl text-sm font-light text-white placeholder-white/20 focus:outline-none transition-all duration-300 border"
                            style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.07);"
                            onfocus="this.style.borderColor='rgba(103,232,249,0.25)'; this.style.background='rgba(103,232,249,0.03)';"
                            onblur="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='rgba(255,255,255,0.04)';">
                        @error('position')
                        <span class="text-red-400 text-[10px] font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Rating --}}
                <div class="space-y-3">
                    <label class="block text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">
                        03 · Overall Rating
                    </label>
                    <div class="flex items-center gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})"
                            class="w-11 h-11 rounded-xl flex items-center justify-center text-sm font-bold border transition-all duration-200 active:scale-95"
                            style="{{ $rating >= $i
                                ? 'background: linear-gradient(135deg, rgba(103,232,249,0.2), rgba(129,140,248,0.15)); border-color: rgba(103,232,249,0.4); color: #67e8f9; box-shadow: 0 0 16px rgba(103,232,249,0.15);'
                                : 'background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.08); color: rgba(255,255,255,0.25);' }}">
                            {{ $i }}
                        </button>
                        @endfor
                        @if ($rating > 0)
                        <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-white/25 ml-2">
                            {{ ['', 'Poor', 'Fair', 'Good', 'Great', 'Excellent'][$rating] ?? '' }}
                        </span>
                        @endif
                    </div>
                    @error('rating')
                    <span class="text-red-400 text-[10px] font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="space-y-2">
                    <label class="block text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">
                        04 · Your Feedback
                    </label>
                    <textarea wire:model="content" rows="5" placeholder="Describe your experience working together…"
                        class="w-full px-4 py-4 rounded-xl text-sm font-light text-white placeholder-white/20 focus:outline-none transition-all duration-300 resize-none leading-relaxed border"
                        style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.07);"
                        onfocus="this.style.borderColor='rgba(103,232,249,0.25)'; this.style.background='rgba(103,232,249,0.03)';"
                        onblur="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='rgba(255,255,255,0.04)';"></textarea>
                    @error('content')
                    <span class="text-red-400 text-[10px] font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Photo upload --}}
                <div class="space-y-2">
                    <label class="block text-[9px] font-bold uppercase tracking-[0.4em] text-white/25">
                        05 · Profile Photo <span class="text-white/15 normal-case tracking-normal">Optional</span>
                    </label>
                    <label class="relative flex items-center justify-center w-full h-36 rounded-xl cursor-pointer border border-dashed transition-all duration-300 hover:border-cyan-400/30 hover:bg-cyan-400/[0.02]"
                        style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.08);">
                        @if ($avatar)
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.2);">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-emerald-400/70">Image Loaded</span>
                        </div>
                        @else
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                style="background: rgba(103,232,249,0.06); border: 1px solid rgba(103,232,249,0.12);">
                                <svg class="w-4 h-4" style="color: rgba(103,232,249,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 16v-4m0 0V8m0 4H8m4 0h4M20 7l-3-3H7L4 7v13h16V7z"/>
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-white/25">Click to upload</span>
                            <span class="text-[9px] text-white/15">PNG, JPG up to 2MB</span>
                        </div>
                        @endif
                        <input wire:model="avatar" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </label>
                    @error('avatar')
                    <span class="text-red-400 text-[10px] font-bold uppercase tracking-widest mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Divider --}}
                <div class="w-full h-px" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);"></div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-4 rounded-2xl font-bold text-[11px] uppercase tracking-[0.2em] transition-all duration-300 active:scale-[0.99]"
                    style="background: linear-gradient(135deg, #67e8f9, #818cf8); color: #050507; box-shadow: 0 8px 32px rgba(103,232,249,0.2);"
                    onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 12px 40px rgba(103,232,249,0.3)';"
                    onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(103,232,249,0.2)';">
                    Submit Testimonial
                </button>

                <p class="text-center text-[9px] text-white/15 font-medium uppercase tracking-[0.3em]">
                    Verified Submission · © 2026
                </p>

            </form>
        </div>
    </div>

</div>