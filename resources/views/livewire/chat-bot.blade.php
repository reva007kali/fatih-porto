<div x-data="{
    scrollToBottom() {
        $nextTick(() => {
            const container = $refs.chatContainer;
            if (container) {
                container.scrollTo({
                    top: container.scrollHeight,
                    behavior: 'smooth'
                });
            }
        });
    }
}" x-on:scroll-to-bottom.window="scrollToBottom()">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        /* CRITICAL: Mencegah elemen muncul sebelum Alpine.js siap */
        [x-cloak] { 
            display: none !important; 
        }

        .prose-chat ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 0.8rem;
        }

        .prose-chat ol {
            list-style-type: decimal;
            margin-left: 1.5rem;
            margin-bottom: 0.8rem;
        }

        .prose-chat p {
            margin-bottom: 0.6rem;
        }

        .glass-panel {
            background: rgba(22, 22, 24, 0.85) !important;
            backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255, 255, 255, 0.08);
            pointer-events: auto !important;
        }

        .chat-scroll-container {
            overscroll-behavior: contain !important;
            -webkit-overflow-scrolling: touch !important;
            touch-action: pan-y !important;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .ai-sphere {
            animation: spin 8s linear infinite;
        }
    </style>

    <button wire:click="toggleChat" class="fixed bottom-6 right-6 z-[1000] group w-12 h-12">
        <img class="ai-sphere" src="/img/ai-sphere.png" alt="{{ $assistantName }}">

        <span class="absolute right-14 top-1/2 -translate-y-1/2 
                   bg-black text-white text-xs px-3 py-1 rounded-full 
                   opacity-0 group-hover:opacity-100 
                   translate-x-2 group-hover:translate-x-0
                   transition-all duration-300 
                   whitespace-nowrap shadow-lg">
            {{ $assistantName }}
        </span>
    </button>


    <div 
        class="fixed inset-0 z-[1001] pointer-events-none" 
        x-show="$wire.isOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            class="absolute inset-0 bg-black/50 backdrop-blur-sm pointer-events-auto" 
            @click="$wire.toggleChat()"
        ></div>

        <div 
            class="absolute top-0 right-0 h-full w-full md:w-[450px] glass-panel shadow-2xl flex flex-col pointer-events-auto transform"
            x-show="$wire.isOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
        >
            
            <div class="px-6 py-5 border-b border-white/5 bg-white/[0.02] flex justify-between items-center shrink-0">
                <div class="flex items-center gap-3">
                    <div class="">
                        <img class="ai-sphere w-10 h-10" src="/img/ai-sphere.png" alt="{{ $assistantName }}">
                    </div>
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-white">{{ $assistantName }}</h3>
                        <p class="text-[9px] text-green-500 font-bold uppercase">Online Now</p>
                    </div>
                </div>
                <button wire:click="toggleChat" class="text-white/20 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-ref="chatContainer" @wheel.stop @touchmove.stop @mousedown.stop
                class="flex-1 overflow-y-auto p-6 space-y-6 scrollbar-hide chat-scroll-container">
                @foreach ($messages as $index => $message)
                    @if (($message['role'] === 'user' || $message['role'] === 'assistant') && isset($message['content']))
                        <div class="flex {{ $message['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%]">
                                <span class="text-[9px] font-bold text-white/20 uppercase mb-1 block {{ $message['role'] === 'user' ? 'text-right' : 'text-left' }}">
                                    {{ $message['role'] === 'user' ? 'You' : $assistantName }}
                                </span>
                                <div class="p-4 rounded-2xl text-[13px] {{ $message['role'] === 'user' ? 'bg-orange-500 text-black font-semibold' : 'bg-white/5 text-gray-300 border border-white/10' }}">
                                    @if ($message['role'] === 'user')
                                        {{ $message['content'] }}
                                    @else
                                        <div class="prose-chat" x-data="{
                                            raw: @js($message['content']),
                                            displayed: '',
                                            idx: 0,
                                            type() {
                                                if (this.idx < this.raw.length) {
                                                    this.displayed += this.raw.charAt(this.idx);
                                                    this.idx++;
                                                    setTimeout(() => this.type(), 5);
                                                    $dispatch('scroll-to-bottom');
                                                }
                                            }
                                        }" x-init="if ({{ $index }} === $wire.messages.length - 1) { type() } else { displayed = raw }"
                                            x-html="marked.parse(displayed)">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if ($showLeadForm)
                    <div class="flex justify-start pb-4">
                        <div class="max-w-[90%] w-full">
                            <span class="text-[9px] font-bold text-white/20 uppercase mb-1 block text-left">System</span>
                            <div class="bg-white/10 border border-white/20 p-5 rounded-2xl shadow-xl">
                                <h4 class="text-white font-bold mb-3 text-sm">Formulir Pemesanan</h4>
                                <form wire:submit.prevent="submitLeadForm" class="space-y-3">
                                    <div>
                                        <input wire:model="leadForm.name" type="text" placeholder="Nama Kamu"
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none">
                                        @error('leadForm.name') <span class="text-[10px] text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <input wire:model="leadForm.contact" type="text" placeholder="No. WA / Email"
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none">
                                        @error('leadForm.contact') <span class="text-[10px] text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <select wire:model="leadForm.budget"
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none">
                                            <option value="">Pilih Budget...</option>
                                            <option value="Under 1jt">Under 1 Juta</option>
                                            <option value="1jt - 3jt">1 Juta - 3 Juta</option>
                                            <option value="3jt - 5jt">3 Juta - 5 Juta</option>
                                            <option value="5jt+">Diatas 5 Juta</option>
                                        </select>
                                        @error('leadForm.budget') <span class="text-[10px] text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <textarea wire:model="leadForm.description" rows="2" placeholder="Jelasin singkat kebutuhanmu..."
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none resize-none"></textarea>
                                        @error('leadForm.description') <span class="text-[10px] text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex justify-end gap-2 pt-2">
                                        <button type="button" wire:click="$set('showLeadForm', false)"
                                            class="text-xs text-gray-400 hover:text-white px-3 py-2">Batal</button>
                                        <button type="submit"
                                            class="bg-orange-500 text-black text-xs font-bold px-4 py-2 rounded-lg hover:bg-orange-400 transition-colors">Kirim Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="sendMessage" class="flex justify-start">
                    <div class="bg-white/5 p-4 rounded-2xl animate-pulse text-[10px] text-white/40 uppercase tracking-widest">
                        Reva Thinking...
                    </div>
                </div>
            </div>

            <div class="p-5 border-t border-white/5 bg-white/[0.02] shrink-0 pb-8 md:pb-5">
                <form wire:submit.prevent="sendMessage" class="relative flex items-end gap-2">
                    <textarea wire:model="userInput" @keydown.enter.prevent.exact="$wire.sendMessage()"
                        @keydown.ctrl.enter.prevent="$wire.sendMessage()" placeholder="Tanya harga atau contoh web..."
                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-5 pr-14 py-4 text-xs text-white focus:outline-none focus:border-orange-500 focus:bg-white/10 transition-all resize-none scrollbar-hide min-h-[50px] max-h-[120px]"
                        rows="1" x-data="{
                            resize() {
                                $el.style.height = '50px';
                                $el.style.height = $el.scrollHeight + 'px'
                            }
                        }" x-init="$nextTick(() => {
                            $el.focus();
                            resize();
                        })" @input="resize()"></textarea>

                    <button type="submit"
                        class="absolute right-3 bottom-3 p-2 bg-orange-500 hover:bg-orange-400 text-black rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-orange-500/20"
                        wire:loading.attr="disabled" wire:target="sendMessage">

                        <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>

                        <svg wire:loading wire:target="sendMessage" class="animate-spin w-4 h-4 text-black"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>