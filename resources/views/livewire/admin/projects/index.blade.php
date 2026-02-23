<div class="min-h-screen py-6 bg-[#0b0b0d]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="font-bold text-3xl text-white tracking-tight">
                    {{ __('Manage Projects') }}
                </h2>
                <p class="text-sm text-gray-400 mt-2">Showcase your best work and case studies.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="px-6 py-3 bg-white text-black text-sm font-bold uppercase tracking-wider rounded-xl hover:bg-gray-200 transition-all active:scale-95 shadow-lg shadow-white/10">
                + Add Project
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
                            <th class="px-6 py-4">Project</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Media</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-lg bg-[#0b0b0d] border border-white/10 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            @if ($project->image)
                                                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                                            @elseif ($project->media->where('file_type', 'image')->first())
                                                <img src="{{ asset('storage/' . $project->media->where('file_type', 'image')->first()->file_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xs font-bold text-gray-600">N/A</span>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-white text-sm">{{ $project->title }}</span>
                                            <span class="text-xs text-gray-500">{{ Str::limit($project->description, 40) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-medium text-gray-400 bg-white/5 px-2 py-1 rounded">{{ $project->category ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1 text-xs text-gray-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $project->media->count() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        @if($project->is_featured)
                                            <span class="inline-flex items-center text-[10px] font-bold text-yellow-500 uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span> Featured
                                            </span>
                                        @endif
                                        @if($project->is_archived)
                                            <span class="inline-flex items-center text-[10px] font-bold text-gray-500 uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 mr-1.5"></span> Archived
                                            </span>
                                        @endif
                                        @if(!$project->is_featured && !$project->is_archived)
                                            <span class="inline-flex items-center text-[10px] font-bold text-green-500 uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Active
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                            class="p-2 rounded-lg bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button wire:click="delete({{ $project->id }})" wire:confirm="Delete project?"
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    No projects found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
