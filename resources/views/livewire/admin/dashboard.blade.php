<div class="space-y-6">
    {{-- Top Stats Grid (Bento Style) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Total Projects --}}
        <div
            class="bg-[#1c1c1e] p-6 rounded-3xl border border-white/5 hover:border-swiss-blue/50 transition-colors group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Projects</p>
                    <h3 class="text-3xl font-black text-white">{{ $totalProjects }}</h3>
                </div>
                <div
                    class="p-3 rounded-2xl bg-swiss-blue/10 text-swiss-blue group-hover:bg-swiss-blue group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Websites --}}
        <div
            class="bg-[#1c1c1e] p-6 rounded-3xl border border-white/5 hover:border-purple-500/50 transition-colors group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Websites</p>
                    <h3 class="text-3xl font-black text-white">{{ $totalWebsites }}</h3>
                </div>
                <div
                    class="p-3 rounded-2xl bg-purple-500/10 text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Services --}}
        <div
            class="bg-[#1c1c1e] p-6 rounded-3xl border border-white/5 hover:border-orange-500/50 transition-colors group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Services</p>
                    <h3 class="text-3xl font-black text-white">{{ $totalServices }}</h3>
                </div>
                <div
                    class="p-3 rounded-2xl bg-orange-500/10 text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Messages --}}
        <div
            class="bg-[#1c1c1e] p-6 rounded-3xl border border-white/5 hover:border-green-500/50 transition-colors group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Messages</p>
                    <h3 class="text-3xl font-black text-white">{{ $totalMessages }}</h3>
                </div>
                <div
                    class="p-3 rounded-2xl bg-green-500/10 text-green-500 group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Middle Section: Visitors & Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Visitor Stats --}}
        <div class="lg:col-span-2 bg-[#1c1c1e] p-8 rounded-3xl border border-white/5 relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-white">Visitor Statistics</h3>
                        <p class="text-sm text-gray-500">Weekly traffic overview (Total: {{ $visitorCount }})</p>
                    </div>
                </div>

                {{-- Chart --}}
                <div class="flex items-end justify-between gap-2 h-48 w-full">
                    @foreach ($visitorChartData as $height)
                        <div class="w-full bg-white/5 rounded-t-xl hover:bg-swiss-blue/50 transition-colors relative group"
                            style="height: {{ $height > 0 ? ($height / max($visitorChartData)) * 100 : 0 }}%">
                            <div
                                class="absolute -top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                {{ $height }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between mt-4 text-xs text-gray-500 font-bold uppercase tracking-wider">
                    @foreach ($visitorChartLabels as $label)
                        <span>{{ $label }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Background decoration --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-swiss-blue/5 blur-3xl rounded-full pointer-events-none">
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-[#1c1c1e] p-8 rounded-3xl border border-white/5 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Quick Actions</h3>
                <p class="text-sm text-gray-500 mb-6">Manage your content efficiently</p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('admin.projects') }}"
                    class="flex items-center justify-between p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all group">
                    <span class="font-medium text-white">Add New Project</span>
                    <span
                        class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-swiss-blue transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                </a>

                <a href="{{ route('admin.websites') }}"
                    class="flex items-center justify-between p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all group">
                    <span class="font-medium text-white">Add New Website</span>
                    <span
                        class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-purple-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom Section: Recent Messages --}}
    <div class="bg-[#1c1c1e] rounded-3xl border border-white/5 overflow-hidden">
        <div class="p-8 border-b border-white/5 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white">Incoming Messages</h3>
                <p class="text-sm text-gray-500">Recent inquiries from contact form</p>
            </div>
            <a href="{{ route('admin.messages') }}"
                class="text-sm font-bold text-swiss-blue hover:text-white transition-colors">View All &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-xs font-bold uppercase tracking-wider text-gray-400">
                    <tr>
                        <th class="px-8 py-4">Name</th>
                        <th class="px-8 py-4">Subject</th>
                        <th class="px-8 py-4">Date</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($recentMessages as $message)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center text-xs font-bold text-white">
                                        {{ substr($message->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-sm">{{ $message->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $message->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-sm text-gray-300">
                                {{ Str::limit($message->subject ?? 'No Subject', 30) }}
                            </td>
                            <td class="px-8 py-4 text-sm text-gray-500">
                                {{ $message->created_at->diffForHumans() }}
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="{{ route('admin.messages') }}"
                                    class="text-xs font-bold text-swiss-blue hover:underline">Read</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-8 text-center text-gray-500">
                                No new messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
