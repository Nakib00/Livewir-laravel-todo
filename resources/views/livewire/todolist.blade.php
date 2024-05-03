<div>
    {{-- include alirt --}}
    @include('livewire.include.alirt')
    {{-- include create todo box --}}
    @include('livewire.include.creat-todo-box')
    {{-- include search box --}}
    @include('livewire.include.search-box')
    {{-- include show todo card --}}
    <div id="todos-list">
        @foreach ($todolist as $todo)
            @include('livewire.include.todo-card')
        @endforeach
        {{-- show pagination --}}
        <div class="my-2">
            <!-- Pagination goes here -->
            {{ $todolist->links() }}
        </div>
    </div>
</div>
