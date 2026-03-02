<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('AI Assistant Settings') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Configure your AI assistant's persona, behavior, and parameters.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-6 sm:p-10">
                <form wire:submit.prevent="save" class="space-y-10">
                    
                    {{-- General Settings --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Identity</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Basic identity and visibility settings for the AI.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="assistant_name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Assistant Name</label>
                                    <input wire:model="assistant_name" id="assistant_name" type="text" 
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                        placeholder="e.g. Reva AI">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('assistant_name')" />
                                </div>
                                <div>
                                    <label for="model" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">AI Model</label>
                                    <select wire:model="model" id="model"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                        @foreach($available_models as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('model')" />
                                </div>
                                <div>
                                    <label for="is_active" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Status</label>
                                    <div class="flex items-center h-[46px]">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" wire:model="is_active" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-swiss-blue rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-swiss-blue"></div>
                                            <span class="ml-3 text-sm font-medium text-white">{{ $is_active ? 'Active' : 'Inactive' }}</span>
                                        </label>
                                    </div>
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('is_active')" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Behavior & Prompt --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Behavior & Intelligence</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Define how the AI thinks, responds, and interacts with users.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div>
                                <label for="system_prompt" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">System Prompt (Core Instructions)</label>
                                <p class="text-xs text-gray-600 mb-3">This is the most critical setting. It defines the AI's role, knowledge boundaries, and personality.</p>
                                <textarea wire:model="system_prompt" id="system_prompt" rows="12"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white font-mono text-sm placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-y"
                                    placeholder="You are a helpful assistant..."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('system_prompt')" />
                            </div>

                            <div>
                                <label for="behavior_description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Behavior Description (Internal Note)</label>
                                <textarea wire:model="behavior_description" id="behavior_description" rows="3"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                    placeholder="Briefly describe the intended persona (e.g., 'Professional, witty, focuses on React development')."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('behavior_description')" />
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Parameters --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Model Parameters</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Fine-tune the creativity and response length.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="temperature" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Temperature (Creativity)</label>
                                    <div class="flex items-center gap-4">
                                        <input wire:model="temperature" id="temperature" type="range" min="0" max="2" step="0.1"
                                            class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer">
                                        <span class="text-sm font-mono text-swiss-blue w-12 text-right">{{ $temperature }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">Lower values (0.2) make output more focused and deterministic. Higher values (0.8+) make it more random and creative.</p>
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('temperature')" />
                                </div>
                                <div>
                                    <label for="max_tokens" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Max Tokens</label>
                                    <input wire:model="max_tokens" id="max_tokens" type="number" 
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                    <p class="text-xs text-gray-600 mt-2">Maximum length of the generated response.</p>
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('max_tokens')" />
                                </div>
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
                            <span wire:loading.remove>Save Configuration</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
