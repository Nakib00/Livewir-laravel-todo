<div class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex">
            <!-- Left Side: Product List -->
            <div class="w-3/4 pr-4">
                <div class="flex items-center justify-between mb-4 bg-gray-200 p-4 rounded-lg">
                    <!-- Heading with additional styles -->
                    <h2 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-300 pb-1">Products</h2>
                    <!-- Category Dropdown -->
                    <div class="relative">
                        <select wire:model.live="selectedCategory"
                            class="block appearance-none w-40 bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select All</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <!-- SVG icon -->
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-600">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path opacity="0.34"
                                        d="M5 10H7C9 10 10 9 10 7V5C10 3 9 2 7 2H5C3 2 2 3 2 5V7C2 9 3 10 5 10Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M17 10H19C21 10 22 9 22 7V5C22 3 21 2 19 2H17C15 2 14 3 14 5V7C14 9 15 10 17 10Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path opacity="0.34"
                                        d="M17 22H19C21 22 22 21 22 19V17C22 15 21 14 19 14H17C15 14 14 15 14 17V19C14 21 15 22 17 22Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M5 22H7C9 22 10 21 10 19V17C10 15 9 14 7 14H5C3 14 2 15 2 17V19C2 21 3 22 5 22Z"
                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-screen">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Sample Product Cards -->
                        @foreach ($products as $product)
                            <div
                                class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center justify-between hover:shadow-xl transition duration-300">
                                <div class="w-full h-40">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover rounded-t-md">
                                </div>
                                <div class="flex flex-col items-center justify-center my-4">
                                    <h3 class="text-lg font-semibold text-center">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mt-2">Price: {{ $product->price }} TK</p>
                                    <p class="text-gray-600 mt-2">Quantity: {{ $product->quantity }}</p>
                                </div>
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="px-3 py-1 bg-black text-white rounded-md hover:bg-gray-800 transition duration-300 flex items-center justify-center">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 mr-2">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M14 2C14 1.44772 13.5523 1 13 1C12.4477 1 12 1.44772 12 2V8.58579L9.70711 6.29289C9.31658 5.90237 8.68342 5.90237 8.29289 6.29289C7.90237 6.68342 7.90237 7.31658 8.29289 7.70711L12.2929 11.7071C12.6834 12.0976 13.3166 12.0976 13.7071 11.7071L17.7071 7.70711C18.0976 7.31658 18.0976 6.68342 17.7071 6.29289C17.3166 5.90237 16.6834 5.90237 16.2929 6.29289L14 8.58579V2ZM1 3C1 2.44772 1.44772 2 2 2H2.47241C3.82526 2 5.01074 2.90547 5.3667 4.21065L5.78295 5.73688L7.7638 13H18.236L20.2152 5.73709C20.3604 5.20423 20.9101 4.88998 21.4429 5.03518C21.9758 5.18038 22.29 5.73006 22.1448 6.26291L20.1657 13.5258C19.9285 14.3962 19.1381 15 18.236 15H8V16C8 16.5523 8.44772 17 9 17H16.5H18C18.5523 17 19 17.4477 19 18C19 18.212 18.934 18.4086 18.8215 18.5704C18.9366 18.8578 19 19.1715 19 19.5C19 20.8807 17.8807 22 16.5 22C15.1193 22 14 20.8807 14 19.5C14 19.3288 14.0172 19.1616 14.05 19H10.95C10.9828 19.1616 11 19.3288 11 19.5C11 20.8807 9.88071 22 8.5 22C7.11929 22 6 20.8807 6 19.5C6 18.863 6.23824 18.2816 6.63048 17.8402C6.23533 17.3321 6 16.6935 6 16V14.1339L3.85342 6.26312L3.43717 4.73688C3.31852 4.30182 2.92336 4 2.47241 4H2C1.44772 4 1 3.55228 1 3ZM16 19.5C16 19.2239 16.2239 19 16.5 19C16.7761 19 17 19.2239 17 19.5C17 19.7761 16.7761 20 16.5 20C16.2239 20 16 19.7761 16 19.5ZM8 19.5C8 19.2239 8.22386 19 8.5 19C8.77614 19 9 19.2239 9 19.5C9 19.7761 8.77614 20 8.5 20C8.22386 20 8 19.7761 8 19.5Z"
                                                fill="#ffffff"></path>
                                        </g>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        @endforeach
                        <!-- Repeat this card for each product -->
                    </div>
                </div>
            </div>


            <!-- Right Side: Cart -->
            <div class="w-1/4 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4 px-4 pt-4 border-b border-gray-200">Cart</h2>
                <div class="px-4 py-2 max-h-60 overflow-y-auto">
                    <!-- Sample Cart Items -->
                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between py-2 border-b border-gray-200">
                            <div>
                                <h3 class="text-base font-semibold">{{ $item['name'] }}</h3>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Quantity: </p>
                                    <!-- Decrease Quantity Button -->
                                    <button wire:click="decreaseQuantity({{ $item['id'] }})"
                                        class="px-2 text-gray-600 hover:text-gray-900">
                                        <svg fill="#2ca9bc" viewBox="0 0 24 24" id="decrease-circle"
                                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <line id="secondary" x1="16.24" y1="12" x2="7.76"
                                                    y2="12"
                                                    style="fill: none; stroke: #2ca9bc; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </line>
                                                <circle id="primary" cx="12" cy="12" r="9"
                                                    style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </circle>
                                            </g>
                                        </svg>
                                    </button>

                                    <!-- Display Quantity -->
                                    <p class="text-gray-600">{{ $item['quantity'] }}</p>
                                    <!-- Increase Quantity Button -->
                                    <button wire:click="increaseQuantity({{ $item['id'] }})"
                                        class="px-2 text-gray-600 hover:text-gray-900">
                                        <svg fill="#2ca9bc" viewBox="0 0 24 24" id="increase-circle"
                                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path id="secondary" d="M16,12H8m4-4v8"
                                                    style="fill: none; stroke: #2ca9bc; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </path>
                                                <circle id="primary" cx="12" cy="12" r="9"
                                                    style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                </circle>
                                            </g>
                                        </svg>
                                    </button>

                                </div>
                                <p class="text-gray-600">Unit Price: {{ $item['price'] }} TK</p>
                                <p class="text-gray-600">Total Price: {{ $item['quantity'] * $item['price'] }} TK</p>
                            </div>
                            <button wire:click="removeFromCart({{ $item['id'] }})"
                                class="text-red-500 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach

                    <!-- Repeat this for each item in the cart -->
                </div>

                <!-- Discount Input Field -->
                <div class="px-4 py-2 flex items-center justify-between">
                    <input type="text"
                        class="w-2/3 bg-gray-100 border border-gray-200 px-3 py-1 rounded-md focus:outline-none focus:ring-2 m-2 focus:ring-blue-500"
                        placeholder="Enter discount code">
                    <button
                        class="w-1/3 bg-blue-500 text-white py-1 rounded-md hover:bg-blue-600 transition duration-300">Apply</button>
                </div>
                <!-- Radio Buttons for Official Discounts -->
                <div class="px-4 py-2 flex justify-between items-center">
                    <p class="text-base font-semibold">Official Discount:</p>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" class="form-radio text-blue-500" name="official_discount"
                                value="civil" checked>
                            <span class="ml-2">Civil</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" class="form-radio text-blue-500" name="official_discount"
                                value="military">
                            <span class="ml-2">Military</span>
                        </label>
                    </div>
                </div>
                <div class="px-4 py-2 flex justify-between items-center">
                    <p class="text-base font-semibold">Grand Total:</p>
                    <p class="text-base font-semibold">{{ $totalPrice }} TK</p>
                    <!-- Calculate the total dynamically -->
                </div>
                {{-- all button --}}
                <div class="px-4 py-2">
                    {{-- Print button --}}
                    <button
                        class="w-full flex items-center justify-center bg-green-600 text-white py-2 m-2 rounded-md hover:bg-green-700 transition duration-300">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" height="24px"
                            width="24px">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path opacity="0.15" d="M20 9H4V18H8V15H16V18H20V9Z" fill="#ffffff"></path>
                                <path
                                    d="M16 18V15H8V18M16 18V21H8V18M16 18H20V9H16M8 18H4V9H8M8 9H16M8 9V4C8 3.44772 8.44772 3 9 3H15C15.5523 3 16 3.44772 16 4V9"
                                    stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        Print
                    </button>
                    {{-- Return calculator --}}
                    <button id="calculatorBtn"
                        class="w-full flex items-center justify-center bg-indigo-700 text-white py-2 m-2 rounded-md hover:bg-indigo-800 transition duration-300">
                        <svg viewBox="0 0 1024 1024" class="icon" fill="#000000" width="24px" height="24px">
                            <path
                                d="M478.104276 337.595469V184.66079L114.48369 442.197642l363.620586 257.597261V548.220967c145.529941 0.060409 280.456525 7.405763 394.534756 210.864063 0.001024-129.244021-21.321388-417.874222-394.534756-421.489561z"
                                fill="#000000"></path>
                            <path
                                d="M447.778841 307.270034V154.334331L84.158254 411.871182 447.778841 669.468444V517.894508c145.529941 0.060409 280.456525 7.405763 394.534756 210.864063 0-129.244021-21.322412-417.874222-394.534756-421.488537z"
                                fill="#ffffff"></path>
                            <path
                                d="M283.00269 350.410162a27.283472 57.977507 55.515 1 0 95.578754-65.652623 27.283472 57.977507 55.515 1 0-95.578754 65.652623Z"
                                fill="#FEFEFE"></path>
                            <path
                                d="M224.416795 445.822358a18.189323 31.830547 55.515 1 0 52.474213-36.044304 18.189323 31.830547 55.515 1 0-52.474213 36.044304Z"
                                fill="#FEFEFE"></path>
                        </svg>
                        Return
                    </button>

                    {{-- Button icon style start --}}
                    <style>
                        .icon {
                            width: 24px;
                            /* Adjust this value as needed */
                            height: 24px;
                            /* Adjust this value as needed */
                        }
                    </style>
                    {{-- Button icon style end --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Window -->
    <div id="popupWindow"
        class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg shadow-md relative">
            {{-- close icon --}}
            <span id="closePopupIcon"
                class="absolute top-0 right-2 text-gray-500 cursor-pointer hover:text-gray-700 text-2xl">&times;</span>
            {{-- total amount input fild --}}
            <input id="totalAmountInput" type="number"
                class="w-full mt-5 bg-gray-100 border border-gray-200 px-3 py-2 rounded-md mb-2"
                placeholder="Total Amount">
            {{-- customer amount --}}
            <input id="customerAmountInput" type="number"
                class="w-full bg-gray-100 border border-gray-200 px-3 py-2 rounded-md mb-2"
                placeholder="Customer Payable Amount">
            {{-- calcutate btn --}}
            <button id="calculateBtn"
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block align-middle -mt-0.5 me-1"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10 2c-4.411 0-8 3.589-8 8s3.589 8 8 8 8-3.589 8-8-3.589-8-8-8zm0 14c-3.313 0-6-2.687-6-6s2.687-6 6-6 6 2.687 6 6-2.687 6-6 6zm-3-9h2v2h-2v-2zm4 0h2v2h-2v-2zm-4 3h2v2h-2v-2zm4 0h2v2h-2v-2zm-4 3h2v2h-2v-2zm4 0h2v2h-2v-2z" />
                </svg>
                Calculate
            </button>


            {{-- shwo change amount --}}
            <p id="changeResult" class="text-lg font-bold mt-2 hidden">Change to be Returned: <span
                    id="changeAmount"></span></p>
        </div>
    </div>

    {{-- js --}}
    <script>
        const calculatorBtn = document.getElementById('calculatorBtn');
        const popupWindow = document.getElementById('popupWindow');
        const closePopupBtn = document.getElementById('closePopupIcon');
        const totalAmountInput = document.getElementById('totalAmountInput');
        const customerAmountInput = document.getElementById('customerAmountInput');
        const calculateBtn = document.getElementById('calculateBtn');
        const changeResult = document.getElementById('changeResult');
        const changeAmount = document.getElementById('changeAmount');

        calculatorBtn.addEventListener('click', () => {
            popupWindow.classList.remove('hidden');
        });

        closePopupBtn.addEventListener('click', () => {
            popupWindow.classList.add('hidden');
            totalAmountInput.value = '';
            customerAmountInput.value = '';
            changeResult.classList.add('hidden');
        });

        calculateBtn.addEventListener('click', () => {
            const totalAmount = parseFloat(totalAmountInput.value);
            const customerAmount = parseFloat(customerAmountInput.value);

            if (!isNaN(totalAmount) && !isNaN(customerAmount)) {
                const change = customerAmount - totalAmount;
                changeResult.classList.remove('hidden');
                changeAmount.textContent = change.toFixed(2);
            } else {
                alert('Please enter valid amounts.');
            }
        });
    </script>
</div>
