<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Website Settings
            </h2>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @if (session()->has('message'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit="save" class="space-y-6">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Site Name
                    </label>
                    <input type="text" id="site_name" wire:model="site_name"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-cyan-500 focus:ring-cyan-500">
                    @error('site_name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Meta Description -->
                <div>
                    <label for="meta_description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Meta Description
                    </label>
                    <textarea id="meta_description" wire:model="meta_description" rows="3"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-cyan-500 focus:ring-cyan-500"></textarea>
                    @error('meta_description')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Favicon Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Favicon (Recommended: 32x32 PNG)
                    </label>

                    <div class="flex items-center gap-6 mt-2">
                        @if ($existing_favicon && !$favicon)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $existing_favicon) }}"
                                    class="w-8 h-8 object-contain bg-gray-100 dark:bg-gray-700 rounded p-1">
                                <p class="text-xs text-gray-500 mt-1">Current</p>
                            </div>
                        @endif

                        @if ($favicon)
                            <div class="relative">
                                <img src="{{ $favicon->temporaryUrl() }}"
                                    class="w-8 h-8 object-contain bg-gray-100 dark:bg-gray-700 rounded p-1 border-2 border-cyan-500">
                                <p class="text-xs text-cyan-500 mt-1">New</p>
                            </div>
                        @endif

                        <div class="flex-1">
                            <input type="file" wire:model="favicon" accept="image/png,image/jpeg,image/x-icon"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-cyan-50 file:text-cyan-700
                                hover:file:bg-cyan-100
                                dark:file:bg-cyan-900/30 dark:file:text-cyan-300">
                            <div wire:loading wire:target="favicon" class="text-xs text-cyan-500 mt-1">Uploading...
                            </div>
                        </div>
                    </div>
                    @error('favicon')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Logo (Recommended: SVG or Transparent PNG)
                    </label>

                    <div class="flex items-center gap-6 mt-2">
                        @if ($existing_logo && !$logo)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $existing_logo) }}"
                                    class="h-12 object-contain bg-gray-100 dark:bg-gray-700 rounded p-2">
                                <p class="text-xs text-gray-500 mt-1">Current</p>
                            </div>
                        @endif

                        @if ($logo)
                            <div class="relative">
                                <img src="{{ $logo->temporaryUrl() }}"
                                    class="h-12 object-contain bg-gray-100 dark:bg-gray-700 rounded p-2 border-2 border-cyan-500">
                                <p class="text-xs text-cyan-500 mt-1">New</p>
                            </div>
                        @endif

                        <div class="flex-1">
                            <input type="file" wire:model="logo"
                                accept="image/png,image/jpeg,image/svg+xml,image/webp"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-cyan-50 file:text-cyan-700
                                hover:file:bg-cyan-100
                                dark:file:bg-cyan-900/30 dark:file:text-cyan-300">
                            <div wire:loading wire:target="logo" class="text-xs text-cyan-500 mt-1">Uploading...</div>
                        </div>
                    </div>
                    @error('logo')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                        class="px-6 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white font-medium rounded-lg transition-colors shadow-lg shadow-cyan-500/30 flex items-center gap-2">
                        <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span wire:loading.remove>Save Settings</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
