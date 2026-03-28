<x-app-layout>
    {{-- Main Background Wrapper --}}
    <main class="min-h-screen py-12">

        {{-- Container Utama: Grid Layout --}}
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- =======================
                 KOLOM KIRI (MAIN CONTENT)
            ======================= --}}
            <div class="lg:col-span-3 space-y-8">

                {{-- 1. Search Bar (Mobile) --}}
                <div class="lg:hidden mb-4">
                    <input type="text" placeholder="Search analytics..."
                        class="w-full rounded-xl border-none bg-white py-3 px-4 shadow-sm focus:ring-2 focus:ring-primary">
                </div>

                {{-- 2. HERO BANNER --}}
                <div
                    class="relative bg-gradient-to-r from-secondary to-primary rounded-[2rem] p-8 md:p-10 text-white overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                    {{-- Decorative Elements --}}
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-tertiary opacity-10 rounded-full blur-3xl -mr-16 -mt-16">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl -ml-10 -mb-10">
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        {{-- Text --}}
                        <div class="max-w-lg">
                            <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
                                {{ config('app.name') }} <br>
                                Professional Analytics & <br>
                                Business Hub.
                            </h1>
                            <p class="text-blue-100 mb-8 text-sm md:text-base opacity-90 leading-relaxed">
                                Monitor your business growth, manage digital assets, and optimize your sales performance
                                in one centralized dashboard.
                            </p>
                            <div class="flex gap-4">
                                <button
                                    class="px-7 py-3 bg-tertiary text-secondary font-bold rounded-full shadow-lg hover:brightness-110 transition transform hover:-translate-y-1 text-sm">
                                    Analyze Sales
                                </button>
                                <button
                                    class="px-7 py-3 border border-white/30 bg-white/10 text-white font-bold rounded-full hover:bg-white/20 transition text-sm backdrop-blur-sm">
                                    View Reports
                                </button>
                            </div>
                        </div>

                        {{-- Illustration (Refined Professional SVG) --}}
                        <div class="hidden md:block transform hover:scale-105 transition duration-500">
                            <svg class="w-56 h-56 drop-shadow-2xl" viewBox="0 0 200 200" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="100" cy="100" r="80" fill="white" fill-opacity="0.1" />
                                <rect x="60" y="80" width="15" height="60" rx="2" fill="#14B8A6" />
                                <rect x="85" y="60" width="15" height="80" rx="2" fill="#3B82F6" />
                                <rect x="110" y="100" width="15" height="40" rx="2" fill="#FFFFFF" />
                                <path d="M50 150L150 150" stroke="white" stroke-width="4" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- 3. PRODUCT GRID --}}
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-secondary">Asset Collection</h2>
                            <p class="text-sm text-gray-500">Manage your active product categories</p>
                        </div>
                        <a href="#"
                            class="px-5 py-2 bg-white text-primary text-xs font-bold rounded-full shadow-sm border border-gray-100 hover:bg-primary hover:text-white transition-all">
                            View All Assets
                        </a>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @forelse($categories as $category)
                            <div
                                class="bg-white p-6 rounded-3xl shadow-sm border border-gray-50 hover:border-tertiary/50 hover:shadow-xl transition-all group text-center cursor-pointer">
                                <div
                                    class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-4 bg-background group-hover:bg-tertiary/10 transition-colors">
                                    @if ($category->firstProduct && $category->firstProduct->image)
                                        <img src="{{ asset('storage/' . $category->firstProduct->image) }}"
                                            class="w-full h-full object-cover rounded-2xl">
                                    @else
                                        <span class="text-2xl group-hover:scale-125 transition-transform">📁</span>
                                    @endif
                                </div>
                                <h3 class="font-bold text-secondary group-hover:text-primary transition">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-xs text-gray-400 mt-1 font-medium">
                                    {{ $category->products()->count() }} SKU Items
                                </p>
                            </div>
                        @empty
                            <div
                                class="col-span-4 py-12 text-center bg-white rounded-3xl border-2 border-dashed border-gray-200">
                                <p class="text-gray-400 font-medium">No active categories found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- =======================
                 KOLOM KANAN (SIDEBAR)
            ======================= --}}
            <div class="lg:col-span-1 space-y-8">

                {{-- 1. Calendar Widget (Premium Look) --}}
                <div>
                    <h3 class="font-bold text-lg text-secondary mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-tertiary rounded-full"></span>
                        Schedule
                    </h3>
                    <div
                        class="bg-secondary rounded-3xl p-6 text-white text-center shadow-lg relative overflow-hidden group">
                        <div
                            class="absolute -top-10 -right-10 w-32 h-32 bg-primary opacity-20 rounded-full blur-2xl group-hover:opacity-40 transition-opacity">
                        </div>

                        <p class="text-sm font-bold opacity-60 uppercase tracking-widest">{{ now()->format('Y') }}</p>
                        <h2 class="text-3xl font-bold my-1 tracking-tight">{{ now()->format('F') }}</h2>
                        <div class="text-7xl font-black my-2 text-tertiary">{{ now()->format('d') }}</div>
                        <p
                            class="font-bold bg-white/10 backdrop-blur-md inline-block px-6 py-1.5 rounded-full text-xs uppercase tracking-tighter">
                            {{ now()->format('l') }}
                        </p>
                    </div>
                </div>

                {{-- 2. Incoming Orders (Static Data) --}}
                <div>
                    <h3 class="font-bold text-lg text-secondary mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-primary rounded-full"></span>
                        Recent Activity
                    </h3>
                    <div class="space-y-4">
                        {{-- Data Statis: Simulasi Order --}}
                        @foreach ([['product' => 'Premium Corporate Logo', 'customer' => 'PT. Maju Mundur', 'time' => '2 mins ago'], ['product' => 'Brand Identity Guideline', 'customer' => 'Sarah Johnson', 'time' => '1 hour ago'], ['product' => 'Social Media Kit', 'customer' => 'Warung Digital', 'time' => '3 hours ago']] as $order)
                            <div
                                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50 flex items-center gap-4 hover:shadow-md hover:border-primary/20 transition cursor-pointer group">
                                <div
                                    class="w-12 h-12 bg-background text-primary rounded-xl flex items-center justify-center font-bold group-hover:bg-primary group-hover:text-white transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-sm text-secondary truncate">{{ $order['product'] }}</h4>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-gray-500 font-medium">{{ $order['customer'] }}</p>
                                        <span class="text-[10px] text-gray-400">{{ $order['time'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- 3. Message Widget (Static Data) --}}
                <div>
                    <h3 class="font-bold text-lg text-secondary mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-accent rounded-full"></span>
                        Support Inbox
                    </h3>

                    {{-- Data Statis: Simulasi Pesan --}}
                    @foreach ([['name' => 'Alex Rivera', 'msg' => 'Halo, apakah revisi untuk desain kemasan sudah tersedia?', 'color' => '1E40AF'], ['name' => 'Budi Santoso', 'msg' => 'Pembayaran sudah saya transfer ya mas, tolong dicek.', 'color' => '14B8A6']] as $message)
                        <div
                            class="bg-gradient-to-br from-white to-background rounded-2xl p-5 border border-gray-100 shadow-sm relative group overflow-hidden hover:shadow-md transition-all mb-4">
                            <div class="absolute top-0 right-0 w-1 bg-tertiary h-full"></div>
                            <div class="flex items-start gap-3 relative z-10">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($message['name']) }}&background={{ $message['color'] }}&color=fff"
                                    class="w-10 h-10 rounded-full shadow-sm">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-sm text-secondary">{{ $message['name'] }}</h4>
                                        <span
                                            class="text-[9px] bg-tertiary/10 text-tertiary px-2 py-0.5 rounded-full font-bold uppercase">New</span>
                                    </div>
                                    <p class="text-xs mt-1.5 text-gray-600 leading-relaxed italic">
                                        "{{ $message['msg'] }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- 2. Incoming Orders --}}
                {{-- <div>
                    <h3 class="font-bold text-lg text-secondary mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-primary rounded-full"></span>
                        Recent Activity
                    </h3>
                    <div class="space-y-4">
                        @forelse($incomingOrders as $order)
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-50 flex items-center gap-4 hover:shadow-md hover:border-primary/20 transition cursor-pointer group">
                                <div class="w-12 h-12 bg-background text-primary rounded-xl flex items-center justify-center font-bold group-hover:bg-primary group-hover:text-white transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-sm text-secondary truncate">{{ $order->product_name }}</h4>
                                    <p class="text-xs text-gray-500 font-medium">{{ $order->customer_name }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm text-center py-4 italic">No recent transactions</p>
                        @endforelse
                    </div>
                </div> --}}

                {{-- 3. Message Widget (Floating Style) --}}
                {{-- <div>
                    <h3 class="font-bold text-lg text-secondary mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-5 bg-accent rounded-full"></span>
                        Support Inbox
                    </h3>
                    @forelse($messages as $message)
                        <div class="bg-gradient-to-br from-white to-background rounded-2xl p-5 border border-gray-100 shadow-sm relative group overflow-hidden hover:shadow-md transition-all">
                            <div class="absolute top-0 right-0 w-1 bg-tertiary h-full"></div>
                            <div class="flex items-start gap-3 relative z-10">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($message['name']) }}&background=1E40AF&color=fff"
                                    class="w-10 h-10 rounded-full shadow-sm">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-sm text-secondary">{{ $message['name'] }}</h4>
                                        <span class="text-[9px] bg-tertiary/10 text-tertiary px-2 py-0.5 rounded-full font-bold uppercase">New</span>
                                    </div>
                                    <p class="text-xs mt-1.5 text-gray-600 leading-relaxed italic">
                                        "{{ Str::limit($message['message'], 60) }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-6 bg-white rounded-2xl border border-gray-100">
                            <p class="text-xs text-gray-400">Inbox is empty</p>
                        </div>
                    @endforelse
                </div> --}}

            </div>
        </div>
    </main>
</x-app-layout>
