<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Edit Music') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Update track details.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-8 sm:p-10">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Title --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="title"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Title</label>
                            <input wire:model="title" id="title" type="text" placeholder="e.g. Lofi Hip Hop Mix"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all outline-none"
                                required>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                        </div>

                        {{-- Audio Upload --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="audio_file"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Audio
                                File</label>

                            @if ($existing_audio)
                                <div
                                    class="mb-2 p-3 bg-white/5 rounded-lg border border-white/10 flex items-center justify-between">
                                    <span class="text-xs text-white/70 truncate">Current:
                                        {{ basename($existing_audio) }}</span>
                                </div>
                            @endif

                            <div class="relative group">
                                <input wire:model="audio_file" id="audio_file" type="file" accept="audio/*"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-white/10 file:text-white hover:file:bg-white/20 transition-all cursor-pointer">

                                <div wire:loading wire:target="audio_file" class="absolute right-4 top-3">
                                    <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Leave empty to keep existing file.</p>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('audio_file')" />
                        </div>

                        {{-- Cover Image Upload --}}
                        <div class="col-span-1 md:col-span-2">
                            <label for="cover_image"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Cover
                                Image</label>
                            <div class="flex items-start gap-4">
                                <div class="flex-1 relative group">
                                    <input wire:model="cover_image" id="cover_image" type="file" accept="image/*"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-white/10 file:text-white hover:file:bg-white/20 transition-all cursor-pointer">

                                    <div wire:loading wire:target="cover_image" class="absolute right-4 top-3">
                                        <svg class="animate-spin h-5 w-5 text-blue-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                @if ($cover_image)
                                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-white/10 shrink-0">
                                        <img src="{{ $cover_image->temporaryUrl() }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @elseif ($existing_cover)
                                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-white/10 shrink-0">
                                        <img src="{{ asset('storage/' . $existing_cover) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Optional. Leave empty to keep existing.</p>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('cover_image')" />
                        </div>

                        <div>
                            <label for="sort_order"
                                class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Order</label>
                            <input wire:model="sort_order" id="sort_order" type="number" placeholder="0"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('sort_order')" />
                        </div>

                        <div class="flex items-end">
                            <label
                                class="flex items-center cursor-pointer p-3 bg-[#0b0b0d] border border-white/10 rounded-xl w-full">
                                <input type="checkbox" wire:model="is_active"
                                    class="form-checkbox h-5 w-5 text-blue-500 rounded border-gray-600 bg-[#1c1c1e] focus:ring-blue-500">
                                <span class="ml-3 text-sm font-bold text-gray-300">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-white/5 mt-8">
                        <a href="{{ route('admin.music.index') }}"
                            class="px-6 py-3 bg-white/5 text-gray-400 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-white/10 hover:text-white transition-all">
                            Cancel
                        </a>
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-8 py-3 bg-white text-black rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                            Update Music
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
