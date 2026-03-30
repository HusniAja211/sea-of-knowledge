<x-app-layout>
    <x-slot:title>
        My Orders
    </x-slot:title>

    <main class="min-h-screen bg-background pb-12 font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-serif font-bold text-secondary">Order History</h1>
                    <p class="text-sm text-primary mt-1">
                        Track the status of your purchases here.
                    </p>
                </div>
            </div>

            {{-- STATUS TABS --}}
            @php
                $statuses = [
                    'all' => 'All Orders',
                    'unpaid' => 'Belum Bayar',
                    'processing' => 'Dikemas',
                    'shipped' => 'Dikirim',
                    'completed' => 'Selesai',
                ];
                $currentStatus = request('status', 'all');
            @endphp
            <div class="mb-8 overflow-x-auto pb-2 hide-scrollbar">
                <div class="flex gap-2 min-w-max">
                    @foreach ($statuses as $key => $label)
                        <a href="{{ route('buyer.orders.index', ['status' => $key]) }}"
                            class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 border 
                {{ $currentStatus == $key
                    ? 'bg-primary text-white border-primary shadow-md'
                    : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-primary' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ORDER LIST --}}
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">

                        {{-- Card Header --}}
                        <div
                            class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                            <div class="flex items-center gap-4">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 uppercase tracking-wider font-bold">Order
                                        ID</span>
                                    <span class="font-mono text-secondary font-bold">#{{ $order->id }}</span>
                                </div>
                                <div class="hidden sm:block w-px h-8 bg-gray-200"></div>
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 uppercase tracking-wider font-bold">Date</span>
                                    <span
                                        class="text-sm text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            @php
                                $statusConfig = match ($order->status) {
                                    'unpaid' => [
                                        'bg' => 'bg-orange-100',
                                        'text' => 'text-orange-700',
                                        'border' => 'border-orange-200',
                                        'label' => 'Belum Bayar',
                                    ],
                                    'processing' => [
                                        'bg' => 'bg-blue-100',
                                        'text' => 'text-blue-700',
                                        'border' => 'border-blue-200',
                                        'label' => 'Dikemas',
                                    ],
                                    'shipped' => [
                                        'bg' => 'bg-indigo-100',
                                        'text' => 'text-indigo-700',
                                        'border' => 'border-indigo-200',
                                        'label' => 'Dikirim',
                                    ],
                                    'completed' => [
                                        'bg' => 'bg-green-100',
                                        'text' => 'text-green-700',
                                        'border' => 'border-green-200',
                                        'label' => 'Selesai',
                                    ],
                                    'cancelled' => [
                                        'bg' => 'bg-red-100',
                                        'text' => 'text-red-700',
                                        'border' => 'border-red-200',
                                        'label' => 'Cancelled',
                                    ],
                                    default => [
                                        'bg' => 'bg-gray-100',
                                        'text' => 'text-gray-700',
                                        'border' => 'border-gray-200',
                                        'label' => ucfirst($order->status),
                                    ],
                                };
                            @endphp

                            <span
                                class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-6">
                            @foreach ($order->items as $item)
                                <div class="flex gap-4 mb-4 last:mb-0">
                                    <div
                                        class="w-20 h-20 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                                        <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-secondary line-clamp-1">{{ $item->product->title }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mb-1">
                                            {{ $item->product->category->name ?? 'General' }}</p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-sm text-gray-600">x{{ $item->quantity }}</span>
                                            <span
                                                class="font-mono text-sm font-bold text-primary">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Card Footer --}}
                        <div
                            class="px-6 py-4 bg-gray-50/30 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="text-center sm:text-left">
                                <span class="text-xs text-gray-500">Order Total</span>
                                <p class="text-xl font-bold text-secondary">
                                    Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="flex gap-3 w-full sm:w-auto items-center">
                                <a href="{{ route('buyer.orders.show', $order->id) }}"
                                    class="flex-1 sm:flex-none px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition text-sm text-center shadow-sm">
                                    Details
                                </a>

                                @if ($order->status === 'unpaid')
                                    <a href="{{ route('buyer.orders.show', $order->id) }}"
                                        class="flex-1 sm:flex-none px-6 py-2.5 bg-accent hover:opacity-90 text-white font-bold rounded-xl shadow-md transition text-sm text-center">
                                        Pay Now
                                    </a>
                                @elseif($order->status === 'processing')
                                    <span class="text-sm text-tertiary font-bold px-4">Seller is preparing
                                        order...</span>
                                @elseif($order->status === 'shipped')
                                    <form id="received-form-{{ $order->id }}"
                                        action="{{ route('buyer.orders.received', $order->id) }}" method="POST"
                                        class="flex-1 sm:flex-none">
                                        @csrf @method('PATCH')
                                        <button type="button" onclick="confirmReceived({{ $order->id }})"
                                            class="w-full px-6 py-2.5 bg-primary hover:opacity-90 text-white font-bold rounded-xl shadow-md transition text-sm">Product
                                            Received</button>
                                    </form>
                                @elseif($order->status === 'completed')
                                    <span class="text-sm text-green-600 font-bold px-4">Order Completed</span>
                                    <a href="{{ route('buyer.product.show', $order->items->first()->product_id) }}"
                                        class="flex-1 sm:flex-none px-6 py-2.5 bg-secondary text-white font-bold rounded-xl shadow-md transition text-sm text-center">Buy
                                        Again</a>
                                @elseif($order->status === 'cancelled')
                                    <span class="text-sm text-red-500 font-bold px-4">Order Cancelled</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-background rounded-full mb-6">
                            <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary">No orders found</h3>
                        <p class="text-gray-500 mt-2 mb-6">You don't have any orders with this status yet.</p>
                        <a href="{{ route('buyer.index') }}"
                            class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:opacity-90 transition shadow-lg">Start
                            Shopping</a>
                    </div>
                @endforelse
            </div>
        </div>
        </div>

        {{-- ORDER LIST --}}
        <div class="space-y-6">
            @forelse ($orders as $order)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">

                    {{-- Card Header --}}
                    <div
                        class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                        <div class="flex items-center gap-4">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase tracking-wider font-bold">Order
                                    ID</span>
                                <span class="font-mono text-secondary font-bold">#{{ $order->id }}</span>
                            </div>
                            <div class="hidden sm:block w-px h-8 bg-gray-200"></div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase tracking-wider font-bold">Date</span>
                                <span
                                    class="text-sm text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        {{-- Status Badge --}}
                        @php
                            $statusConfig = match ($order->status) {
                                'waiting_for_payment' => [
                                    'bg' => 'bg-orange-100',
                                    'text' => 'text-orange-700',
                                    'border' => 'border-orange-200',
                                    'label' => 'Waiting for Payment',
                                ],

                                'processing' => [
                                    'bg' => 'bg-blue-100',
                                    'text' => 'text-blue-700',
                                    'border' => 'border-blue-200',
                                    'label' => 'Processing',
                                ],

                                'shipped' => [
                                    'bg' => 'bg-indigo-100',
                                    'text' => 'text-indigo-700',
                                    'border' => 'border-indigo-200',
                                    'label' => 'Shipped',
                                ],

                                'completed' => [
                                    'bg' => 'bg-green-100',
                                    'text' => 'text-green-700',
                                    'border' => 'border-green-200',
                                    'label' => 'Completed',
                                ],

                                'cancelled' => [
                                    'bg' => 'bg-red-100',
                                    'text' => 'text-red-700',
                                    'border' => 'border-red-200',
                                    'label' => 'Cancelled',
                                ],

                                default => [
                                    'bg' => 'bg-gray-100',
                                    'text' => 'text-gray-700',
                                    'border' => 'border-gray-200',
                                    'label' => ucfirst($order->status),
                                ],
                            };
                        @endphp

                        <span
                            class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                            {{ $statusConfig['label'] }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-6">
                        @foreach ($order->items as $item)
                            <div class="flex gap-4 mb-4 last:mb-0">
                                <div
                                    class="w-20 h-20 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/150' }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-secondary line-clamp-1">{{ $item->product->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mb-1">
                                        {{ $item->product->category->name ?? 'General' }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-sm text-gray-600">x{{ $item->quantity }}</span>
                                        <span
                                            class="font-mono text-sm font-bold text-primary">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Card Footer --}}
                    <div
                        class="px-6 py-4 bg-gray-50/30 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <span class="text-xs text-gray-500">Order Total</span>
                            <p class="text-xl font-bold text-secondary">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>

                        {{-- DETAILS --}}
                        <a href="{{ route('buyer.orders.show', $order->id) }}"
                            class="flex-1 sm:flex-none px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition text-sm text-center shadow-sm">
                            Details
                        </a>

                        {{-- WAITING PAYMENT --}}
                        @if ($order->status === 'waiting_for_payment')
                            <a href="{{ route('buyer.orders.show', $order->id) }}"
                                class="flex-1 sm:flex-none px-6 py-2.5 bg-accent hover:opacity-90 text-white font-bold rounded-xl shadow-md transition text-sm text-center">
                                Pay Now
                            </a>

                            {{-- PROCESSING --}}
                        @elseif ($order->status === 'processing')
                            <span class="text-sm text-tertiary font-bold px-4">
                                Seller is preparing order...
                            </span>

                            {{-- SHIPPED --}}
                        @elseif ($order->status === 'shipped')
                            <form id="received-form-{{ $order->id }}"
                                action="{{ route('buyer.orders.received', $order->id) }}" method="POST"
                                class="flex-1 sm:flex-none">
                                @csrf
                                @method('PATCH')

                                <button type="button" onclick="confirmReceived({{ $order->id }})"
                                    class="w-full px-6 py-2.5 bg-primary hover:opacity-90 text-white font-bold rounded-xl shadow-md transition text-sm">
                                    Product Received
                                </button>
                            </form>

                            {{-- COMPLETED --}}
                        @elseif ($order->status === 'completed')
                            <span class="text-sm text-green-600 font-bold px-4">
                                Order Completed
                            </span>

                            <a href="{{ route('buyer.product.show', $order->items->first()->product_id) }}"
                                class="flex-1 sm:flex-none px-6 py-2.5 bg-secondary text-white font-bold rounded-xl shadow-md transition text-sm text-center">
                                Buy Again
                            </a>

                            {{-- CANCELLED --}}
                        @elseif ($order->status === 'cancelled')
                            <span class="text-sm text-red-500 font-bold px-4">
                                Order Cancelled
                            </span>
                        @endif
                    </div>
                </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-background rounded-full mb-6">
                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-secondary">No orders found</h3>
            <p class="text-gray-500 mt-2 mb-6">You don't have any orders with this status yet.</p>
            <a href="{{ route('buyer.index') }}"
                class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:opacity-90 transition shadow-lg">
                Start Shopping
            </a>
        </div>
        @endforelse
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        </div>
    </main>
</x-app-layout>
