<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Manage Pricing Plans') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Configure your product pricing and packages.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form Section --}}
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20 sticky top-6">
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-white mb-1">
                            {{ $isEditing ? 'Edit Plan' : 'Add New Plan' }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-6">Plan details.</p>

                        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="space-y-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Plan Name</label>
                                <input wire:model="name" id="name" type="text" placeholder="e.g. Basic"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    required>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label for="price" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Price</label>
                                <input wire:model="price" id="price" type="text" placeholder="e.g. $99"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    required>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Description</label>
                                <textarea wire:model="description" id="description" rows="3"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <label for="featuresInput" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Features (Comma separated)</label>
                                <input wire:model="featuresInput" id="featuresInput" type="text" placeholder="Feature 1, Feature 2"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('featuresInput')" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Plan Image (Optional)</label>
                                <div class="flex items-center gap-4">
                                    @if ($image)
                                        <div class="w-16 h-16 rounded-xl border border-white/10 overflow-hidden bg-black flex-shrink-0">
                                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        </div>
                                    @elseif ($isEditing && $planId && \App\Models\PricingPlan::find($planId)->image)
                                        <div class="w-16 h-16 rounded-xl border border-white/10 overflow-hidden bg-black flex-shrink-0">
                                            <img src="{{ asset('storage/' . \App\Models\PricingPlan::find($planId)->image) }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    
                                    <label class="flex-1 cursor-pointer">
                                        <div class="w-full bg-[#0b0b0d] border border-dashed border-white/10 rounded-xl px-4 py-3 text-center hover:bg-white/5 transition-colors">
                                            <span class="text-xs text-gray-400">Upload Image</span>
                                            <input type="file" wire:model="image" class="hidden" accept="image/*">
                                        </div>
                                    </label>
                                </div>
                                <div wire:loading wire:target="image" class="text-xs text-swiss-blue mt-2 font-bold">Uploading...</div>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('image')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="cta_text" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Text</label>
                                    <input wire:model="cta_text" id="cta_text" type="text" placeholder="Get Started"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('cta_text')" />
                                </div>
                                <div>
                                    <label for="cta_link" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Link</label>
                                    <input wire:model="cta_link" id="cta_link" type="text" placeholder="#"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('cta_link')" />
                                </div>
                            </div>

                            <div class="pt-4 flex items-center gap-3">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="flex-1 bg-white text-black py-3 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                                    {{ $isEditing ? 'Update Plan' : 'Add Plan' }}
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
                                    <th class="px-6 py-4">Name</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Features</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($plans as $plan)
                                    <tr class="hover:bg-white/[0.02] transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-white text-sm">{{ $plan->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($plan->description, 30) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-swiss-blue text-sm">{{ $plan->price }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($plan->features ?? [] as $feature)
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/5 text-gray-400 border border-white/5">{{ $feature }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button wire:click="edit({{ $plan->id }})" 
                                                    class="p-2 rounded-lg bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button wire:click="delete({{ $plan->id }})" wire:confirm="Are you sure?"
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
