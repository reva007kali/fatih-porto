<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Hero Settings') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Manage your website's first impression and main call-to-action.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-6 sm:p-10">
                <form wire:submit.prevent="save" class="space-y-10">

                    {{-- Text Content Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Text Content</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">This information will be displayed
                                prominently at the top of your page. Make it catchy and clear.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div>
                                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Hero Title</label>
                                <input wire:model="title" id="title" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    placeholder="Enter a catchy headline...">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <label for="subtitle" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Hero Subtitle</label>
                                <textarea wire:model="subtitle" id="subtitle" rows="4"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                    placeholder="Briefly describe what you do..."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('subtitle')" />
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Visual Assets Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Visual Assets</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Upload a high-resolution background
                                image to make your hero section stand out.</p>
                        </div>

                        <div class="col-span-2">
                            <div
                                class="group relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:border-swiss-blue/50 hover:bg-white/[0.02]">
                                @if ($image)
                                    <div class="relative aspect-video mb-4 overflow-hidden rounded-xl border border-white/10 bg-black">
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="text-white text-xs font-bold uppercase tracking-wider">New Preview</span>
                                        </div>
                                    </div>
                                @elseif ($currentImage)
                                    <div class="relative aspect-video mb-4 overflow-hidden rounded-xl border border-white/10 bg-black">
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-full h-full object-cover">
                                    </div>
                                @endif

                                <div class="flex items-center justify-center w-full">
                                    <label class="w-full flex flex-col items-center cursor-pointer">
                                        <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mb-3 group-hover:bg-swiss-blue/20 transition-colors">
                                            <svg class="w-6 h-6 text-gray-400 group-hover:text-swiss-blue transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-300">Click to upload or drag and drop</span>
                                        <span class="text-xs text-gray-500 mt-1">PNG, JPG up to 5MB</span>
                                        <input type="file" wire:model="image" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                                
                                {{-- Loading State --}}
                                <div wire:loading wire:target="image"
                                    class="absolute inset-0 bg-[#1c1c1e]/90 flex flex-col items-center justify-center rounded-2xl z-10 backdrop-blur-sm">
                                    <div class="w-8 h-8 border-2 border-swiss-blue border-t-transparent rounded-full animate-spin mb-2"></div>
                                    <span class="text-xs font-bold text-swiss-blue uppercase tracking-wider">Uploading...</span>
                                </div>
                            </div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('image')" />
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Call to Action Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Call to Action</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Direct your visitors to a specific
                                page or action (e.g., "Contact Me" or "View Projects").</p>
                        </div>

                        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="cta_text" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Text</label>
                                <input wire:model="cta_text" id="cta_text" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    placeholder="e.g. Get Started">
                            </div>
                            <div>
                                <label for="cta_link" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Link</label>
                                <input wire:model="cta_link" id="cta_link" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    placeholder="https://...">
                            </div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-between pt-6 border-t border-white/5">
                        <div class="flex items-center">
                            @if (session()->has('message'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                                    class="flex items-center px-4 py-2 rounded-lg bg-green-500/10 text-green-500 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" wire:loading.attr="disabled"
                            class="px-8 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
