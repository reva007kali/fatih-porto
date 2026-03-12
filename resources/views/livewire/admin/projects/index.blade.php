<div class="min-h-screen py-6 bg-[#0b0b0d]">
    {{-- SortableJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="font-bold text-3xl text-white tracking-tight">
                    {{ __('Manage Projects') }}
                </h2>
                <p class="text-sm text-gray-400 mt-2">
                    @if ($sortField === 'sort_order')
                        <span class="text-orange-500 font-bold">● Drag Mode Active:</span> Move projects to change
                        display priority.
                    @else
                        <span class="text-blue-400 font-bold">● View Mode:</span> Sorting by {{ $sortField }}.
                        Dragging disabled.
                    @endif
                </p>
            </div>
            <a href="{{ route('admin.projects.create') }}"
                class="px-6 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 shadow-lg shadow-white/10 text-center">
                + Add Project
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-500 text-sm font-bold flex items-center shadow-lg shadow-green-900/10">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- Table Container --}}
        <div class="bg-[#1c1c1e] border border-white/5 rounded-3xl overflow-hidden shadow-xl shadow-black/20">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead
                        class="bg-white/5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 border-b border-white/5">
                        <tr>
                            {{-- Handle Column Header --}}
                            <th class="px-4 py-5 w-12 text-center">
                                @if ($sortField === 'sort_order')
                                    <svg class="w-4 h-4 mx-auto opacity-30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 19v-2h10v2H7zm0-6h10v2H7v-2zm0-6h10v2H7V7z" />
                                    </svg>
                                @endif
                            </th>

                            {{-- Sortable Headers --}}
                            <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors"
                                wire:click="sortBy('title')">
                                <div class="flex items-center gap-2">
                                    Project
                                    @if ($sortField === 'title')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>

                            <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors"
                                wire:click="sortBy('sort_order')">
                                <div class="flex items-center gap-2">
                                    Order
                                    @if ($sortField === 'sort_order')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>

                            <th class="px-6 py-5">Category</th>

                            <th class="px-6 py-5 cursor-pointer hover:text-white transition-colors"
                                wire:click="sortBy('created_at')">
                                <div class="flex items-center gap-2">
                                    Date
                                    @if ($sortField === 'created_at')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>

                            <th class="px-6 py-5">Status</th>
                            <th class="px-6 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-body">
                        @forelse ($projects as $project)
                            <tr wire:key="proj-{{ $project->id }}" data-id="{{ $project->id }}"
                                class="hover:bg-white/[0.03] transition-colors group border-b border-white/5 last:border-0 draggable-row">

                                {{-- Drag Handle Column --}}
                                <td class="px-4 py-4 text-center">
                                    @if ($sortField === 'sort_order')
                                        <div
                                            class="drag-handle cursor-grab active:cursor-grabbing text-gray-700 hover:text-orange-500 transition-colors">
                                            <svg class="w-6 h-6 mx-auto" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 8h16M4 16h16" />
                                            </svg>
                                        </div>
                                    @else
                                        <span class="text-gray-800 text-xs">—</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[#0b0b0d] border border-white/10 overflow-hidden flex-shrink-0">
                                            @php
                                                $displayImage = $project->cover_image ?? $project->image;
                                            @endphp
                                            @if ($displayImage)
                                                <img src="{{ asset('storage/' . $displayImage) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-[8px] text-gray-600">
                                                    N/A</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white text-sm">{{ $project->title }}</span>
                                            <span
                                                class="text-[10px] text-gray-500 uppercase tracking-widest">{{ $project->client ?? 'No Client' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-xs font-mono text-gray-400">#{{ $project->sort_order }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-tighter text-gray-400 bg-white/5 px-2 py-1 rounded">
                                        {{ $project->category ?? 'General' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-xs text-gray-500 font-medium">
                                    {{ $project->created_at->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($project->is_featured)
                                        <span
                                            class="px-2 py-1 rounded-md bg-orange-500/10 text-orange-500 text-[9px] font-black uppercase tracking-widest">Featured</span>
                                    @elseif($project->is_archived)
                                        <span
                                            class="px-2 py-1 rounded-md bg-white/5 text-gray-500 text-[9px] font-black uppercase tracking-widest">Archived</span>
                                    @else
                                        <span
                                            class="px-2 py-1 rounded-md bg-green-500/10 text-green-500 text-[9px] font-black uppercase tracking-widest">Active</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}"
                                            class="p-2 text-blue-400 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button wire:click="delete({{ $project->id }})" wire:confirm="Confirm delete?"
                                            class="p-2 text-red-400 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-6 py-20 text-center text-gray-600 uppercase text-[10px] font-black tracking-[0.2em]">
                                    No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Script with Logic to toggle SortableJS based on sortField --}}
    <script>
        document.addEventListener('livewire:navigated', () => {
            const el = document.getElementById('sortable-body');
            const isManualSort = @js($sortField === 'sort_order');

            if (el && isManualSort) {
                Sortable.create(el, {
                    handle: '.drag-handle',
                    animation: 250,
                    ghostClass: 'bg-orange-500/10',
                    chosenClass: 'bg-orange-500/5',
                    onEnd: function() {
                        let items = Array.from(el.querySelectorAll('.draggable-row')).map((row,
                            index) => {
                                return {
                                    id: row.getAttribute('data-id'),
                                    order: index + 1
                                };
                            });
                        @this.updateOrder(items);
                    },
                });
            }
        });
    </script>

    <style>
        /* Modern Ghost effect */
        .sortable-ghost {
            opacity: 0.3;
            background: #f97316 !important;
        }
    </style>
</div>
