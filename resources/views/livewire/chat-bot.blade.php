<div x-data="{
    scrollToBottom() {
        $nextTick(() => {
            const container = $refs.chatContainer;
            if (container) {
                // Standard browser scroll behavior (ignores Locomotive Scroll)
                container.scrollTo({
                    top: container.scrollHeight,
                    behavior: 'smooth'
                });
            }
        });
    }
}" x-on:scroll-to-bottom.window="scrollToBottom()">

    <!-- Library Markdown -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
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
            border: 1px solid rgba(255, 255, 255, 0.08);
            /* Ensure it stays interactive even with Locomotive Scroll overlay */
            pointer-events: auto !important;
        }

        /* Prevent Locomotive Scroll from hijacking the chat scroll */
        .chat-scroll-container {
            overscroll-behavior: contain !important;
            -webkit-overflow-scrolling: touch !important;
            touch-action: pan-y !important;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- TRIGGER BUTTON -->
    <button wire:click="toggleChat"
        class="fixed bottom-12 right-8 z-[1000] flex items-center gap-3 px-3 md:px-5 py-3 bg-orange-700 md:bg-[#161618] border border-white/10 rounded-full shadow-2xl hover:scale-105 transition-all group">

        <!-- Status Indicator -->
        <div class="relative hidden md:block">
            <span class="w-2 h-2 bg-green-500 rounded-full block"></span>
            <span class="absolute inset-0 bg-green-500 rounded-full animate-ping"></span>
        </div>

        <!-- Text (Desktop Only) -->
        <span class="hidden md:inline text-[10px] font-medium uppercase tracking-widest text-white">
            AI Assistant
        </span>
    </button>

    @if ($isOpen)
        <div x-transition
            class="fixed bottom-0 md:bottom-8 right-0 md:right-8 pb-20 md:pb-0 w-[100vw] md:w-[420px] h-full md:h-[600px] max-h-[100vh] flex flex-col z-[1001] md:rounded-3xl overflow-hidden shadow-2xl glass-panel">

            <!-- Header -->
            <div class="px-6 py-5 border-b border-white/5 bg-white/[0.02] flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-500 rounded-lg text-black">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-white">Reva AI</h3>
                        <p class="text-[9px] text-green-500 font-bold uppercase">Online Now</p>
                    </div>
                </div>
                <button wire:click="toggleChat" class="text-white/20 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Chat Area (The Fix is here: @wheel.stop and @touchmove.stop) -->
            <div x-ref="chatContainer" @wheel.stop @touchmove.stop @mousedown.stop
                class="flex-1 overflow-y-auto p-6 space-y-6 scrollbar-hide chat-scroll-container">
                @foreach ($messages as $index => $message)
                    @if (($message['role'] === 'user' || $message['role'] === 'assistant') && isset($message['content']))
                        <div class="flex {{ $message['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%]">
                                <span
                                    class="text-[9px] font-bold text-white/20 uppercase mb-1 block {{ $message['role'] === 'user' ? 'text-right' : 'text-left' }}">
                                    {{ $message['role'] === 'user' ? 'You' : 'AI Reva' }}
                                </span>
                                <div
                                    class="p-4 rounded-2xl text-[13px] {{ $message['role'] === 'user' ? 'bg-orange-500 text-black font-semibold' : 'bg-white/5 text-gray-300 border border-white/10' }}">
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

                <!-- LEAD FORM POPUP -->
                @if ($showLeadForm)
                    <div class="flex justify-start pb-4">
                        <div class="max-w-[90%] w-full">
                            <span
                                class="text-[9px] font-bold text-white/20 uppercase mb-1 block text-left">System</span>
                            <div class="bg-white/10 border border-white/20 p-5 rounded-2xl shadow-xl">
                                <h4 class="text-white font-bold mb-3 text-sm">Formulir Pemesanan</h4>
                                <form wire:submit.prevent="submitLeadForm" class="space-y-3">
                                    <div>
                                        <input wire:model="leadForm.name" type="text" placeholder="Nama Kamu"
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none">
                                        @error('leadForm.name')
                                            <span class="text-[10px] text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <input wire:model="leadForm.contact" type="text" placeholder="No. WA / Email"
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none">
                                        @error('leadForm.contact')
                                            <span class="text-[10px] text-red-400">{{ $message }}</span>
                                        @enderror
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
                                        @error('leadForm.budget')
                                            <span class="text-[10px] text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <textarea wire:model="leadForm.description" rows="2" placeholder="Jelasin singkat kebutuhanmu..."
                                            class="w-full bg-black/20 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:border-orange-500 outline-none resize-none"></textarea>
                                        @error('leadForm.description')
                                            <span class="text-[10px] text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex justify-end gap-2 pt-2">
                                        <button type="button" wire:click="$set('showLeadForm', false)"
                                            class="text-xs text-gray-400 hover:text-white px-3 py-2">Batal</button>
                                        <button type="submit"
                                            class="bg-orange-500 text-black text-xs font-bold px-4 py-2 rounded-lg hover:bg-orange-400 transition-colors">Kirim
                                            Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="sendMessage" class="flex justify-start">
                    <div
                        class="bg-white/5 p-4 rounded-2xl animate-pulse text-[10px] text-white/40 uppercase tracking-widest">
                        Reva Thinking...
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-5 border-t border-white/5 bg-white/[0.02]">
                <form wire:submit.prevent="sendMessage" class="relative flex items-end gap-2">
                    <textarea wire:model="userInput" @keydown.enter.prevent.exact="$wire.sendMessage()"
                        @keydown.ctrl.enter.prevent="$wire.sendMessage()" placeholder="Tanya harga atau contoh web..."
                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-5 pr-14 py-4 text-xs text-white focus:outline-none focus:border-orange-500 focus:bg-white/10 transition-all resize-none scrollbar-hide min-h-[50px] max-h-[120px]"
                        rows="1" x-data="{ resize() { $el.style.height = '50px';
                                $el.style.height = $el.scrollHeight + 'px' } }" x-init="$nextTick(() => { $el.focus();
                                    resize(); })" @input="resize()"></textarea>

                    <button type="submit"
                        class="absolute right-3 bottom-3 p-2 bg-orange-500 hover:bg-orange-400 text-black rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-orange-500/20"
                        wire:loading.attr="disabled" wire:target="sendMessage">

                        <!-- Icon Send -->
                        <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>

                        <!-- Loading Spinner -->
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
    @endif
</div>
