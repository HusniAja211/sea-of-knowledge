<x-app-layout>
    <x-slot:title>
        Order Details #{{ $order->id }}
    </x-slot:title>

    <main class="min-h-screen bg-forest-mist pb-20 font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- BREADCRUMB --}}
            <nav class="flex items-center space-x-2 text-sm text-forest-leaf mb-6">
                <a href="{{ route('buyer.orders.index') }}" class="hover:text-forest-dark transition font-medium">My Orders</a>
                <span class="text-forest-moss/50">/</span>
                <span class="font-bold text-forest-dark">#{{ $order->id }}</span>
            </nav>

            {{-- STATUS STEPPER --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-forest-moss/10 mb-8">
                <div class="relative flex items-center justify-between w-full max-w-3xl mx-auto">
                    {{-- Background line --}}
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-100 -z-10"></div>

                    @php
                        // Tentukan step dari status DB
                        $steps = [
                            'pending' => 1,        // Payment pending
                            'paid' => 2,           // Payment done, waiting seller approval
                            'processing' => 3,     // Seller processing items
                            'shipped' => 4,        // Shipped
                            'completed' => 5,      // Completed
                            'cancelled' => 0,      // Cancelled / failed
                        ];

                        // Ambil status tertinggi dari order_items
                        $itemStatus = $order->items->max('status'); 
                        $currentStep = $order->payment_status == 'pending' ? $steps['pending'] 
                                        : ($order->payment_status == 'paid' && $itemStatus == 'pending' ? $steps['paid'] 
                                        : $steps[$itemStatus] ?? 0);

                        $totalSteps = 5;
                        $progressWidth = $currentStep > 0 ? (($currentStep - 1)/($totalSteps-1)) * 100 : 0;
                    @endphp

                    {{-- Progress fill --}}
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-forest-leaf -z-10 transition-all duration-700 ease-in-out"
                        style="width: {{ $progressWidth }}%"></div>

                    @foreach (['Pay', 'Validate', 'Process', 'Shipped', 'Finish'] as $index => $step)
                        @php $isActive = ($currentStep >= ($index + 1)); @endphp
                        <div class="flex flex-col items-center bg-white px-2">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm border-2 transition-colors duration-300
                                {{ $isActive ? 'bg-forest-leaf border-forest-leaf text-white' : 'bg-white border-gray-200 text-gray-400' }}">
                                @if($isActive && $currentStep > ($index + 1))
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>
                            <span class="text-xs mt-2 font-bold {{ $isActive ? 'text-forest-dark' : 'text-gray-400' }}">{{ $step }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                {{-- LEFT COLUMN: ITEMS & PAYMENT --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- ITEMS --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-forest-moss/10 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-forest-dark">Item Details</h3>
                            <span class="text-xs font-mono text-gray-400 uppercase tracking-widest">Order ID: {{ $order->id }}</span>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ($order->items as $item)
                                <div class="p-6 flex gap-4 items-center hover:bg-forest-mist/10 transition">
                                    <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                        <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}"
                                            class="w-full h-full object-cover" alt="{{ $item->product->title }}">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-forest-dark text-base">{{ $item->product->title }}</h4>
                                        <p class="text-xs text-forest-leaf font-medium">{{ $item->product->category->name ?? 'General' }}</p>
                                        <div class="flex items-center gap-4 mt-2">
                                            <p class="text-sm text-gray-500">Qty: <span class="font-bold text-gray-700">{{ $item->quantity }}</span></p>
                                            <p class="text-sm text-gray-500">Price: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right font-mono font-bold text-forest-dark">
                                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- PAYMENT & ACTION --}}
                    @if($order->payment_status == 'pending')
                        <div class="bg-white rounded-2xl shadow-lg border-t-4 border-orange-400 overflow-hidden">
                            <div class="p-8">
                                <h2 class="text-xl font-bold text-forest-dark mb-4">Complete Your Payment</h2>
                                <form action="{{ route('buyer.payment.store', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <label for="payment_proof" class="block border-2 border-dashed border-forest-moss/30 rounded-2xl p-8 text-center hover:bg-forest-mist/20 transition cursor-pointer group">
                                        <input type="file" name="payment_proof" id="payment_proof" class="hidden" required onchange="previewFile(this)">
                                        <div class="flex flex-col items-center" id="upload-placeholder">
                                            <div class="w-14 h-14 bg-forest-leaf/10 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                                <svg class="w-7 h-7 text-forest-leaf" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            </div>
                                            <p class="font-bold text-forest-dark">Click to upload Payment Proof</p>
                                            <p class="text-xs text-gray-400 mt-1">Max size 2MB (JPG, PNG)</p>
                                        </div>
                                        <div id="file-name" class="hidden font-bold text-forest-leaf text-sm"></div>
                                    </label>
                                    <button type="submit" class="w-full py-4 bg-forest-leaf hover:bg-forest-pine text-white font-bold rounded-2xl shadow-lg transition active:scale-[0.98]">
                                        Confirm Payment
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif($order->payment_status == 'paid' && $itemStatus == 'pending')
                        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-12 text-center">
                            <h2 class="text-2xl font-bold text-forest-dark">Verifying Payment</h2>
                            <p class="text-gray-500 mt-3">Payment received! Waiting for seller to approve and start processing your order.</p>
                        </div>
                    @elseif($itemStatus == 'processing')
                        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-8 text-center">
                            <h2 class="text-xl font-bold text-forest-dark">Seller is preparing your order...</h2>
                        </div>
                    @elseif($itemStatus == 'shipped')
                        <form id="received-form-{{ $order->id }}" action="{{ route('buyer.orders.received', $order->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PATCH')
                            <button type="button" onclick="confirmReceived({{ $order->id }})" class="w-full py-3 bg-primary text-white font-bold rounded-xl shadow-md hover:opacity-90 transition">
                                Mark as Received
                            </button>
                        </form>
                    @elseif($itemStatus == 'completed')
                        <div class="bg-white rounded-2xl shadow-sm border border-forest-moss/10 p-8 text-center">
                            <h2 class="text-xl font-bold text-forest-dark">Order Completed</h2>
                            <a href="{{ route('buyer.product.show', $order->items->first()->product_id) }}" class="mt-4 inline-block px-8 py-3 bg-secondary text-white font-bold rounded-xl shadow-md hover:opacity-90 transition">
                                Buy Again
                            </a>
                        </div>
                    @elseif($order->payment_status == 'failed' || $order->payment_status == 'expired' || $itemStatus == 'cancelled')
                        <div class="bg-red-50 rounded-2xl border border-red-100 p-8 flex items-start gap-6">
                            <div class="p-3 bg-red-100 rounded-xl text-red-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-red-800 text-xl">Order Cancelled</h3>
                                <p class="text-red-600/80 mt-2">Order could not be completed. Contact support if needed.</p>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- RIGHT COLUMN: SHIPPING & COST --}}
                <div class="space-y-6">
                    {{-- Shipping Info --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-forest-moss/10">
                        <h3 class="font-serif font-bold text-forest-dark mb-5 flex items-center gap-2">Shipping Info</h3>
                        <div class="space-y-4">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Receiver</p>
                            <p class="text-forest-dark font-bold">{{ $order->receiver_name ?? Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ $order->phone ?? '-' }}</p>

                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Address</p>
                            <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $order->shipping_address ?? Auth::user()->address }}"</p>
                        </div>
                    </div>

                    {{-- Cost Breakdown --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-forest-moss/10">
                        <h3 class="font-serif font-bold text-forest-dark mb-5">Cost Breakdown</h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between"><span>Subtotal Items</span><span class="font-mono">Rp{{ number_format($order->total_price - 1000, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between"><span>Service Fee</span><span class="font-mono">Rp1.000</span></div>
                            <div class="flex justify-between items-center"><span>Shipping</span><span class="bg-forest-mist text-forest-leaf text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Free</span></div>
                            <div class="border-t border-dashed border-gray-200 pt-4 mt-4 flex justify-between items-center">
                                <span class="font-bold text-forest-dark">Grand Total</span>
                                <span class="font-mono font-bold text-forest-dark text-xl">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function previewFile(input) {
            const fileName = input.files[0].name;
            document.getElementById('upload-placeholder').classList.add('hidden');
            const nameDisplay = document.getElementById('file-name');
            nameDisplay.classList.remove('hidden');
            nameDisplay.innerText = "Selected: " + fileName;
        }

        function confirmReceived(orderId) {
            if(confirm('Have you received the product?')) {
                document.getElementById('received-form-' + orderId).submit();
            }
        }
    </script>
</x-app-layout>