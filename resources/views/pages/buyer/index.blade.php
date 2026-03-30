<x-app-layout>
    <x-slot:title>Shop</x-slot:title>

    <div class="min-h-screen pb-20 pt-8">

        {{-- HERO --}}
        <div
            class="relative w-[95%] md:w-[80%] max-w-6xl mx-auto bg-secondary text-white overflow-hidden shadow-2xl rounded-[2rem]">
            {{-- Decorative pattern --}}
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(#14B8A6 1px, transparent 1px); background-size: 20px 20px;">
            </div>

            <div
                class="px-6 lg:px-12 py-16 md:py-20 relative z-10 flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="max-w-xl text-center md:text-left">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-tertiary/20 text-tertiary text-xs font-bold tracking-wider mb-6 border border-tertiary/30">
                        NEW ARRIVALS
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold leading-tight mb-6">
                        Discover Inspiration <br>
                        <span class="text-tertiary italic">Without Limits</span>
                    </h1>
                    <p class="text-slate-300 text-lg mb-10 max-w-md">
                        Complete your study and work needs with the best selection of books and stationery.
                    </p>

                    {{-- Search Bar --}}
                    <div class="relative max-w-md mx-auto md:mx-0 group">
                        <form action="{{ route('buyer.index') }}" method="GET">
                            <input type="text" placeholder="Search your favorite books..." name="search"
                                value="{{ request('search') }}"
                                class="w-full py-4 pl-12 pr-4 rounded-2xl bg-white text-secondary focus:outline-none focus:ring-4 focus:ring-tertiary/30 shadow-2xl transition-all">
                            <svg class="w-6 h-6 text-slate-400 absolute left-4 top-4 group-focus-within:text-tertiary transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </form>
                    </div>
                </div>

                <div class="hidden md:block relative">
                    {{-- Decorative Glow --}}
                    <div class="absolute -inset-4 bg-tertiary/20 blur-3xl rounded-full"></div>
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=1074&q=80"
                        class="relative w-72 lg:w-80 h-[400px] lg:h-[450px] object-cover rounded-[2.5rem] shadow-2xl rotate-2 hover:rotate-0 transition duration-700 border-8 border-white/5"
                        alt="Hero Image">
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="w-[95%] md:w-[80%] max-w-6xl mx-auto mt-12">

            {{-- CATEGORY FILTER --}}
            <div class="flex gap-3 overflow-x-auto pb-4">
                <a href="{{ route('buyer.index') }}"
                    class="px-6 py-3 rounded-xl font-bold
                    {{ !request('category') ? 'bg-primary text-white' : 'bg-white' }}">
                    All
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('buyer.index', ['category' => $category->id]) }}"
                        class="px-6 py-3 rounded-xl font-bold
                        {{ request('category') == $category->id ? 'bg-primary text-white' : 'bg-white' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            {{-- TITLE --}}
            <h2 class="text-2xl font-bold mt-10 mb-6">
                @if (request('search'))
                    Search Results for "{{ request('search') }}"
                @else
                    Recommended for You
                @endif
            </h2>

            {{-- GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">

                @forelse (request('search') ? $results : $products as $item)

                    @php
                        $isSearch = request('search');
                        $type = $isSearch ? $item['type'] : 'product';

                        $name = $isSearch ? $item['name'] : $item->name;
                        $image = $isSearch
                            ? $item['image'] ?? null
                            : ($item->image
                                ? asset('storage/' . $item->image)
                                : null);

                        $url = $isSearch ? $item['url'] : route('buyer.product.show', $item);
                    @endphp

                    <a href="{{ $url }}">
                        <div
                            class="bg-white rounded-2xl shadow-sm hover:shadow-md transition flex flex-col overflow-hidden">

                            {{-- IMAGE --}}
                            <div class="h-40 bg-slate-100 flex items-center justify-center">
                                @if ($type === 'product')
                                    @if ($image)
                                        <img src="{{ $image }}" class="w-full h-full object-cover">
                                    @endif
                                @elseif($type === 'seller')
                                    <img src="{{ $image }}" class="w-16 h-16 rounded-full">
                                @elseif($type === 'category')
                                    <span class="text-3xl font-bold text-slate-400">#</span>
                                @endif
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-3 flex-1 flex flex-col">

                                {{-- TYPE BADGE --}}
                                <span class="text-xs text-tertiary font-bold mb-1">
                                    @if ($type === 'product')
                                        {{ request('search') ? $item['category'] : $item->category->name }}
                                    @elseif($type === 'seller')
                                        Seller
                                    @elseif($type === 'category')
                                        Category
                                    @endif
                                </span>

                                {{-- NAME --}}
                                @php
                                    $highlighted = request('search')
                                        ? str_ireplace(
                                            request('search'),
                                            '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>',
                                            $name,
                                        )
                                        : $name;
                                @endphp

                                <h3 class="font-bold text-sm mb-2 line-clamp-2">
                                    {!! $highlighted !!}
                                </h3>

                                {{-- EXTRA --}}
                                @if ($type === 'product')
                                    <p class="text-xs text-slate-500">
                                        {{ $isSearch ? $item['seller'] : $item->seller->name }}
                                    </p>

                                    <p class="font-bold mt-2">
                                        Rp{{ number_format($isSearch ? $item['price'] : $item->price, 0, ',', '.') }}
                                    </p>
                                @endif

                            </div>

                        </div>
                    </a>

                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-slate-500">
                            @if (request('search'))
                                No results found for "{{ request('search') }}"
                            @else
                                No products available
                            @endif
                        </p>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if (!request('search'))
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
