<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Footer Settings') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Manage the content of your website footer.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-6 sm:p-10">
                <form wire:submit.prevent="save" class="space-y-8">

                    {{-- About Section --}}
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Footer Content</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="about_text"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Tagline
                                    / About Text</label>
                                <textarea wire:model="about_text" id="about_text" rows="3"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('about_text')" />
                            </div>
                            <div>
                                <label for="availability_text"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Availability
                                    Text</label>
                                <input wire:model="availability_text" id="availability_text" type="text"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('availability_text')" />
                            </div>
                        </div>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Email
                                    Address</label>
                                <input wire:model="email" id="email" type="email"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <label for="phone"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Phone
                                    Number</label>
                                <input wire:model="phone" id="phone" type="text"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('phone')" />
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Bar --}}
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Bottom Bar & Watermark</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="copyright_text"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Copyright
                                    Text</label>
                                <input wire:model="copyright_text" id="copyright_text" type="text"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('copyright_text')" />
                            </div>
                            <div>
                                <label for="watermark_text"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Large
                                    Watermark Text</label>
                                <input wire:model="watermark_text" id="watermark_text" type="text"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('watermark_text')" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" wire:loading.attr="disabled"
                            class="px-8 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
