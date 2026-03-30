<x-app-layout>
    <x-slot:title>
        Shopping Cart 
    </x-slot:title>

    <main class="min-h-screen bg-background pb-20 font-sans relative">

        {{-- Background Texture --}}
        <div class="absolute inset-0 z-0 opacity-5 pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'2\' cy=\'2\' r=\'1\' fill=\'%231E40AF\'/%3E%3C/svg%3E');">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-serif font-bold text-secondary">Shopping Cart</h1>
                <p class="text-slate-500 mt-1 text-sm">
                    Manage your items before proceeding to checkout.
                </p>
            </div>

            @if ($cartItems->count()>0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- LEFT COLUMN: Cart Items --}}
                    <div class="lg:col-span-2 space-y-4">

                        {{-- Header List (Select All) --}}
                        <div
                            class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex items-center gap-3">
                            <input type="checkbox" id="select-all"
                                class="rounded border-slate-300 text-primary focus:ring-primary w-5 h-5 cursor-pointer">
                            <span class="text-sm font-bold text-slate-700">
                                Select All ({{ $cartItems->count() }})
                            </span>
                        </div>

                        {{-- Item List --}}
                        @foreach ($cartItems as $item)
                            <div
                                class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col sm:flex-row gap-4 sm:items-center group hover:border-primary/30 transition-colors">

                                {{-- Checkbox --}}
                                <div class="flex items-center">
                                    <input type="checkbox" name="selected_items[]" value="{{$item->id}}"
                                        data-price="{{ $item->product->price }}" data-qty="{{ $item->quantity }}"
                                        class="cart-item-checkbox rounded border-slate-300 text-primary focus:ring-primary w-5 h-5 cursor-pointer">
                                </div>

                                {{-- Product Image --}}
                                <div
                                    class="w-24 h-24 flex-shrink-0 bg-slate-50 rounded-xl overflow-hidden border border-slate-100">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}"
                                        alt="{{ $item->product->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>

                                {{-- Product Details --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-secondary text-lg truncate pr-4">
                                                {{ $item->product->title }}
                                            </h3>
                                            <p class="text-xs text-slate-400 mb-1">
                                                {{ $item->product->category->name }}
                                            </p>
                                            <p
                                                class="text-xs font-bold text-tertiary bg-tertiary/10 px-2 py-0.5 rounded inline-block">
                                                Stock: {{ $item->product->stock }}
                                            </p>
                                        </div>

                                        {{-- Remove Button (Desktop) --}}
                                        <form action="{{ route('buyer.cart.destroy', $item->id) }}" method="POST"
                                            class="hidden sm:block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-slate-300 hover:text-red-500 transition p-1">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex justify-between items-end mt-4">
                                        {{-- Price --}}
                                        <div class="font-mono font-bold text-secondary text-lg">
                                            Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                        </div>

                                        {{-- Quantity Control --}}
                                        <div
                                            class="flex items-center border border-slate-200 rounded-lg bg-slate-50 overflow-hidden">

                                            {{-- DECREMENT --}}
                                            <form action="{{ route('buyer.cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="decrement">
                                                <button type="submit"
                                                    class="px-3 py-1 text-slate-600 hover:bg-slate-200 hover:text-secondary transition">
                                                    −
                                                </button>
                                            </form>

                                            {{-- QTY --}}
                                            <div class="w-10 text-center text-sm font-bold text-slate-700">
                                                {{ $item->quantity }}
                                            </div>

                                            {{-- INCREMENT --}}
                                            <form action="{{ route('buyer.cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="increment">
                                                <button type="submit"
                                                    class="px-3 py-1 text-slate-600 hover:bg-slate-200 hover:text-secondary transition">
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Remove Button (Mobile) --}}
                                    <form action="{{ route('buyer.cart.destroy', $item->id) }}" method="POST"
                                        class="sm:hidden mt-3 text-right">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 font-bold hover:underline">
                                            Remove Item
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- RIGHT COLUMN: Order Summary --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-secondary sticky top-24">
                            <h3 class="font-serif font-bold text-xl text-secondary mb-6">
                                Order Summary
                            </h3>

                            <div class="space-y-4 mb-6 text-sm">
                                <div class="flex justify-between text-slate-600">
                                    <span>
                                        Subtotal (<span id="summary-qty">0</span> items)
                                    </span>
                                    <span id="summary-total" class="font-mono">
                                        Rp0
                                    </span>
                                </div>
                                <div class="flex justify-between text-slate-600">
                                    <span>Discount</span>
                                    <span class="text-tertiary font-bold">-Rp0</span>
                                </div>
                                <div
                                    class="border-t border-dashed border-slate-200 pt-4 flex justify-between items-center">
                                    <span class="font-bold text-slate-800 text-base">
                                        Total
                                    </span>
                                    <span id="summary-grand-total" class="font-bold text-secondary text-xl font-mono">
                                        Rp0
                                    </span>
                                </div>
                            </div>

                            <button id="checkout-btn"
                                class="w-full py-3.5 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl shadow-lg shadow-primary/20 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                                Checkout Now
                            </button>

                            <p class="text-xs text-center text-slate-400 mt-4">
                                Secure & Encrypted Transaction
                            </p>
                        </div>
                    </div>

                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <h2 class="text-2xl font-serif font-bold text-secondary mb-2">
                        Your Cart Is Empty
                    </h2>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto">
                        Looks like you haven’t added anything to your cart yet.
                        Let’s explore our collection!
                    </p>
                    <a href="{{ route('buyer.index') }}"
                        class="px-8 py-3 bg-primary hover:bg-primary/90 text-white font-bold rounded-full shadow-lg shadow-primary/20 transition transform hover:-translate-y-1">
                        Start Shopping
                    </a>
                </div>
            @endif

        </div>

        {{-- CHECKOUT MODAL --}}
        <div id="checkout-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-secondary/40 backdrop-blur-sm">

            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 relative">

                {{-- Close Button --}}
                <button id="close-checkout" type="button"
                    class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition">
                    ✕
                </button>

                <h2 class="text-2xl font-serif font-bold text-secondary mb-4">
                    Checkout
                </h2>

                {{-- INFO --}}
                <div class="mb-4 p-3 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                    ⚠️ Products from different sellers <b>will be processed as separate orders</b>.
                </div>

                <form method="POST" action="{{ route('buyer.checkout.store') }}">
                    @csrf

                    {{-- SUMMARY --}}
                    <div class="mb-4 text-sm text-slate-600 space-y-2">
                        <div class="flex justify-between">
                            <span>Total Items</span>
                            <span id="checkout-qty" class="font-bold">0</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Price</span>
                            <span id="checkout-total" class="font-bold font-mono text-secondary">Rp0</span>
                        </div>
                    </div>

                    {{-- SHIPPING ADDRESS --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1">
                            Shipping address
                        </label>
                        <textarea name="shipping_address" required rows="3"
                            class="w-full rounded-xl border-slate-200 focus:ring-primary focus:border-primary"
                            placeholder="Recipient name, street, city, postal code"></textarea>
                    </div>

                    {{-- PHONE --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1">
                            WhatsApp / Mobile Number
                        </label>
                        <input type="tel" name="phone" required
                            class="w-full rounded-xl border-slate-200 focus:ring-primary focus:border-primary"
                            placeholder="62xxxxxxxxxxx">
                    </div>

                    {{-- NOTE --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-1">
                            Notes (Optional)
                        </label>
                        <textarea name="note" rows="2"
                            class="w-full rounded-xl border-slate-200 focus:ring-primary focus:border-primary"
                            placeholder="Example: handle with care"></textarea>
                    </div>

                    <input type="hidden" name="selected_items" id="selected-items-input">

                    {{-- ACTION --}}
                    <button type="submit"
                        class="w-full py-3 bg-secondary hover:bg-secondary/90 text-white font-bold rounded-xl transition shadow-lg shadow-secondary/10">
                        Create Order
                    </button>
                </form>
            </div>
        </div>

    </main>
</x-app-layout>