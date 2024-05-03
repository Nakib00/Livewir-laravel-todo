<div>
    {{-- include alirt --}}
    @include('livewire.include.alirt')

    {{-- Creat category box --}}
    <div class="container content py-6 mx-auto">
        <div class="mx-auto">
            <div id="create-form" class="hover:shadow p-6 bg-white border-blue-500 border-t-2">
                <div class="flex ">
                    <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Category</h2>
                </div>
                <div>
                    <form>
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                Category </label>
                            {{-- input fild --}}
                            <input wire:model="name" type="text" id="title" placeholder="Category.."
                                class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                            {{-- if any error happened then show error message --}}
                            @error('name')
                                <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                            @enderror

                        </div>
                        {{-- created button --}}
                        <button wire:click.prevent='create' type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Create
                            +</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- shwo all category list --}}
    <div>
        <h1 class="text-center font-bold">Category List</h1>

        <table class="min-w-full divide-y divide-gray-800">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Created At</th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Status</th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($category as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            @if ($editingItemId === $item->id)
                                <input type="text" wire:model="editingName" class="border rounded px-2 py-1">
                                {{-- if any error happened then show error message --}}
                                @error('editingName')
                                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                                @enderror
                            @else
                                {{ $item->name }}
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap">{{ $item->created_at->format('M d, Y') }}</td>

                        <td class="px-6 py-4 whitespace-no-wrap cursor-pointer"
                            wire:click="toggleStatus({{ $item->id }})"
                            :class="{ 'bg-green-200': {{ $item->status }} == 1, 'bg-red-200': {{ $item->status }} == 0 }">
                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                        </td>

                        {{-- show this button when click the edit --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            @if ($editingItemId === $item->id)
                                <button wire:click="update" class="text-green-600 hover:text-green-900">Update</button>
                                <button wire:click="cancelEdit" class="text-red-600 hover:text-red-900">Cancel</button>
                            @else
                                <button wire:click="edit({{ $item->id }})"
                                    class="text-blue-600 hover:text-blue-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 11.707a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414l-5 5a1 1 0 01-1.414 0zm7.414-3.414a1 1 0 10-1.414-1.414l-5 5a1 1 0 001.414 1.414l5-5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $item->id }})"
                                    class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l3.293-3.293a1 1 0 111.414 1.414L11.414 11l3.293 3.293a1 1 0 01-1.414 1.414L10 12.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 11 5.293 7.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- pagination --}}
        <div class="my-2">
            <!-- Pagination goes here -->
            {{ $category->links() }}
        </div>
    </div>

</div>
