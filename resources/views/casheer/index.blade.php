@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Products Section -->
        <div class="flex-1">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                <!-- Products Header -->
                <div
                    class="bg-gradient-to-r from-primary-blue/20 to-primary-blue/10 px-6 py-4 dark:border-gray-700 border-b">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Products
                        </h2>
                        <div class="relative w-64">
                            <input type="text" placeholder="Search products..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-blue/10 focus:border-transparent text-sm" />
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400 dark:text-white"></i>
                        </div>
                    </div>
                </div>

                <!-- Category Tabs -->
                <div class="px-6 py-3 border-b dark:border-gray-700 flex overflow-x-auto scrollbar-hide">
                    <button
                        class="category-tab active px-4 py-1.5 rounded-full bg-primary-blue text-white text-sm font-medium mr-2 whitespace-nowrap">
                        All Items
                    </button>
                    <button
                        class="category-tab px-4 py-1.5 rounded-full bg-white dark:bg-gray-800 border dark:border-gray-700 border-gray-200 text-gray-600 dark:text-white hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap">
                        Cookie's
                    </button>
                    <button
                        class="category-tab px-4 py-1.5 rounded-full bg-white dark:bg-gray-800 border dark:border-gray-700 border-gray-200 text-gray-600 dark:text-white hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap">
                        Chip's
                    </button>
                    <button
                        class="category-tab px-4 py-1.5 rounded-full bg-white dark:bg-gray-800 border dark:border-gray-700 border-gray-200 text-gray-600 dark:text-white hover:bg-gray-50 text-sm font-medium mr-2 whitespace-nowrap">
                        Dessert's
                    </button>
                    <button
                        class="category-tab px-4 py-1.5 rounded-full bg-white dark:bg-gray-800 border dark:border-gray-700 border-gray-200 text-gray-600 dark:text-white hover:bg-gray-50 text-sm font-medium whitespace-nowrap">
                        Beverage's
                    </button>
                </div>

                <!-- Product Grid -->
                <div class="p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                        id="product-grid">
                        <!-- Product cards will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="w-full lg:w-96">
            <div
                class="bg-white dark:bg-gray-800 divide-gray-200 dark:divide-gray-700 rounded-2xl shadow-sm overflow-hidden h-full flex flex-col">
                <!-- Cart Header -->
                <div
                    class="bg-gradient-to-r from-primary-blue/20 to-primary-blue/10 px-6 py-4 dark:border-gray-700 border-b">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Current Order
                        </h2>
                        <button id="clear-cart"
                            class="text-sm font-medium text-red-500 hover:text-red-700 flex items-center">
                            <i class="fas fa-trash-alt mr-1"></i>
                            Clear
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <form action="{{ route('pos.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-1 overflow-y-auto px-4 py-3" id="cart-items">
                        <!-- Empty cart state -->
                        <div class="text-center py-10">
                            <div
                                class="mx-auto w-24 h-24 rounded-full bg-primary-blue/20 flex items-center justify-center mb-4">
                                <i class="fas fa-shopping-basket text-3xl text-primary-blue"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-700 dark:text-white mb-1">
                                Your cart is empty
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-white">
                                Add products to get started
                            </p>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div
                        class="border-t p-4 bg-white dark:border-gray-700 dark:bg-gray-800 divide-gray-200 dark:divide-gray-700">
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-white">Subtotal:</span>
                                <span id="subtotal" class="text-sm font-medium text-gray-800 dark:text-white">0.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600 dark:text-white">Tax (10%):</span>
                                <span id="tax" class="text-sm font-medium text-gray-800 dark:text-white">0.00</span>
                            </div>
                            <div class="flex justify-between pt-2 dark:border-gray-700 border-t">
                                <span class="font-semibold text-gray-800 dark:text-white">Total:</span>
                                <input id="GrandtotalInput" type="hidden" name="grandtotal">
                                <span id="total" class="font-semibold text-primary-blue">0.00</span>
                            </div>
                            <div class="space-y-3 mb-4">
                                <label for="cashInput"
                                    class="text-sm font-medium text-gray-600 dark:text-white">Cash:</label>
                                <input type="number" id="cashInput"
                                    class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white"
                                    placeholder="Masukkan uang bayar">

                                <!-- Tombol cepat -->
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="2000">+2.000</button>
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="5000">+5.000</button>
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="10000">+10.000</button>
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="20000">+20.000</button>
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="50000">+50.000</button>
                                    <button type="button" class="quick-add px-3 py-1 bg-primary-blue text-white rounded"
                                        data-amount="100000">+100.000</button>
                                </div>
                            </div>

                            <!-- Kembalian -->
                            <div class="flex justify-between pt-2 border-t dark:border-gray-700">
                                <span class="font-semibold text-gray-800 dark:text-white">Change:</span>
                                <span id="change" class="font-semibold text-primary-blue">0.00</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <button type="submit" id="checkout-btn"
                                class="w-full bg-primary-blue text-white py-3 rounded-lg font-medium hover:shadow-md transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                disabled>
                                <i class="fas fa-credit-card mr-2"></i>
                                Checkout
                            </button>
                            <button id="print-receipt-btn"
                                class="w-full bg-white border border-gray-200 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                disabled>
                                <i class="fas fa-print mr-2"></i> Print
                                Receipt
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Receipt Modal -->
    <div id="receipt-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                        Order Receipt
                    </h3>
                    <button id="close-receipt" class="text-gray-500 hover:text-gray-700 dark:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div id="receipt-content" class="bg-white p-4 border border-gray-100 rounded-lg">
                    <div class="text-center mb-4">
                        <div
                            class="mx-auto w-16 h-16 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center mb-2">
                            <i class="fas fa-store text-2xl text-primary-blue"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                            POS STORE
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-white">
                            123 Business Avenue, City
                        </p>
                        <p class="text-xs text-gray-500 dark:text-white">
                            Tel: (123) 456-7890
                        </p>
                    </div>

                    <div class="border-t border-b border-gray-100 py-3 my-3">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500 dark:text-white">Date:</span>
                            <span id="receipt-date" class="font-medium">Oct 15, 2023 14:30</span>
                        </div>
                        <div class="flex justify-between text-xs mt-1">
                            <span class="text-gray-500 dark:text-white">Order #:</span>
                            <span id="receipt-order-id" class="font-medium">ORD-12345</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="grid grid-cols-12 gap-1 text-xs font-medium border-b border-gray-100 pb-1 mb-1">
                            <div class="col-span-6">Item</div>
                            <div class="col-span-2 text-right">Qty</div>
                            <div class="col-span-2 text-right">Price</div>
                            <div class="col-span-2 text-right">Total</div>
                        </div>

                        <div id="receipt-items" class="space-y-2 mt-2">
                            <!-- Receipt items will be loaded here -->
                        </div>

                        <div class="border-t border-gray-100 pt-3 mt-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-white">Subtotal:</span>
                                <span id="receipt-subtotal" class="font-medium">Rp. 0.00</span>
                            </div>
                            <div class="flex justify-between text-sm mt-1">
                                <span class="text-gray-600 dark:text-white">Tax (10%):</span>
                                <span id="receipt-tax" class="font-medium">Rp. 0.00</span>
                            </div>
                            <div class="flex justify-between font-semibold mt-2 pt-2 border-t border-gray-100">
                                <span>Total:</span>
                                <span id="receipt-total" class="text-primary-blue">Rp. 0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-xs text-gray-500 dark:text-white mt-4">
                        <p>Thank you for shopping with us!</p>
                        <p class="mt-1">Please visit again</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button id="print-receipt"
                        class="px-4 py-2 bg-primary-blue text-white rounded-lg hover:bg-primary-blue/10 transition flex items-center no-print">
                        <i class="fas fa-print mr-2"></i> Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
