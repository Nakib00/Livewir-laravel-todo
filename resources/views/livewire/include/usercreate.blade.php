<div class="container content py-6 mx-auto">
    <div class=" items-center">
        <h1 class="text-center font-bold">Add User</h1>
    </div>
    <form class="w-full max-w-lg bg-white rounded-lg shadow-md px-8 pt-6 pb-8 mb-4">
        <!-- Profile Picture Upload -->
        <div class="mb-6">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="profile-picture">
                Profile Picture
            </label>
            <input wire:model='image' type="file" id="profile-picture" name="profile-picture" accept="image/*">
            {{-- Show image --}}
            @if ($image)
                <img class="w-20 h-20 rounded m-2" src="{{ $image->temporaryUrl() }}" alt="">
            @endif

            <!-- Validation Message -->
            @error('image')
                <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
            @enderror
        </div>
        <!-- First Name and Last Name -->
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    First Name
                </label>
                <input wire:model='fname'
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-first-name" type="text" placeholder="Jane">
                <!-- Validation Message -->
                @error('fname')
                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Last Name
                </label>
                <input wire:model='lname'
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-last-name" type="text" placeholder="Doe">
                <!-- Validation Message -->
                @error('lname')
                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Email -->
        <div class="mb-6">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">
                Email
            </label>
            <input wire:model='email'
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-email" type="email" placeholder="example@example.com">
            <!-- Validation Message -->
            @error('email')
                <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
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
