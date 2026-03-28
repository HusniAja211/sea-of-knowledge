<x-app-layout>
    {{-- Main Container menggunakan class 'bg-background' --}}
    <main class="min-h-screen bg-background p-6 md:p-8 font-sans text-gray-800">
        
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div class="text-center sm:text-left">
                    <h1 class="text-3xl font-serif font-bold text-secondary">
                        Products Dashboard
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm">
                        Manage your product listings efficiently.
                    </p>
                </div>

                {{-- Add Product Button - Menggunakan 'bg-accent' --}}
                <a href="{{ route('seller.product.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-primary hover:bg-tertiary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 hover:-translate-y-1 gap-2 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Product
                </a>
            </div>

            {{-- Content Card --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr class="transition-colors duration-200 hover:bg-background/50">
                                    {{-- Name - Menggunakan 'text-primary' --}}
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-primary">
                                        {{ $product->name }}
                                    </td>

                                    {{-- Category - Menggunakan 'bg-tertiary' (Supporting color) --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 bg-tertiary text-white rounded-full text-[10px] font-bold uppercase">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    {{-- Stock --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center font-bold {{ $product->stock <= 10 ? 'text-accent' : 'text-gray-600' }}">
                                        {{ $product->stock }}
                                    </td>

                                    {{-- Price --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center font-mono text-sm text-gray-700">
                                        Rp{{ number_format($product->price, 0, ',', '.') }},00
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center gap-4">
                                            {{-- Edit - Menggunakan 'text-primary' --}}
                                            <a href="{{ route('seller.product.edit', ['product' => $product->id]) }}"
                                                class="text-primary hover:text-secondary transition-colors transform hover:scale-110"
                                                title="Edit Product">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <span class="text-gray-200">|</span>
                                            {{-- Delete - Tetap merah untuk fungsi destruktif --}}
                                            <button type="button"
                                                onclick="confirmDelete('{{ route('seller.product.destroy', ['product' => $product->id]) }}')"
                                                class="text-red-500 hover:text-red-700 transition-transform hover:scale-110"
                                                title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-tertiary/40 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <p class="text-secondary font-medium">Belum ada produk.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </main>
</x-app-layout>