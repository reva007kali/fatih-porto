<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('About Settings') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Tell your visitors a bit about yourself.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-6 sm:p-10">
                <form wire:submit.prevent="save" class="space-y-10">
                    
                    {{-- Main Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Introduction</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Basic information that appears in the About section header.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div>
                                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Title</label>
                                <input wire:model="title" id="title" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                    placeholder="e.g. About Me">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Short Description</label>
                                <textarea wire:model="description" id="description" rows="3"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                    placeholder="A brief intro..."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('description')" />
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Rich Content --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Full Story</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Detailed biography or extended content. Use the editor to format your text.</p>
                        </div>

                        <div class="col-span-2">
                            <div wire:ignore>
                                <div
                                    x-data="{
                                        content: @entangle('content'),
                                        quill: null,
                                        initQuill() {
                                            this.$nextTick(() => {
                                                this.quill = new Quill(this.$refs.quillEditor, {
                                                    theme: 'snow',
                                                    modules: {
                                                        toolbar: {
                                                            container: [
                                                                [{ 'header': [1, 2, 3, false] }],
                                                                ['bold', 'italic', 'underline', 'strike'],
                                                                ['blockquote', 'code-block'],
                                                                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                                [{ 'color': [] }, { 'background': [] }],
                                                                ['link', 'image', 'video'],
                                                                ['clean']
                                                            ],
                                                            handlers: {
                                                                image: () => this.selectLocalImage(),
                                                                video: () => this.selectLocalVideo()
                                                            }
                                                        }
                                                    }
                                                });

                                                if (this.content) {
                                                    this.quill.root.innerHTML = this.content;
                                                }

                                                this.quill.on('text-change', (delta, oldDelta, source) => {
                                                    if (source === 'user') {
                                                        this.content = this.quill.root.innerHTML;
                                                    }
                                                });

                                                this.$watch('content', (value) => {
                                                    if (value === null || value === undefined) value = '';
                                                    if (this.quill.root.innerHTML !== value) {
                                                        this.quill.root.innerHTML = value;
                                                    }
                                                });

                                                Livewire.on('quill-upload-finished', ({ url, type }) => {
                                                    if (url) {
                                                        const range = this.quill.getSelection(true);
                                                        this.quill.insertEmbed(range.index, type, url);
                                                    }
                                                });
                                            });
                                        },
                                        selectLocalImage() {
                                            const input = document.createElement('input');
                                            input.setAttribute('type', 'file');
                                            input.setAttribute('accept', 'image/*');
                                            input.click();

                                            input.onchange = () => {
                                                const file = input.files[0];
                                                if (/^image\//.test(file.type)) {
                                                    @this.upload('quillFile', file);
                                                } else {
                                                    alert('You can only upload images.');
                                                }
                                            };
                                        },
                                        selectLocalVideo() {
                                            const input = document.createElement('input');
                                            input.setAttribute('type', 'file');
                                            input.setAttribute('accept', 'video/*');
                                            input.click();

                                            input.onchange = () => {
                                                const file = input.files[0];
                                                if (/^video\//.test(file.type)) {
                                                    @this.upload('quillFile', file);
                                                } else {
                                                    alert('You can only upload videos.');
                                                }
                                            };
                                        }
                                    }"
                                    x-init="initQuill()"
                                    class="h-fit bg-[#0b0b0d] text-white border border-white/10 rounded-xl overflow-hidden"
                                >
                                    <div x-ref="quillEditor" class="h-96"></div>
                                </div>
                            </div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Image --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Profile Image</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">A personal photo or relevant image for the about section.</p>
                        </div>

                        <div class="col-span-2">
                             <div class="group relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:border-swiss-blue/50 hover:bg-white/[0.02]">
                                @if ($image)
                                    <div class="relative aspect-[4/5] w-48 mb-4 overflow-hidden rounded-xl border border-white/10 bg-black mx-auto md:mx-0">
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="text-white text-xs font-bold uppercase tracking-wider">New Preview</span>
                                        </div>
                                    </div>
                                @elseif ($currentImage)
                                    <div class="relative aspect-[4/5] w-48 mb-4 overflow-hidden rounded-xl border border-white/10 bg-black mx-auto md:mx-0">
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-full h-full object-cover">
                                    </div>
                                @endif

                                <div class="flex items-center justify-center w-full mt-4">
                                    <label class="flex flex-col items-center cursor-pointer">
                                        <span class="text-sm font-medium text-swiss-blue hover:text-white transition-colors">Change Image</span>
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

                    {{-- CTA --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Call to Action</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Optional button at the end of the about section.</p>
                        </div>

                        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="button_text" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Text</label>
                                <input wire:model="button_text" id="button_text" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('button_text')" />
                            </div>
                            <div>
                                <label for="button_link" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button Link</label>
                                <input wire:model="button_link" id="button_link" type="text" 
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('button_link')" />
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

                        <button type="submit" wire:loading.attr="disabled" wire:target="image"
                            class="px-8 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Quill Dark Mode Overrides */
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
        .ql-stroke {
            stroke: #9ca3af !important;
        }
        .ql-fill {
            fill: #9ca3af !important;
        }
        .ql-picker {
            color: #9ca3af !important;
        }
        .ql-editor {
            color: #fff !important;
        }
    </style>
</div>