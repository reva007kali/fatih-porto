<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Media Gallery</h2>

                {{-- Toolbar --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    {{-- Breadcrumbs --}}
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            @foreach($breadcrumbs as $breadcrumb)
                                <li class="inline-flex items-center">
                                    @if(!$loop->last)
                                        <button wire:click="navigate('{{ $breadcrumb['path'] }}')" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                            {{ $breadcrumb['name'] ?: 'Home' }}
                                        </button>
                                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                    @else
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $breadcrumb['name'] ?: 'Home' }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2">
                        <form wire:submit.prevent="createFolder" class="flex gap-2">
                            <input type="text" wire:model="newFolderName" placeholder="New Folder Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
                        </form>
                        
                        <div class="relative">
                            <input type="file" wire:model="uploadedFiles" multiple class="hidden" id="file-upload">
                            <label for="file-upload" class="cursor-pointer text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                Upload Files
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Messages --}}
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @error('newFolderName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('uploadedFiles.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                {{-- Sorting Controls --}}
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sort by:</span>
                    <button wire:click="sortBy('last_modified')" class="text-xs font-bold uppercase tracking-wider {{ $sortField === 'last_modified' ? 'text-orange-500' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        Date {!! $sortField === 'last_modified' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                    </button>
                    <button wire:click="sortBy('name')" class="text-xs font-bold uppercase tracking-wider {{ $sortField === 'name' ? 'text-orange-500' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        Name {!! $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                    </button>
                    <button wire:click="sortBy('size')" class="text-xs font-bold uppercase tracking-wider {{ $sortField === 'size' ? 'text-orange-500' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        Size {!! $sortField === 'size' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                    </button>
                </div>

                {{-- File Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4"
                     x-data
                     @dragover.prevent="$el.classList.add('border-2', 'border-dashed', 'border-blue-500')"
                     @dragleave.prevent="$el.classList.remove('border-2', 'border-dashed', 'border-blue-500')"
                     @drop.prevent="$el.classList.remove('border-2', 'border-dashed', 'border-blue-500'); $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))">
                    
                    {{-- Hidden input for drag and drop --}}
                    <input type="file" wire:model="uploadedFiles" multiple class="hidden" x-ref="fileInput">

                    {{-- Folders --}}
                    @if($currentPath)
                        <div wire:click="goUp" class="cursor-pointer p-4 bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            <span class="text-sm font-medium text-center">..</span>
                        </div>
                    @endif

                    @foreach($directories as $directory)
                        @php
                            $dirName = basename($directory);
                            // Avoid showing .git or sensitive folders if any (though usually not in public)
                        @endphp
                        <div class="group relative p-4 bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <div wire:click="navigate('{{ $directory }}')" class="cursor-pointer flex flex-col items-center w-full">
                                <svg class="w-12 h-12 text-yellow-500 mb-2" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                <span class="text-sm font-medium text-center truncate w-full" title="{{ $dirName }}">{{ $dirName }}</span>
                            </div>
                            <button wire:click="deleteFolder('{{ $directory }}')" wire:confirm="Are you sure you want to delete this folder? It must be empty." class="absolute top-2 right-2 text-red-500 opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endforeach

                    {{-- Files --}}
                    @foreach($files as $file)
                        @php
                            $fileName = $file['name'];
                            $filePath = $file['path'];
                            $fileSize = $file['size'];
                            $fileDate = $file['last_modified'];
                            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg', 'mov', 'avi']);
                        @endphp
                        <div class="group relative p-2 bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <div class="w-full aspect-square mb-2 overflow-hidden rounded-md bg-gray-200 dark:bg-gray-900 flex items-center justify-center relative">
                                @if($isImage)
                                    <img src="{{ Storage::url($filePath) }}" alt="{{ $fileName }}" class="object-cover w-full h-full cursor-pointer" onclick="window.open('{{ Storage::url($filePath) }}', '_blank')">
                                @elseif($isVideo)
                                    <div class="relative w-full h-full cursor-pointer" onclick="window.open('{{ Storage::url($filePath) }}', '_blank')">
                                        <video src="{{ Storage::url($filePath) }}" class="object-cover w-full h-full"></video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition">
                                            <svg class="w-8 h-8 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs uppercase font-bold text-gray-500">{{ $ext }}</span>
                                @endif
                                
                                <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-[10px] p-1 opacity-0 group-hover:opacity-100 transition text-center">
                                    {{ $fileSize }}
                                </div>
                            </div>
                            <div class="w-full text-center">
                                <span class="text-xs font-medium truncate block w-full text-gray-700 dark:text-gray-200" title="{{ $fileName }}">{{ $fileName }}</span>
                                <span class="text-[10px] text-gray-500 dark:text-gray-400 block">{{ $fileDate }}</span>
                            </div>
                            
                            <button wire:click="deleteFile('{{ $filePath }}')" wire:confirm="Are you sure you want to delete this file?" class="absolute top-2 right-2 bg-white/80 dark:bg-black/80 rounded-full p-1 text-red-500 opacity-0 group-hover:opacity-100 transition shadow-sm z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                @if(count($directories) === 0 && count($files) === 0)
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        This folder is empty. Drag and drop files to upload.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
