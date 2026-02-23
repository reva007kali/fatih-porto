<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="font-bold text-3xl text-white tracking-tight">
                {{ __('Contact Messages') }}
            </h2>
            <p class="text-sm text-gray-400 mt-2">Inquiries from your website visitors.</p>
        </div>

        <div class="grid grid-cols-1">
            {{-- List Section --}}
            <div class="col-span-1">
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
                                    <th class="px-6 py-4">Sender</th>
                                    <th class="px-6 py-4">Subject</th>
                                    <th class="px-6 py-4">Message</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($messages as $message)
                                    <tr class="hover:bg-white/[0.02] transition-colors group {{ !$message->is_read ? 'bg-white/[0.02]' : '' }}">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-swiss-blue to-purple-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                    {{ substr($message->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-white text-sm {{ !$message->is_read ? 'text-swiss-blue' : '' }}">
                                                        {{ $message->name }}
                                                        @if(!$message->is_read)
                                                            <span class="ml-2 inline-block w-2 h-2 rounded-full bg-swiss-blue"></span>
                                                        @endif
                                                    </h4>
                                                    <p class="text-xs text-gray-500">{{ $message->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-300 font-medium">{{ $message->subject }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed max-w-md">{{ $message->message }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs text-gray-500 whitespace-nowrap">{{ $message->created_at->format('M d, Y') }}</span>
                                            <span class="text-[10px] text-gray-600 block">{{ $message->created_at->format('h:i A') }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                @if(!$message->is_read)
                                                    <button wire:click="markAsRead({{ $message->id }})" 
                                                        class="p-2 rounded-lg bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all" title="Mark as Read">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                                                        </svg>
                                                    </button>
                                                @endif
                                                <button wire:click="delete({{ $message->id }})" wire:confirm="Are you sure?"
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mb-3">
                                                    <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-500 text-sm">No messages yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
