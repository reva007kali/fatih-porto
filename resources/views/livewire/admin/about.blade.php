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
                            <p class="text-sm text-gray-500 leading-relaxed">Basic information that appears in the About
                                section header.</p>
                        </div>

                        <div class="col-span-2 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="title"
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Title</label>
                                    <input wire:model="title" id="title" type="text"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                        placeholder="e.g. About Me">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('title')" />
                                </div>
                                <div>
                                    <label for="location"
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Location</label>
                                    <input wire:model="location" id="location" type="text"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none"
                                        placeholder="e.g. Jakarta, Indonesia">
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('location')" />
                                </div>
                                <div>
                                    <label for="availability_status"
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Availability
                                        Status</label>
                                    <select wire:model="availability_status" id="availability_status"
                                        class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                        <option value="Available for Work">Available for Work</option>
                                        <option value="Busy">Busy</option>
                                        <option value="Open to Offers">Open to Offers</option>
                                        <option value="Freelance">Freelance</option>
                                    </select>
                                    <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('availability_status')" />
                                </div>
                            </div>

                            <div>
                                <label for="description"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Short
                                    Description</label>
                                <textarea wire:model="description" id="description" rows="3"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                    placeholder="A brief intro..."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <label for="motto"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Motto /
                                    Personal Quote</label>
                                <textarea wire:model="motto" id="motto" rows="2"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none resize-none"
                                    placeholder="e.g. Design is logic made visible."></textarea>
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('motto')" />
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- CV / Resume --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">CV / Resume</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Upload your CV in PDF format for visitors
                                to download.</p>
                        </div>

                        <div class="col-span-2">
                            <div
                                class="group relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:border-swiss-blue/50 hover:bg-white/[0.02]">
                                @if ($cv_file)
                                    <div
                                        class="flex items-center gap-4 mb-4 p-4 bg-[#1c1c1e] rounded-xl border border-white/10">
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-white truncate">New CV Uploaded</p>
                                            <p class="text-xs text-gray-500">Ready to save</p>
                                        </div>
                                    </div>
                                @elseif ($currentCvFile)
                                    <div
                                        class="flex items-center gap-4 mb-4 p-4 bg-[#1c1c1e] rounded-xl border border-white/10">
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-white truncate">Current CV</p>
                                            <a href="{{ asset('storage/' . $currentCvFile) }}" target="_blank"
                                                class="text-xs text-swiss-blue hover:underline">View PDF</a>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-center justify-center w-full mt-4">
                                    <label class="flex flex-col items-center cursor-pointer">
                                        <span
                                            class="text-sm font-medium text-swiss-blue hover:text-white transition-colors">Upload
                                            PDF</span>
                                        <input type="file" wire:model="cv_file" class="hidden"
                                            accept="application/pdf" />
                                    </label>
                                </div>

                                <div wire:loading wire:target="cv_file"
                                    class="absolute inset-0 bg-[#1c1c1e]/90 flex flex-col items-center justify-center rounded-2xl z-10 backdrop-blur-sm">
                                    <div
                                        class="w-8 h-8 border-2 border-swiss-blue border-t-transparent rounded-full animate-spin mb-2">
                                    </div>
                                    <span
                                        class="text-xs font-bold text-swiss-blue uppercase tracking-wider">Uploading...</span>
                                </div>
                            </div>
                            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('cv_file')" />
                        </div>
                    </div>

                    <div class="h-px bg-white/5 w-full"></div>

                    {{-- Rich Content --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                        <div class="col-span-1">
                            <h3 class="text-lg font-bold text-white mb-2">Full Story</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Detailed biography or extended content.
                                Use
                                the editor to format your text.</p>
                        </div>

                        <div class="col-span-2">
                            <div wire:ignore>
                                <div x-data="{
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
                                }" x-init="initQuill()"
                                    class="h-fit bg-[#0b0b0d] text-white border border-white/10 rounded-xl overflow-hidden">
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
                            <p class="text-sm text-gray-500 leading-relaxed">A personal photo or relevant image for the
                                about section.</p>
                        </div>

                        <div class="col-span-2">
                            <div
                                class="group relative border-2 border-dashed border-white/10 rounded-2xl p-6 transition-all hover:border-swiss-blue/50 hover:bg-white/[0.02]">
                                @if ($image)
                                    <div
                                        class="relative aspect-[4/5] w-48 mb-4 overflow-hidden rounded-xl border border-white/10 bg-black mx-auto md:mx-0">
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="text-white text-xs font-bold uppercase tracking-wider">New
                                                Preview</span>
                                        </div>
                                    </div>
                                @elseif ($currentImage)
                                    <div
                                        class="relative aspect-[4/5] w-48 mb-4 overflow-hidden rounded-xl border border-white/10 bg-black mx-auto md:mx-0">
                                        <img src="{{ asset('storage/' . $currentImage) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif

                                <div class="flex items-center justify-center w-full mt-4">
                                    <label class="flex flex-col items-center cursor-pointer">
                                        <span
                                            class="text-sm font-medium text-swiss-blue hover:text-white transition-colors">Change
                                            Image</span>
                                        <input type="file" wire:model="image" class="hidden" accept="image/*" />
                                    </label>
                                </div>

                                {{-- Loading State --}}
                                <div wire:loading wire:target="image"
                                    class="absolute inset-0 bg-[#1c1c1e]/90 flex flex-col items-center justify-center rounded-2xl z-10 backdrop-blur-sm">
                                    <div
                                        class="w-8 h-8 border-2 border-swiss-blue border-t-transparent rounded-full animate-spin mb-2">
                                    </div>
                                    <span
                                        class="text-xs font-bold text-swiss-blue uppercase tracking-wider">Uploading...</span>
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
                            <p class="text-sm text-gray-500 leading-relaxed">Optional button at the end of the about
                                section.</p>
                        </div>

                        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="button_text"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button
                                    Text</label>
                                <input wire:model="button_text" id="button_text" type="text"
                                    class="w-full bg-[#0b0b0d] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:border-swiss-blue focus:ring-1 focus:ring-swiss-blue transition-all outline-none">
                                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('button_text')" />
                            </div>
                            <div>
                                <label for="button_link"
                                    class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Button
                                    Link</label>
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
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" wire:loading.attr="disabled" wire:target="image"
                            class="px-8 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Save Settings</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>

                <div class="h-px bg-white/5 w-full my-12"></div>

                {{-- Work Experience --}}
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Work Experience</h3>
                    </div>

                    {{-- List --}}
                    <div class="space-y-4">
                        @foreach ($work_experiences as $work)
                            <div
                                class="flex items-center justify-between p-4 bg-[#0b0b0d] border border-white/10 rounded-xl">
                                <div>
                                    <h4 class="font-bold text-white">{{ $work->company }}</h4>
                                    <p class="text-sm text-gray-500">{{ $work->role }} | {{ $work->period }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editWork({{ $work->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-swiss-blue transition-colors">Edit</button>
                                    <button wire:click="deleteWork({{ $work->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-red-500 transition-colors">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form --}}
                    <div class="p-6 bg-[#0b0b0d] border border-white/10 rounded-2xl">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">
                            {{ $isEditingWork ? 'Edit Work Experience' : 'Add New Work Experience' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input wire:model="work_company" type="text" placeholder="Company"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="work_role" type="text" placeholder="Role"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="work_period" type="text" placeholder="Period (e.g. 2020 - Present)"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                        </div>
                        <textarea wire:model="work_description" rows="2" placeholder="Description (Optional)"
                            class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none resize-none mb-4"></textarea>

                        <div class="flex items-center gap-3">
                            <button wire:click="saveWork"
                                class="px-6 py-2 bg-white text-black text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-gray-200">Save</button>
                            @if ($isEditingWork)
                                <button wire:click="resetWork"
                                    class="px-6 py-2 bg-white/5 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-white/10">Cancel</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="h-px bg-white/5 w-full my-12"></div>

                {{-- Education --}}
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Education</h3>
                    </div>

                    {{-- List --}}
                    <div class="space-y-4">
                        @foreach ($educations as $edu)
                            <div
                                class="flex items-center justify-between p-4 bg-[#0b0b0d] border border-white/10 rounded-xl">
                                <div>
                                    <h4 class="font-bold text-white">{{ $edu->institution }}</h4>
                                    <p class="text-sm text-gray-500">{{ $edu->degree }} | {{ $edu->period }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editEdu({{ $edu->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-swiss-blue transition-colors">Edit</button>
                                    <button wire:click="deleteEdu({{ $edu->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-red-500 transition-colors">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form --}}
                    <div class="p-6 bg-[#0b0b0d] border border-white/10 rounded-2xl">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">
                            {{ $isEditingEdu ? 'Edit Education' : 'Add New Education' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input wire:model="edu_institution" type="text" placeholder="Institution"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="edu_degree" type="text" placeholder="Degree"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="edu_period" type="text" placeholder="Period"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                        </div>
                        <textarea wire:model="edu_description" rows="2" placeholder="Description (Optional)"
                            class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none resize-none mb-4"></textarea>

                        <div class="flex items-center gap-3">
                            <button wire:click="saveEdu"
                                class="px-6 py-2 bg-white text-black text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-gray-200">Save</button>
                            @if ($isEditingEdu)
                                <button wire:click="resetEdu"
                                    class="px-6 py-2 bg-white/5 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-white/10">Cancel</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="h-px bg-white/5 w-full my-12"></div>

                {{-- Skills --}}
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Skills</h3>
                    </div>

                    {{-- List --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($skills as $skill)
                            <div
                                class="flex items-center justify-between p-4 bg-[#0b0b0d] border border-white/10 rounded-xl">
                                <div>
                                    <h4 class="font-bold text-white">{{ $skill->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $skill->category }} |
                                        {{ $skill->proficiency }}%</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editSkill({{ $skill->id }})"
                                        class="p-1.5 hover:bg-white/5 rounded-lg text-swiss-blue transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="deleteSkill({{ $skill->id }})"
                                        class="p-1.5 hover:bg-white/5 rounded-lg text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form --}}
                    <div class="p-6 bg-[#0b0b0d] border border-white/10 rounded-2xl">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">
                            {{ $isEditingSkill ? 'Edit Skill' : 'Add New Skill' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <input wire:model="skill_name" type="text" placeholder="Skill Name"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="skill_category" type="text" placeholder="Category (e.g. Technical)"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="skill_proficiency" type="number" min="0" max="100"
                                placeholder="Proficiency (0-100)"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                        </div>

                        <div class="flex items-center gap-3">
                            <button wire:click="saveSkill"
                                class="px-6 py-2 bg-white text-black text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-gray-200">Save</button>
                            @if ($isEditingSkill)
                                <button wire:click="resetSkill"
                                    class="px-6 py-2 bg-white/5 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-white/10">Cancel</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="h-px bg-white/5 w-full my-12"></div>

                {{-- Certifications --}}
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Certifications</h3>
                    </div>

                    {{-- List --}}
                    <div class="space-y-4">
                        @foreach ($certifications as $cert)
                            <div
                                class="flex items-center justify-between p-4 bg-[#0b0b0d] border border-white/10 rounded-xl">
                                <div>
                                    <h4 class="font-bold text-white">{{ $cert->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $cert->issuer }} | {{ $cert->date }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editCert({{ $cert->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-swiss-blue transition-colors">Edit</button>
                                    <button wire:click="deleteCert({{ $cert->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-red-500 transition-colors">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form --}}
                    <div class="p-6 bg-[#0b0b0d] border border-white/10 rounded-2xl">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">
                            {{ $isEditingCert ? 'Edit Certification' : 'Add New Certification' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input wire:model="cert_name" type="text" placeholder="Name"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="cert_issuer" type="text" placeholder="Issuer"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="cert_date" type="text" placeholder="Date"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="cert_link" type="text" placeholder="Link (Optional)"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                        </div>

                        <div class="flex items-center gap-3">
                            <button wire:click="saveCert"
                                class="px-6 py-2 bg-white text-black text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-gray-200">Save</button>
                            @if ($isEditingCert)
                                <button wire:click="resetCert"
                                    class="px-6 py-2 bg-white/5 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-white/10">Cancel</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="h-px bg-white/5 w-full my-12"></div>

                {{-- Achievements --}}
                <div class="space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Achievements</h3>
                    </div>

                    {{-- List --}}
                    <div class="space-y-4">
                        @foreach ($achievements as $ach)
                            <div
                                class="flex items-center justify-between p-4 bg-[#0b0b0d] border border-white/10 rounded-xl">
                                <div>
                                    <h4 class="font-bold text-white">{{ $ach->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $ach->date }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button wire:click="editAch({{ $ach->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-swiss-blue transition-colors">Edit</button>
                                    <button wire:click="deleteAch({{ $ach->id }})"
                                        class="p-2 hover:bg-white/5 rounded-lg text-red-500 transition-colors">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Form --}}
                    <div class="p-6 bg-[#0b0b0d] border border-white/10 rounded-2xl">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-4">
                            {{ $isEditingAch ? 'Edit Achievement' : 'Add New Achievement' }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input wire:model="ach_title" type="text" placeholder="Title"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                            <input wire:model="ach_date" type="text" placeholder="Date"
                                class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none">
                        </div>
                        <textarea wire:model="ach_description" rows="2" placeholder="Description (Optional)"
                            class="w-full bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-3 text-white outline-none resize-none mb-4"></textarea>

                        <div class="flex items-center gap-3">
                            <button wire:click="saveAch"
                                class="px-6 py-2 bg-white text-black text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-gray-200">Save</button>
                            @if ($isEditingAch)
                                <button wire:click="resetAch"
                                    class="px-6 py-2 bg-white/5 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-white/10">Cancel</button>
                            @endif
                        </div>
                    </div>
                </div>

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
