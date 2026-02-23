<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Social Links') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Manage your social media profiles.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form Section --}}
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20 sticky top-6">
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-white mb-1">
                            {{ $isEditing ? 'Edit Social Link' : 'Add New Link' }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-6">Profile details.</p>

                        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-5">
                            <div>
                                <label for="platform" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Platform Name</label>
                                <input wire:model="platform" id="platform" type="text" placeholder="e.g. Instagram"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    required>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('platform')" />
                            </div>

                            <div>
                                <label for="url" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">URL</label>
                                <input wire:model="url" id="url" type="url" placeholder="https://..."
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    required>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('url')" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Icon</label>
                                <div class="flex items-center gap-4">
                                    @if ($icon)
                                        <div class="w-12 h-12 rounded-lg border border-white/10 overflow-hidden bg-white flex-shrink-0 flex items-center justify-center p-2">
                                            <img src="{{ $icon->temporaryUrl() }}" class="w-full h-full object-contain">
                                        </div>
                                    @elseif ($currentIcon)
                                        <div class="w-12 h-12 rounded-lg border border-white/10 overflow-hidden bg-white flex-shrink-0 flex items-center justify-center p-2">
                                            <img src="{{ asset('storage/' . $currentIcon) }}" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-lg border border-white/10 bg-[#0b0b0d] flex items-center justify-center flex-shrink-0">
                                            <span class="text-[10px] text-gray-500">No Icon</span>
                                        </div>
                                    @endif
                                    
                                    <label class="flex-1 cursor-pointer">
                                        <div class="w-full bg-[#0b0b0d] border border-dashed border-white/10 rounded-xl px-4 py-3 text-center hover:bg-white/5 transition-colors">
                                            <span class="text-xs text-gray-400">Upload Icon</span>
                                            <input type="file" wire:model="icon" class="hidden" accept="image/*">
                                        </div>
                                    </label>
                                </div>
                                <div wire:loading wire:target="icon" class="text-xs text-swiss-blue mt-2 font-bold">Uploading...</div>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('icon')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="sort_order" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Sort Order</label>
                                    <input wire:model="sort_order" id="sort_order" type="number" placeholder="0"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('sort_order')" />
                                </div>
                                <div class="flex items-end pb-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model="is_active" class="form-checkbox h-5 w-5 text-swiss-blue rounded border-gray-600 bg-[#0b0b0d] focus:ring-swiss-blue transition duration-150 ease-in-out">
                                        <span class="ml-2 text-sm text-white font-medium">Active</span>
                                    </label>
                                </div>
                            </div>

                            <div class="pt-4 flex items-center gap-3">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="flex-1 bg-white text-black py-3 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                                    {{ $isEditing ? 'Update Link' : 'Add Link' }}
                                </button>
                                @if ($isEditing)
                                    <button type="button" wire:click="cancel"
                                        class="px-4 py-3 bg-white/5 text-gray-400 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-white/10 hover:text-white transition-all">
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- List Section --}}
            <div class="lg:col-span-2 order-1 lg:order-2">
                <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
                    @if (session()->has('message'))
                        <div class="p-4 bg-green-500/10 border-b border-green-500/20 text-green-500 text-sm font-bold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-xs font-bold uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-6 py-4">Sort</th>
                                    <th class="px-6 py-4">Platform</th>
                                    <th class="px-6 py-4">URL</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($socialLinks as $link)
                                    <tr class="hover:bg-white/[0.02] transition-colors group">
                                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $link->sort_order }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-white flex items-center justify-center p-1">
                                                    @if ($link->icon)
                                                        <img src="{{ asset('storage/' . $link->icon) }}" class="w-full h-full object-contain">
                                                    @else
                                                        <span class="text-[10px] text-gray-400">NA</span>
                                                    @endif
                                                </div>
                                                <span class="font-bold text-white text-sm">{{ $link->platform }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ $link->url }}" target="_blank" class="text-xs text-swiss-blue hover:text-white transition-colors truncate block max-w-[150px]">
                                                {{ Str::limit($link->url, 30) }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button wire:click="toggleActive({{ $link->id }})" 
                                                class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider transition-colors
                                                {{ $link->is_active ? 'bg-green-500/10 text-green-500 hover:bg-green-500/20' : 'bg-red-500/10 text-red-500 hover:bg-red-500/20' }}">
                                                {{ $link->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button wire:click="edit({{ $link->id }})" 
                                                    class="p-2 rounded-lg bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button wire:click="delete({{ $link->id }})" wire:confirm="Are you sure?"
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            No social links found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
