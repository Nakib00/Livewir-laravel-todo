<div>
    {{-- include alirt --}}
    @include('livewire.include.alirt')

    {{-- Add product input form --}}
    <div class="container content py-2 mx-auto">
        <div class="items-center">
            <h1 class="text-center font-bold">Add Product</h1>
        </div>
        <form wire:submit.prevent="create" class="w-full max-w-lg bg-white rounded-lg shadow-md px-8 pt-6 pb-8 mb-4">
            <!-- Profile Picture Upload -->
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">
                    Image
                </label>
                <input wire:model="image" type="file" id="image" name="image" accept="image/*">
                <!-- Show image -->
                @if ($image)
                    <img class="w-20 h-20 rounded m-2" src="{{ $image->temporaryUrl() }}" alt="">
                @endif

                <!-- Validation Message -->
                @error('image')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
            </div>
            <!-- Name -->
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Name
                </label>
                <input wire:model.lazy="name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="name" type="text" placeholder="Product Name">
                <!-- Validation Message -->
                @error('name')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
            </div>
            <!-- Price -->
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                    Price
                </label>
                <input wire:model.lazy="price"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="price" type="text" placeholder="Price">
                <!-- Validation Message -->
                @error('price')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
            </div>
            <!-- Quantity -->
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quantity">
                    Quantity
                </label>
                <input wire:model.lazy="quantity"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="quantity" type="text" placeholder="Quantity">
                <!-- Validation Message -->
                @error('quantity')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
            </div>
            <!-- Category Dropdown -->
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category">
                    Category
                </label>
                <select wire:model.lazy="category_id"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="category">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <!-- Validation Message -->
                @error('category_id')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button wire:click.prevent='create' type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                    Submit
                </button>
            </div>
        </form>
    </div>

    {{-- Shwo product list --}}
    <div class="container mx-auto">
        <h1 class="text-center font-bold text-2xl mb-4">Product List</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($editid === $product->id)
                                <input type="text" wire:model="editname" class="border rounded px-2 py-1">
                                {{-- if any error happened then show error message --}}
                                @error('editname')
                                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                                @enderror
                            @else
                                {{ $product->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="h-8 w-8">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($editid === $product->id)
                                <input type="text" wire:model="editprice" class="border rounded px-2 py-1">
                                {{-- if any error happened then show error message --}}
                                @error('editprice')
                                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                                @enderror
                            @else
                                {{ $product->price }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($editid === $product->id)
                                <input type="text" wire:model="editquantity" class="border rounded px-2 py-1">
                                {{-- if any error happened then show error message --}}
                                @error('editquantity')
                                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                                @enderror
                            @else
                                {{ $product->quantity }}
                            @endif
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleStatus({{ $product->id }})"
                                class="px-2 py-1 rounded-full {{ $product->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($editid === $product->id)
                                <button wire:click="update" class="text-green-600 hover:text-green-900">Update</button>
                                <button wire:click="cancelEdit"
                                    class="text-red-600 hover:text-red-900">Cancel</button>
                            @else
                                <button wire:click="edit({{ $product->id }})"
                                    class="text-blue-600 hover:text-blue-900">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $product->id }})"
                                    class="text-red-600 hover:text-red-900 ml-2">
                                    Delete
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
