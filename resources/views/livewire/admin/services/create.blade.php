<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Add New Service') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Define a new service you offer.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-8 sm:p-10">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Title</label>
                            <input wire:model="title" id="title" type="text" 
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                required>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Description</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                required></textarea>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('description')" />
                        </div>

                        <div class="col-span-1 md:col-span-2" wire:ignore>
                            <label for="content" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Rich Details</label>
                            <div
                                x-data="{
                                    content: @entangle('content'),
                                    initQuill() {
                                        this.$nextTick(() => {
                                            const quill = new Quill(this.$refs.quillEditor, {
                                                theme: 'snow',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline'],
                                                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                        ['link', 'clean']
                                                    ]
                                                }
                                            });

                                            if (this.content) {
                                                quill.root.innerHTML = this.content;
                                            }

                                            quill.on('text-change', (delta, oldDelta, source) => {
                                                if (source === 'user') {
                                                    this.content = quill.root.innerHTML;
                                                }
                                            });

                                            this.$watch('content', (value) => {
                                                if (value === null || value === undefined) value = '';
                                                if (quill.root.innerHTML !== value) {
                                                    quill.root.innerHTML = value;
                                                }
                                            });
                                        });
                                    }
                                }"
                                x-init="initQuill()"
                                class="bg-[#0b0b0d] text-white border border-white/10 rounded-xl overflow-hidden"
                            >
                                <div x-ref="quillEditor" class="h-64"></div>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <x-input-error class="mt-1 text-xs text-red-500" :messages="$errors->get('content')" />
                        </div>

                        <div>
                            <label for="features" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Features (Comma separated)</label>
                            <input wire:model="features" id="features" type="text" placeholder="e.g. Design, Dev, Support"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('features')" />
                        </div>
                        <div>
                            <label for="turnaround_time" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Turnaround Time</label>
                            <input wire:model="turnaround_time" id="turnaround_time" type="text" placeholder="e.g. 2-4 Weeks"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('turnaround_time')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Icon Image</label>
                            <div class="flex items-center gap-4">
                                @if ($icon)
                                    <div class="w-16 h-16 rounded-xl border border-white/10 overflow-hidden bg-black flex-shrink-0">
                                        <img src="{{ $icon->temporaryUrl() }}" class="w-full h-full object-cover">
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
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-white/5 mt-8">
                        <button type="button" wire:click="cancel"
                            class="px-6 py-3 bg-white/5 text-gray-400 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-white/10 hover:text-white transition-all">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="icon"
                            class="px-8 py-3 bg-white text-black rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                            Add Service
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
        /* Quill Dark Mode */
        .ql-toolbar.ql-snow {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-bottom: none !important;
            border-radius: 0.75rem 0.75rem 0 0;
            background-color: #1c1c1e;
        }
        .ql-container.ql-snow {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 0 0 0.75rem 0.75rem;
            background-color: #0b0b0d;
        }
        .ql-stroke { stroke: #9ca3af !important; }
        .ql-fill { fill: #9ca3af !important; }
        .ql-picker { color: #9ca3af !important; }
        .ql-editor { color: #fff !important; }
    </style>
    @endonce
</div>
