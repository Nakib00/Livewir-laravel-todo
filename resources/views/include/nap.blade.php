<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a wire:navigate class="navbar-brand" href="{{ route('home') }}">Livewire Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- Navigation --}}
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a wire:navigate class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                    href="{{ route('home') }}">Home</a>
                <a wire:navigate class="nav-link {{ Route::is('about') ? 'active' : '' }}"
                    href="{{ route('about') }}">About</a>
                <a wire:navigate class="nav-link {{ Route::is('contact') ? 'active' : '' }}"
                    href="{{ route('contact') }}">Contact</a>
                <a wire:navigate class="nav-link {{ Route::is('todoapp') ? 'active' : '' }}"
                    href="{{ route('todoapp') }}">Todo App</a>
            </div>
        </div>

    </div>
</nav>
