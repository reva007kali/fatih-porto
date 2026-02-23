<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h2 class="font-bold text-3xl text-white tracking-tight">
                    {{ __('Leads Management') }}
                </h2>
                <p class="text-sm text-gray-400 mt-2">Potential clients captured by AI Assistant.</p>
            </div>

            <div class="flex gap-4">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search leads..."
                    class="bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-2 text-sm text-white focus:ring-2 focus:ring-swiss-blue focus:border-transparent outline-none transition-all w-64">

                <select wire:model.live="statusFilter"
                    class="bg-[#1c1c1e] border border-white/10 rounded-xl px-4 py-2 text-sm text-white focus:ring-2 focus:ring-swiss-blue focus:border-transparent outline-none transition-all">
                    <option value="">All Status</option>
                    <option value="new">New</option>
                    <option value="read">Read</option>
                    <option value="contacted">Contacted</option>
                    <option value="converted">Converted</option>
                    <option value="lost">Lost</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1">
            {{-- List Section --}}
            <div class="col-span-1">
                <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
                    @if (session()->has('message'))
                        <div
                            class="p-4 bg-green-500/10 border-b border-green-500/20 text-green-500 text-sm font-bold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-xs font-bold uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-6 py-4">Lead Info</th>
                                    <th class="px-6 py-4">Project Details</th>
                                    <th class="px-6 py-4">AI Notes</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Time</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($leads as $lead)
                                    <tr
                                        class="hover:bg-white/[0.02] transition-colors group {{ $lead->status == 'new' ? 'bg-swiss-blue/5' : '' }}">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-lg shadow-orange-500/20">
                                                    {{ substr($lead->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-white text-sm">
                                                        {{ $lead->name }}
                                                        @if ($lead->status == 'new')
                                                            <span
                                                                class="ml-2 inline-block px-1.5 py-0.5 rounded text-[10px] bg-swiss-blue text-white">NEW</span>
                                                        @endif
                                                    </h4>
                                                    <p class="text-xs text-gray-400 font-mono mt-0.5">
                                                        {{ $lead->contact }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="space-y-1">
                                                <span
                                                    class="text-xs font-bold text-orange-400 uppercase tracking-wider block">{{ $lead->project_type }}</span>
                                                <p class="text-xs text-gray-300">Budget: <span
                                                        class="text-white">{{ $lead->budget_range }}</span></p>
                                                <p class="text-xs text-gray-400 line-clamp-2 mt-1">
                                                    {{ $lead->project_description }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-xs text-gray-500 italic border-l-2 border-white/10 pl-2">
                                                {{ $lead->ai_notes }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusColors = [
                                                    'new' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                                    'read' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                                    'contacted' =>
                                                        'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                                    'converted' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                                    'lost' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                                ];
                                                $colorClass =
                                                    $statusColors[$lead->status] ?? 'bg-gray-500/10 text-gray-400';
                                            @endphp
                                            <span
                                                class="px-2 py-1 rounded text-xs font-medium border {{ $colorClass }} uppercase tracking-wider">
                                                {{ $lead->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-xs text-gray-500 whitespace-nowrap">{{ $lead->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-xs text-gray-400 font-mono">{{ $lead->created_at->format('H:i:s') }}</span>
                                            <span
                                                class="text-[10px] text-gray-600 block">{{ $lead->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                @if ($lead->status == 'new')
                                                    <button wire:click="markAsRead({{ $lead->id }})"
                                                        class="p-2 rounded-lg bg-gray-500/10 text-gray-400 hover:bg-gray-500 hover:text-white transition-all"
                                                        title="Mark as Read">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                @if ($lead->status != 'contacted')
                                                    <button wire:click="markAsContacted({{ $lead->id }})"
                                                        class="p-2 rounded-lg bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500 hover:text-white transition-all"
                                                        title="Mark as Contacted">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </button>
                                                @endif

                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->contact) }}"
                                                    target="_blank"
                                                    class="p-2 rounded-lg bg-green-500/10 text-green-500 hover:bg-green-500 hover:text-white transition-all"
                                                    title="WhatsApp">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                                    </svg>
                                                </a>

                                                <button wire:click="delete({{ $lead->id }})"
                                                    wire:confirm="Are you sure you want to delete this lead?"
                                                    class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all"
                                                    title="Delete">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mb-3">
                                                    <svg class="w-6 h-6 text-gray-500" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-500 text-sm">No leads captured yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($leads->hasPages())
                        <div class="px-6 py-4 border-t border-white/5 bg-white/[0.02]">
                            {{ $leads->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
