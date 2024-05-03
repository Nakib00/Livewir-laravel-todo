<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <h1 class="text-white">Livewire Project</h1>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a wire:navigate href="{{ route('home') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium nav-link {{ Route::is('home') ? 'active' : '' }}">Home</a>
                        <a wire:navigate href="{{ route('about') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium nav-link {{ Route::is('about') ? 'active' : '' }}">About</a>
                        <a wire:navigate href="{{ route('contact') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium nav-link {{ Route::is('todoapp') ? 'active' : '' }}">Contact</a>
                        <a wire:navigate href="{{ route('todoapp') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium nav-link {{ Route::is('todoapp') ? 'active' : '' }}">Todo
                            app</a>
                        <a wire:navigate href="{{ route('user') }}"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">User</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>
