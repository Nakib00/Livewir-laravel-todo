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
                                    class="px-3
                                    py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition
                                    duration-300">Add
                                    to Cart</button>
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
                                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
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
                    <p class="text-base font-semibold">100 TK</p>
                    <!-- Calculate the total dynamically -->
                </div>
                {{-- all button --}}
                <div class="px-4 py-2">
                    <button
                        class="w-full flex items-center justify-center bg-blue-500 text-white py-2 m-2 rounded-md hover:bg-blue-600 transition duration-300">
                        <svg fill="#ffffff" height="50px" width="50px" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 236.764 236.764" xml:space="preserve" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M110.035,151.039c0.399,3.858,3.655,6.73,7.451,6.73c0.258,0,0.518-0.013,0.78-0.04c4.12-0.426,7.115-4.111,6.689-8.231 l-3.458-33.468c-0.426-4.121-4.11-7.114-8.231-6.689c-4.12,0.426-7.115,4.111-6.689,8.231L110.035,151.039z">
                                    </path>
                                    <path
                                        d="M156.971,157.729c0.262,0.027,0.522,0.04,0.78,0.04c3.795,0,7.052-2.872,7.451-6.73l3.458-33.468 c0.426-4.121-2.569-7.806-6.689-8.231c-4.121-0.419-7.806,2.569-8.231,6.689l-3.458,33.468 C149.855,153.618,152.85,157.303,156.971,157.729z">
                                    </path>
                                    <path
                                        d="M98.898,190.329c-12.801,0-23.215,10.414-23.215,23.215c0,12.804,10.414,23.221,23.215,23.221 c12.801,0,23.216-10.417,23.216-23.221C122.114,200.743,111.699,190.329,98.898,190.329z M98.898,221.764 c-4.53,0-8.215-3.688-8.215-8.221c0-4.53,3.685-8.215,8.215-8.215c4.53,0,8.216,3.685,8.216,8.215 C107.114,218.076,103.428,221.764,98.898,221.764z">
                                    </path>
                                    <path
                                        d="M176.339,190.329c-12.801,0-23.216,10.414-23.216,23.215c0,12.804,10.415,23.221,23.216,23.221 c12.802,0,23.218-10.417,23.218-23.221C199.557,200.743,189.141,190.329,176.339,190.329z M176.339,221.764 c-4.53,0-8.216-3.688-8.216-8.221c0-4.53,3.686-8.215,8.216-8.215c4.531,0,8.218,3.685,8.218,8.215 C184.557,218.076,180.87,221.764,176.339,221.764z">
                                    </path>
                                    <path
                                        d="M221.201,84.322c-1.42-1.837-3.611-2.913-5.933-2.913H65.773l-6.277-24.141c-0.86-3.305-3.844-5.612-7.259-5.612h-30.74 c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h24.941l6.221,23.922c0.034,0.15,0.073,0.299,0.116,0.446l23.15,89.022 c0.86,3.305,3.844,5.612,7.259,5.612h108.874c3.415,0,6.399-2.307,7.259-5.612l23.211-89.25 C223.111,88.55,222.621,86.158,221.201,84.322z M186.258,170.659H88.982l-19.309-74.25h135.894L186.258,170.659z">
                                    </path>
                                    <path
                                        d="M106.603,39.269l43.925,0.002L139.06,50.74c-2.929,2.929-2.929,7.678,0,10.606c1.464,1.464,3.384,2.197,5.303,2.197 c1.919,0,3.839-0.732,5.303-2.197l24.263-24.263c2.929-2.929,2.929-7.678,0-10.606l-24.28-24.28c-2.929-2.929-7.678-2.929-10.607,0 c-2.929,2.929-2.929,7.678,0,10.607l11.468,11.468l-43.907-0.002h0c-4.142,0-7.5,3.358-7.5,7.5 C99.104,35.911,102.461,39.269,106.603,39.269z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        Checkout
                    </button>

                    <button id="calculatorBtn"
                        class="w-full flex items-center justify-center bg-blue-500 text-white py-2 m-2 rounded-md hover:bg-blue-600 transition duration-300">
                        <svg fill="#ffffff" height="40px" width="40px" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>return</title>
                                <path
                                    d="M0 21.984q0.032-0.8 0.608-1.376l4-4q0.448-0.48 1.056-0.576t1.12 0.128 0.864 0.736 0.352 1.12v1.984h18.016q0.8 0 1.408-0.576t0.576-1.408v-8q0-0.832-0.576-1.408t-1.408-0.608h-16q-0.736 0-1.248-0.416t-0.64-0.992 0-1.152 0.64-1.024 1.248-0.416h16q2.464 0 4.224 1.76t1.76 4.256v8q0 2.496-1.76 4.224t-4.224 1.76h-18.016v2.016q0 0.64-0.352 1.152t-0.896 0.704-1.12 0.096-1.024-0.544l-4-4q-0.64-0.608-0.608-1.44z">
                                </path>
                            </g>
                        </svg>
                        Return
                    </button>


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
