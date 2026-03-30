<x-app-layout>
    <x-slot:title>
        Toko {{ $seller->name }}
    </x-slot:title>

    <main class="min-h-screen bg-background pb-20 font-sans">

        {{-- 1. SHOP HEADER / COVER --}}
        <div class="relative h-64 bg-secondary overflow-hidden">
            {{-- Decorative Pattern --}}
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-secondary to-transparent"></div>

            {{-- Back Button --}}
            <div class="absolute top-6 left-6 z-20">
                <a href="{{ route('buyer.dashboard') }}"
                    class="flex items-center gap-2 text-white/80 hover:text-white transition bg-white/10 hover:bg-white/20 px-4 py-2 rounded-full backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        {{-- 2. SELLER PROFILE CARD (Overlapping) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-10">
            <div
                class="bg-white rounded-3xl shadow-xl border border-secondary/5 p-6 md:p-8 flex flex-col md:flex-row gap-8 items-start md:items-center">

                {{-- Avatar --}}
                <div class="relative flex-shrink-0 mx-auto md:mx-0">
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-md overflow-hidden bg-slate-100">
                        <img src="{{ $seller->avatar_url ?? 'https://ui-avatars.com/api/?name=' . $seller->name . '&background=1E40AF&color=fff' }}"
                            alt="{{ $seller->name }}" class="w-full h-full object-cover">
                    </div>
                    {{-- Online Badge --}}
                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-tertiary border-4 border-white rounded-full"
                        title="Online"></div>
                </div>

                {{-- Info --}}
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center gap-2 mb-2 justify-center md:justify-start">
                        <h1 class="text-3xl font-serif font-bold text-secondary">{{ $seller->name }}</h1>
                        <span
                            class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full flex items-center gap-1 w-max mx-auto md:mx-0">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Official Seller
                        </span>
                    </div>

                    <p class="text-slate-500 text-sm mb-4 flex items-center justify-center md:justify-start gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $seller->address ?? 'Lokasi tidak tersedia' }}
                    </p>

                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="{{ route('chat.start', $seller->id) }}"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl shadow-lg shadow-primary/20 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Chat Penjual
                        </a>
                        <button
                            class="px-6 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition">
                            Share Toko
                        </button>
                    </div>
                </div>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-3 gap-4 w-full md:w-auto text-center divide-x divide-slate-100">
                    <div class="px-4">
                        <p class="text-2xl font-bold text-secondary">{{ $products->total() }}</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Produk</p>
                    </div>
                    <div class="px-4">
                        <p class="text-2xl font-bold text-secondary">4.9</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Rating</p>
                    </div>
                    <div class="px-4">
                        <p class="text-2xl font-bold text-secondary">{{ $totalSold ?? 0 }}</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Terjual</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. PRODUCT LIST FILTER --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-2xl font-serif font-bold text-secondary">Etalase Produk</h2>

                {{-- Search & Sort --}}
                <div class="flex gap-4 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <input type="text" placeholder="Cari di toko ini..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-200 focus:ring-primary focus:border-primary text-sm">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <select
                        class="py-2 pl-4 pr-8 rounded-lg border border-slate-200 focus:ring-primary focus:border-primary text-sm bg-white">
                        <option>Terbaru</option>
                        <option>Terlaris</option>
                        <option>Harga Terendah</option>
                        <option>Harga Tertinggi</option>
                    </select>
                </div>
            </div>

            {{-- 4. PRODUCTS GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                        {{-- Image Wrapper --}}
                        <div class="relative aspect-[4/3] bg-slate-50 overflow-hidden">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}"
                                alt="{{ $product->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            {{-- Quick Action Overlay --}}
                            <div
                                class="absolute inset-0 bg-secondary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <a href="{{ route('buyer.product.show', $product) }}"
                                    class="p-2 bg-white rounded-full text-secondary hover:text-primary shadow-lg transform hover:scale-110 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                            </div>

                            @if ($product->stock <= 0)
                                <div
                                    class="absolute top-2 right-2 px-2 py-1 bg-secondary/80 text-white text-xs font-bold rounded">
                                    Habis</div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-4 flex flex-col h-[140px]">
                            <div class="flex-1">
                                <p class="text-xs text-tertiary font-bold mb-1 uppercase tracking-wider">
                                    {{ $product->category->name }}</p>
                                <h3
                                    class="font-bold text-secondary line-clamp-2 leading-snug group-hover:text-primary transition-colors">
                                    <a href="{{ route('buyer.product.show', $product) }}">{{ $product->title }}</a>
                                </h3>
                            </div>

                            <div class="mt-2 pt-2 border-t border-slate-50 flex items-center justify-between">
                                <span
                                    class="font-mono font-bold text-secondary text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-xs text-slate-400">Stok {{ $product->stock }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                        <div
                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary">Toko Belum Memiliki Produk</h3>
                        <p class="text-slate-500 mt-2">Penjual ini belum menambahkan produk ke etalase.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>
    </main>
</x-app-layout>