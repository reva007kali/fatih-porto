<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="font-bold text-3xl text-white tracking-tight">
                    {{ __('Manage Websites') }}
                </h2>
                <p class="text-sm text-gray-400 mt-2">Create and manage your landing pages and websites.</p>
            </div>
            <a href="{{ route('admin.websites.create') }}" class="px-6 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 shadow-lg shadow-white/10">
                + Add Website
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-500 text-sm font-bold flex items-center shadow-lg shadow-green-900/10">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- List Section --}}
        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-xs font-bold uppercase tracking-wider text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Website</th>
                            <th class="px-6 py-4">Tags</th>
                            <th class="px-6 py-4">Links</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($websites as $website)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-lg bg-[#0b0b0d] border border-white/10 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            @if ($website->image)
                                                <img src="{{ asset('storage/' . $website->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-[10px] font-bold text-gray-600">No Img</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white text-sm">{{ $website->title }}</h4>
                                            <p class="text-xs text-gray-500">/{{ $website->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @if($website->tags)
                                            @foreach($website->tags as $tag)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white/5 text-gray-400 border border-white/5">{{ $tag }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ url('websites/' . $website->slug) }}" target="_blank" 
                                        class="text-xs font-bold text-swiss-blue hover:text-white flex items-center gap-1 transition-colors">
                                        View Live
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.websites.edit', $website->id) }}" 
                                            class="p-2 rounded-lg bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button wire:click="delete({{ $website->id }})" wire:confirm="Delete website?"
                                            class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No websites found. Add one to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
