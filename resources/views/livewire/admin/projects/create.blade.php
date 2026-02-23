<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Create New Project') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Add a new project to your portfolio.</p>
        </div>

        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="p-8 sm:p-10">
                <form wire:submit.prevent="store" class="space-y-6" enctype="multipart/form-data">
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
                            <label for="content" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Case Study Details</label>
                            <div
                                x-data="{
                                    content: @entangle('content'),
                                    initQuill() {
                                        this.$nextTick(() => {
                                            const quill = new Quill(this.$refs.quillEditor, {
                                                theme: 'snow',
                                                modules: {
                                                    toolbar: {
                                                        container: [
                                                            ['bold', 'italic', 'underline'],
                                                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                            ['link', 'image', 'video'],
                                                            ['clean']
                                                        ],
                                                        handlers: {
                                                            image: () => this.selectLocalImage(quill),
                                                            video: () => this.selectLocalVideo(quill)
                                                        }
                                                    }
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
                                    },
                                    selectLocalImage(quill) {
                                        const input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.click();

                                        input.onchange = () => {
                                            const file = input.files[0];
                                            if (/^image\//.test(file.type)) {
                                                this.uploadFile(file, quill, 'image');
                                            } else {
                                                alert('You can only upload images.');
                                            }
                                        };
                                    },
                                    selectLocalVideo(quill) {
                                        const input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'video/*');
                                        input.click();

                                        input.onchange = () => {
                                            const file = input.files[0];
                                            if (/^video\//.test(file.type)) {
                                                this.uploadFile(file, quill, 'video');
                                            } else {
                                                alert('You can only upload videos.');
                                            }
                                        };
                                    },
                                    uploadFile(file, quill, type) {
                                        @this.upload('quillFile', file, (uploadedFilename) => {
                                            @this.get('quillFileUrl').then((url) => {
                                                if (url) {
                                                    const range = quill.getSelection(true);
                                                    if (type === 'image') {
                                                        quill.insertEmbed(range.index, 'image', url);
                                                    } else {
                                                        quill.insertEmbed(range.index, 'video', url);
                                                    }
                                                }
                                            });
                                        });
                                    }
                                }"
                                x-init="initQuill()"
                                class="bg-[#0b0b0d] text-white border border-white/10 rounded-xl overflow-hidden"
                            >
                                <div x-ref="quillEditor" class="h-96"></div>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <x-input-error class="mt-1 text-xs text-red-500" :messages="$errors->get('content')" />
                        </div>

                        <div>
                            <label for="category" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Category</label>
                            <input wire:model="category" id="category" type="text" placeholder="e.g. Web Design"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('category')" />
                        </div>
                        <div>
                            <label for="role" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Role</label>
                            <input wire:model="role" id="role" type="text" placeholder="e.g. Lead Dev"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('role')" />
                        </div>
                        <div>
                            <label for="year" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Year</label>
                            <input wire:model="year" id="year" type="text" placeholder="2024"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('year')" />
                        </div>
                        <div>
                            <label for="client" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Client</label>
                            <input wire:model="client" id="client" type="text" placeholder="Acme Inc."
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('client')" />
                        </div>

                        <div>
                            <label for="sort_order" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Order</label>
                            <input wire:model="sort_order" id="sort_order" type="number" placeholder="0"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('sort_order')" />
                        </div>
                        <div>
                            <label for="link" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Link</label>
                            <input wire:model="link" id="link" type="text" placeholder="https://"
                                class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('link')" />
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <div class="flex flex-col gap-3 p-4 bg-[#0b0b0d] rounded-xl border border-white/5">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="is_featured" class="form-checkbox h-4 w-4 text-swiss-blue rounded border-gray-600 bg-[#1c1c1e] focus:ring-swiss-blue">
                                    <span class="ml-2 text-sm text-gray-300">Feature on Homepage</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="is_archived" class="form-checkbox h-4 w-4 text-red-500 rounded border-gray-600 bg-[#1c1c1e] focus:ring-red-500">
                                    <span class="ml-2 text-sm text-gray-300">Archive Project</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2 border-t border-white/5 pt-4">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-4">Project Media</label>
                            
                            {{-- Upload --}}
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-white/10 rounded-xl cursor-pointer hover:bg-white/5 hover:border-swiss-blue/50 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="text-sm text-gray-500">Upload Media (Images/Videos)</p>
                                </div>
                                <input type="file" wire:model="mediaFiles" multiple class="hidden" accept="image/*,video/*" />
                            </label>
                            <div wire:loading wire:target="mediaFiles" class="text-xs text-swiss-blue mt-2 font-bold">Uploading...</div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('mediaFiles')" />
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('mediaFiles.*')" />

                            {{-- Captions --}}
                            @if (count($mediaFiles) > 0)
                                <div class="mt-6 space-y-3">
                                    <p class="text-xs font-bold text-gray-500">New Files Captions</p>
                                    @foreach ($mediaFiles as $index => $file)
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded border border-white/10 overflow-hidden flex-shrink-0">
                                                @if (Str::startsWith($file->getMimeType(), 'video'))
                                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-[10px] text-gray-400">Vid</div>
                                                @else
                                                    <img src="{{ $file->temporaryUrl() }}" class="w-full h-full object-cover">
                                                @endif
                                            </div>
                                            <input wire:model="captions.{{ $index }}" type="text" placeholder="Caption..."
                                                class="flex-1 bg-[#0b0b0d] border border-white/10 rounded-lg px-3 py-2 text-xs text-white placeholder-gray-600 focus:border-swiss-blue outline-none">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-white/5 mt-8">
                        <button type="button" wire:click="cancel"
                            class="px-6 py-3 bg-white/5 text-gray-400 rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-white/10 hover:text-white transition-all">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-8 py-3 bg-white text-black rounded-xl font-bold uppercase tracking-wider text-xs hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50">
                            Create Project
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
