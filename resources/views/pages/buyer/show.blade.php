<x-app-layout>
    <x-slot:title>
        {{ $product->name }}
    </x-slot:title>

    <main class="min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            {{-- MAIN PRODUCT SECTION --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    
                    {{-- LEFT: PRODUCT IMAGE --}}
                    <div class="p-6 md:p-12 bg-slate-50/50 flex items-center justify-center relative group">
                        <div class="relative w-full aspect-square max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            {{-- Zoom Hint --}}
                            <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur rounded-lg p-2 text-secondary shadow-lg opacity-0 group-hover:opacity-100 transition duration-300 border border-slate-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: PRODUCT INFO --}}
                    <div class="p-8 md:p-12 flex flex-col justify-center">
                        
                        {{-- Badge & name --}}
                        <div class="mb-6">
                            <span class="inline-block px-3 py-1 bg-tertiary/10 text-tertiary text-[10px] font-black rounded-md mb-4 uppercase tracking-[0.2em] border border-tertiary/20">
                                {{ $product->category->name }}
                            </span>
                            <h1 class="text-3xl md:text-4xl font-extrabold text-secondary leading-tight mb-3">
                                {{ $product->name }}
                            </h1>
                            
                            <div class="flex items-center gap-3 text-sm">
                                <div class="flex text-amber-400">
                                    @for($i=0; $i<5; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <span class="text-slate-400 font-medium">No reviews yet</span>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Price Investment</p>
                            <p class="text-4xl font-black text-secondary">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                            <div class="mt-4 pt-4 border-t border-slate-200/60">
                                @if($product->stock < 5 && $product->stock > 0)
                                    <div class="flex items-center gap-2 text-red-600 text-sm font-bold uppercase tracking-tighter">
                                        <span class="relative flex h-2 w-2">
                                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                          <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                        </span>
                                        Limited Stock: {{ $product->stock }} items left
                                    </div>
                                @elseif($product->stock == 0)
                                    <span class="text-slate-400 text-xs font-bold px-3 py-1 bg-slate-200 rounded-md uppercase">Out of Stock</span>
                                @else
                                    <div class="flex items-center gap-2 text-tertiary text-sm font-bold uppercase tracking-tighter">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        In Stock ({{ $product->stock }} units ready)
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- ADD TO CART FORM --}}
                        <div class="mt-auto" x-data="{ qty: 1, max: {{ $product->stock }} }">
                            <form  method="POST" action="{{ route('buyer.cart.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex flex-col sm:flex-row gap-4">
                                    {{-- Qty Selector --}}
                                    <div class="flex items-center border-2 border-slate-200 rounded-xl h-14 w-full sm:w-40 bg-white shadow-sm focus-within:border-primary transition">
                                        <button type="button" class="w-12 h-full text-slate-400 hover:text-primary hover:bg-slate-50 rounded-l-xl transition font-bold text-xl" 
                                                @click="if(qty > 1) qty--">
                                            -
                                        </button>
                                        <input type="number" name="quantity" x-model="qty" readonly 
                                               class="w-full h-full text-center border-none focus:ring-0 font-black text-secondary p-0 bg-transparent text-lg">
                                        <button type="button" class="w-12 h-full text-slate-400 hover:text-primary hover:bg-slate-50 rounded-r-xl transition font-bold text-xl"
                                                @click="if(qty < max) qty++">
                                            +
                                        </button>
                                    </div>

                                    {{-- Button --}}
                                    @if($product->stock > 0)
                                        <button type="submit" 
                                            class="flex-1 bg-primary hover:bg-secondary text-white font-bold rounded-xl h-14 shadow-lg shadow-primary/20 transition-all transform active:scale-95 flex items-center justify-center gap-3 text-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            Add to Cart
                                        </button>
                                    @else
                                        <button type="button" disabled
                                            class="flex-1 bg-slate-100 text-slate-400 font-bold rounded-xl h-14 cursor-not-allowed flex items-center justify-center border-2 border-slate-200 uppercase tracking-widest text-sm">
                                            Sold Out
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- LEFT: DETAILS --}}
                <div class="lg:col-span-2 space-y-10">
                    {{-- Description --}}
                    <div id="description" class="bg-white rounded-2xl p-8 md:p-10 shadow-sm border border-slate-200">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                            <div class="w-1.5 h-8 bg-primary rounded-full"></div>
                            <h3 class="text-2xl font-black text-secondary uppercase tracking-tight">Product Details</h3>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-lg">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>

                {{-- RIGHT: SELLER INFO --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 sticky top-24">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Verified Merchant</h3>
                        
                        <div class="flex items-center gap-5 mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 border-2 border-white shadow-lg overflow-hidden shrink-0">
                                <img src="{{ $product->seller->avatar_url ?? 'https://ui-avatars.com/api/?background=1E40AF&color=fff&name='.$product->seller->name }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-secondary text-xl leading-tight">{{ $product->seller->name }}</h4>
                                <p class="text-sm text-slate-400 mt-1 font-medium italic">Member since {{ $product->seller->created_at->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                                <p class="font-black text-primary text-xl tracking-tighter">4.8</p>
                                <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">Global Rating</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                                <p class="font-black text-tertiary text-xl tracking-tighter">100%</p>
                                <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">Response</p>
                            </div>
                        </div>

                        <a href="{{ route('buyer.seller.shop', $product->seller->id) }}" 
                           class="block w-full py-4 bg-white border-2 border-secondary text-secondary text-center font-black rounded-xl hover:bg-secondary hover:text-white transition-all duration-300 uppercase tracking-widest text-xs">
                            Visit Store 
                        </a>
                    </div>
                </div>

            </div>

            {{-- RELATED PRODUCTS --}}
            @if($relatedProducts->count() > 0)
                <div class="mt-20 pt-12 border-t border-slate-200">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-black text-secondary tracking-tight">Similar Assets</h2>
                        <a href="#" class="text-sm font-bold text-primary hover:underline">View All Category</a>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('buyer.product.show', $related) }}" class="group bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-500">
                                <div class="aspect-square bg-slate-50 overflow-hidden relative">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/400x400' }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                    <div class="absolute inset-0 bg-secondary/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="p-5">
                                    <h4 class="font-bold text-secondary truncate mb-2 group-hover:text-primary transition">{{ $related->name }}</h4>
                                    <p class="text-lg font-black text-secondary tracking-tighter">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </main>
</x-app-layout>