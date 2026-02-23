<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">3D Models Gallery</h2>
            <a href="{{ route('admin.three-d.create') }}" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                + Upload New Model
            </a>
        </div>

        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($models as $model)
                <div class="bg-white dark:bg-zinc-900 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800">
                    <div class="relative aspect-video bg-gray-100 dark:bg-zinc-800 flex items-center justify-center">
                        @if($model->thumbnail_path)
                            <img src="{{ Storage::url($model->thumbnail_path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl">📦</span>
                        @endif
                        
                        <div class="absolute top-2 right-2">
                            <button wire:click="toggleActive({{ $model->id }})" 
                                class="px-2 py-1 text-xs font-bold rounded-full {{ $model->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $model->is_active ? 'Active' : 'Draft' }}
                            </button>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $model->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">{{ $model->description }}</p>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-zinc-800">
                            <span class="text-xs text-gray-400">{{ $model->created_at->format('M d, Y') }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.three-d.edit', $model->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                                <button wire:click="delete({{ $model->id }})" wire:confirm="Are you sure?" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($models->isEmpty())
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                No 3D models found. Upload one to get started.
            </div>
        @endif
    </div>
</div>
