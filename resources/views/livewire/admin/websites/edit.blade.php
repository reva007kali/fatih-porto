<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Edit Website') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Update website details.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-8 sm:p-10">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Title</label>
                            <input wire:model.live="title" id="title" type="text" 
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                required>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Slug</label>
                            <input wire:model="slug" id="slug" type="text" readonly
                                class="w-full bg-[#0b0b0d]/50 border border-white/5 rounded-xl px-4 py-3 text-gray-400 cursor-not-allowed">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('slug')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Description</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"></textarea>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <label for="tags" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Tags</label>
                            <input wire:model="tags" id="tags" type="text" placeholder="Comma separated"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('tags')" />
                        </div>
                        <div>
                            <label for="color" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Theme Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" wire:model="color" class="h-10 w-10 rounded-lg border border-white/10 cursor-pointer bg-[#0b0b0d] p-1">
                                <input wire:model="color" id="color" type="text"
                                    class="flex-1 bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-2 text-white placeholder-gray-600 focus:border-swiss-blue outline-none text-sm">
                            </div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('color')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Cover Image</label>
                            <div class="flex items-center gap-4">
                                @if ($image)
                                    <div class="w-20 h-20 rounded-xl border border-white/10 overflow-hidden bg-black flex-shrink-0">
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                    </div>
                                @elseif ($currentImage)
                                    <div class="w-20 h-20 rounded-xl border border-white/10 overflow-hidden bg-black flex-shrink-0">
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                
                                <label class="flex-1 cursor-pointer">
                                    <div class="w-full bg-[#0b0b0d] border border-dashed border-white/10 rounded-xl px-4 py-3 text-center hover:bg-white/5 transition-colors">
                                        <span class="text-xs text-gray-400">Upload Cover</span>
                                        <input type="file" wire:model="image" class="hidden" accept="image/*">
                                    </div>
                                </label>
                            </div>
                            <div wire:loading wire:target="image" class="text-xs text-swiss-blue mt-2 font-bold">Uploading...</div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('image')" />
                        </div>

                        <div class="col-span-1 md:col-span-2" wire:ignore>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500">Website Content (HTML/Blade)</label>
                                <button type="button" wire:click="openInEditor('{{ $slug }}')" class="text-xs text-swiss-blue hover:text-white transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    Open in Local Editor
                                </button>
                            </div>
                            
                            {{-- AI Generator --}}
                            <div class="mb-4 p-4 bg-white/5 rounded-xl border border-white/10">
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-2">AI Generator</label>
                                <div class="flex gap-2">
                                    <input wire:model="aiPrompt" type="text" placeholder="Describe the section you want to generate (e.g. 'A hero section with a blue gradient background...')" 
                                        class="flex-1 bg-[#0b0b0d] border border-white/10 rounded-lg px-4 py-2 text-white text-xs focus:border-swiss-blue outline-none placeholder-gray-600">
                                    <button type="button" @click="$dispatch('start-ai-generation')" wire:loading.attr="disabled"
                                        class="px-4 py-2 bg-swiss-blue text-white rounded-lg text-xs font-bold uppercase hover:bg-blue-600 transition-all flex items-center gap-2 whitespace-nowrap">
                                        <span wire:loading.remove wire:target="generateWebsiteContent">Generate</span>
                                        <span wire:loading wire:target="generateWebsiteContent">Thinking...</span>
                                    </button>
                                </div>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('aiPrompt')" />
                            </div>

                            {{-- Ace Editor --}}
                            <div
                                x-data="{
                                    initAce() {
                                        if (window.ace) {
                                            this.loadEditor();
                                        } else {
                                            const script = document.createElement('script');
                                            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ace.js';
                                            script.onload = () => {
                                                this.loadEditor();
                                            };
                                            document.head.appendChild(script);
                                        }
                                    },
                                    loadEditor() {
                                        this.editor = ace.edit(this.$refs.aceContainer);
                                        this.editor.setTheme('ace/theme/twilight');
                                        this.editor.session.setMode('ace/mode/html');
                                        
                                        // Ensure we get the initial value correctly, even if deferred
                                        let initialValue = $wire.get('content') || '';
                                        this.editor.setValue(initialValue, -1);
                                        
                                        this.editor.setOptions({
                                            fontSize: '14px',
                                            fontFamily: 'JetBrains Mono, monospace',
                                            showPrintMargin: false,
                                            wrap: true
                                        });

                                        // Sync immediately on change but debounce sending to server
                                        // We use $wire.set instead of entangle to have more control
                                        let debounceTimer;
                                        this.editor.session.on('change', () => {
                                            let val = this.editor.getValue();
                                            
                                            clearTimeout(debounceTimer);
                                            debounceTimer = setTimeout(() => {
                                                $wire.set('content', val);
                                            }, 2000);
                                        });
                                        
                                        // Sync immediately on blur
                                        this.editor.on('blur', () => {
                                             $wire.set('content', this.editor.getValue());
                                        });

                                        // Listen for AI generation (Final update)
                                        Livewire.on('content-generated', () => {
                                            this.editor.setValue($wire.get('content'), -1);
                                        });

                                        // Setup streaming observer
                                        const observer = new MutationObserver((mutations) => {
                                            mutations.forEach((mutation) => {
                                                if (mutation.type === 'childList') {
                                                    // Get the full content from the stream target
                                                    const streamContent = this.$refs.streamTarget.innerText;
                                                    // Update editor without moving cursor if possible, or just set value
                                                    // For streaming effect, setting value is fine
                                                    const currentPos = this.editor.getCursorPosition();
                                                    this.editor.setValue(streamContent, 1); // 1 moves cursor to end
                                                }
                                            });
                                        });
                                        
                                        observer.observe(this.$refs.streamTarget, { childList: true, characterData: true, subtree: true });
                                    },
                                    startGeneration() {
                                        // Clear editor and stream target before starting
                                        this.editor.setValue('', -1);
                                        this.$refs.streamTarget.innerText = '';
                                        $wire.generateWebsiteContent();
                                    }
                                }"
                                x-init="initAce()"
                                @start-ai-generation.window="startGeneration()"
                                wire:ignore
                                class="h-[600px] w-full border border-white/10 rounded-xl overflow-hidden bg-[#141414] relative"
                            >
                                <div x-ref="aceContainer" class="h-full w-full"></div>
                                {{-- Hidden stream target --}}
                                <div x-ref="streamTarget" wire:stream="content-editor" class="hidden"></div>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <x-input-error class="mt-1 text-xs text-red-500" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-white/5 mt-8">
                        <button type="button" wire:click="cancel"
                            class="px-6 py-3 bg-white/5 text-gray-400 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-white/10 hover:text-white transition-all">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="image"
                            class="px-8 py-3 bg-white text-black rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                            Update Website
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @once
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1c1c1e;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
    </style>
    @endonce
</div>
