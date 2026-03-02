<div class="flex h-screen w-full overflow-hidden bg-[#0b0b0d]">
    
    <!-- Sidebar / History -->
    <div class="hidden md:flex flex-col w-[260px] bg-[#000000] border-r border-white/5 h-full shrink-0">
        <!-- Sidebar Header -->
        <div class="p-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 group hover:opacity-80 transition-opacity">
                 <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-orange-500 to-purple-600 flex items-center justify-center shadow-lg shadow-orange-500/20">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-sm font-black tracking-widest text-white">LUNA AI</span>
            </a>
            
            <button wire:click="clearChat" wire:confirm="Clear chat history?" class="p-2 hover:bg-white/10 rounded-lg text-white/40 hover:text-white transition-colors">
                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </button>
        </div>

        <!-- History List (Static for now, but could be dynamic sessions) -->
        <div class="flex-1 overflow-y-auto p-2 space-y-2">
            <div class="px-3 py-2 text-xs font-bold text-white/40 uppercase tracking-wider">Today</div>
            
            <!-- Current Session Item -->
            <button class="w-full text-left px-3 py-3 rounded-lg bg-[#1c1c1e] text-sm text-white border border-white/10 truncate group relative">
                <span class="relative z-10">{{ Str::limit($messages[count($messages)-1]['content'] ?? 'New Chat', 25) }}</span>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-[#1c1c1e] z-20"></div>
            </button>
            
            <!-- Example Past Items (Visual Only) -->
            {{-- <button class="w-full text-left px-3 py-3 rounded-lg hover:bg-white/5 text-sm text-white/60 truncate transition-colors">
                Project Architecture...
            </button> --}}
        </div>

        <!-- User Profile / Footer -->
        <div class="p-4 border-t border-white/5">
             <a href="/" class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-white/5 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-white truncate">Guest User</p>
                    <p class="text-[10px] text-white/40 truncate group-hover:text-orange-500 transition-colors">Back to Portfolio</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full relative">
        
        <!-- Mobile Header -->
        <div class="md:hidden flex items-center justify-between p-4 border-b border-white/5 bg-[#0b0b0d]">
             <div class="flex items-center gap-2">
                 <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-orange-500 to-purple-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-sm font-black tracking-widest text-white">LUNA AI</span>
            </div>
            <button wire:click="clearChat" class="text-xs text-white/40 hover:text-white">Clear</button>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto w-full relative" 
            x-data="{ 
                scrollToBottom() {
                    this.$el.scrollTop = this.$el.scrollHeight;
                }
            }"
            x-init="setTimeout(() => scrollToBottom(), 100)"
            x-on:scroll-to-bottom.window="setTimeout(() => scrollToBottom(), 100)">
            
            <div class="max-w-3xl mx-auto px-4 sm:px-6 py-10 pb-48 space-y-8">
                @if(count($messages) <= 1)
                    <!-- Empty State / Welcome -->
                    <div class="flex flex-col items-center justify-center min-h-[50vh] text-center space-y-6">
                        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">How can I help you today?</h2>
                    </div>
                @endif

                @foreach($messages as $index => $message)
                    @if($loop->first && count($messages) > 1) @continue @endif 
                    
                    <div class="group w-full text-gray-800 dark:text-gray-100 border-b border-black/10 dark:border-gray-900/50 {{ $message['role'] === 'assistant' ? 'bg-[#444654]/0' : 'bg-transparent' }}">
                        <div class="flex gap-4 md:gap-6 p-4 md:py-6 m-auto">
                            <!-- Avatar -->
                            <div class="shrink-0 flex flex-col relative items-end">
                                <div class="relative h-7 w-7 p-1 rounded-sm text-white flex items-center justify-center {{ $message['role'] === 'user' ? 'bg-white/10' : 'bg-green-500' }}" style="{{ $message['role'] === 'assistant' ? 'background-color: rgb(25 195 125)' : '' }}">
                                    @if($message['role'] === 'user')
                                        <svg class="h-4 w-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    @else
                                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="relative flex-1 overflow-hidden">
                                @if($message['role'] === 'user')
                                    <div class="text-white font-medium leading-7">{{ $message['content'] }}</div>
                                @else
                                    <div class="prose-luna leading-7" 
                                        x-data="{
                                            raw: @js($message['content']),
                                            displayed: '',
                                            idx: 0,
                                            isTyping: true,
                                            type() {
                                                if (this.idx < this.raw.length) {
                                                    this.displayed += this.raw.charAt(this.idx);
                                                    this.idx++;
                                                    let speed = 1; 
                                                    if (this.idx % 10 === 0) setTimeout(() => this.type(), speed);
                                                    else this.type();
                                                    
                                                    if (this.idx % 50 === 0) $dispatch('scroll-to-bottom');
                                                } else {
                                                    this.isTyping = false;
                                                    this.$nextTick(() => {
                                                        hljs.highlightAll();
                                                    });
                                                }
                                            }
                                        }" 
                                        x-init="
                                            // Always display raw content initially to ensure visibility
                                            displayed = raw;
                                            
                                            // Trigger highlight after render
                                            $nextTick(() => hljs.highlightAll());
                                            
                                            // Only if it's the very last message AND we are currently 'thinking' (new response)
                                            // We reset displayed to empty and start typing
                                            if ({{ $index }} === {{ count($messages) - 1 }} && {{ $isThinking ? 'false' : 'true' }} && {{ count($messages) > 1 ? 'true' : 'false' }}) { 
                                                // Actually, if $isThinking is false, it means generation is DONE.
                                                // We need a way to know if this message was JUST added.
                                                // For now, let's just render it directly to fix visibility issues.
                                                // The typing effect is nice but reliability is key.
                                            }
                                        "
                                        x-html="marked.parse(displayed)">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                 <!-- Thinking Indicator -->
                @if($isThinking)
                    <div class="w-full border-b border-black/10 dark:border-gray-900/50 bg-[#444654]/0">
                        <div class="flex gap-4 md:gap-6 p-4 md:py-6 m-auto">
                            <div class="shrink-0 flex flex-col relative items-end">
                                <div class="relative h-7 w-7 p-1 rounded-sm bg-green-500 text-white flex items-center justify-center" style="background-color: rgb(25 195 125)">
                                    <svg class="h-4 w-4 text-white animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </div>
                            </div>
                            <div class="relative flex-1 overflow-hidden">
                                <span class="text-white/40 text-sm font-mono animate-pulse">Thinking...</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Input Area -->
        <div class=" w-full bg-[#0b0b0d] pt-6 pb-6 px-4 border-t border-white/5">

            <div class="max-w-3xl mx-auto relative">
                <form wire:submit.prevent="sendMessage">
                    <div class="relative flex items-end w-full p-2 bg-[#2f2f38] border border-white/10 rounded-2xl shadow-lg focus-within:ring-1 focus-within:ring-white/20 focus-within:border-white/20">
                        <textarea 
                            wire:model="userInput" 
                            placeholder="Send a message..." 
                            rows="1"
                            class="w-full max-h-[200px] py-3 px-4 bg-transparent text-white placeholder-white/40 border-0 focus:ring-0 focus:outline-none resize-none scrollbar-hide m-0 leading-6"
                            style="min-height: 48px"
                            x-data="{ 
                                resize() { 
                                    $el.style.height = '48px'; 
                                    $el.style.height = $el.scrollHeight + 'px';
                                } 
                            }"
                            x-init="resize()"
                            @input="resize()"
                            @keydown.enter.prevent.exact="$wire.sendMessage(); $el.style.height = '48px';"
                            @keydown.ctrl.enter.prevent="$wire.sendMessage(); $el.style.height = '48px';"
                        ></textarea>
                        
                        <button type="submit" 
                            class="p-2 rounded-md text-white/40 hover:text-white hover:bg-black/50 transition-colors disabled:opacity-20 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:target="sendMessage"
                            :disabled="!$wire.userInput.trim()">
                            <svg class="w-4 h-4 rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        </button>
                    </div>
                    <div class="text-center mt-2">
                        <span class="text-[10px] text-white/30">Free Research Preview. Luna AI may produce inaccurate information.</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Styles for Highlight.js and Prose -->
    <style>
        .prose-luna { color: #d1d5db; font-size: 1rem; }
        .prose-luna p { margin-bottom: 1.25em; }
        .prose-luna h1, .prose-luna h2, .prose-luna h3 { color: white; font-weight: 600; margin-top: 1.5em; margin-bottom: 0.5em; }
        .prose-luna ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.25em; }
        .prose-luna ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.25em; }
        .prose-luna li { margin-bottom: 0.25em; }
        .prose-luna code { background: rgba(255,255,255,0.1); padding: 0.2em 0.4em; border-radius: 4px; font-family: monospace; font-size: 0.9em; }
        .prose-luna pre { background: black !important; padding: 1em; border-radius: 0.5em; overflow-x: auto; margin-bottom: 1.25em; border: 1px solid #333; }
        .prose-luna pre code { background: transparent; padding: 0; border-radius: 0; color: inherit; }
        .prose-luna a { color: #10a37f; text-decoration: underline; }
    </style>
</div>
