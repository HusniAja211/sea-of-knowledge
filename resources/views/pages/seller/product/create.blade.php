<x-app-layout>
    {{-- Main Container menggunakan 'bg-background' --}}
    <main class="min-h-screen relative py-12">

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Header - Menggunakan 'text-primary' --}}
            <div class="mb-8 flex items-center space-x-2 text-sm text-primary">
                <a href="{{ route('seller.product.index') }}" class="hover:underline transition">Products</a>
                <span class="text-gray-400">/</span>
                <span class="font-bold text-secondary">Add New Product</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: Tips / Note --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                        <h4 class="text-secondary font-bold flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Seller Tips
                        </h4>
                        <ul class="text-sm text-gray-600 leading-relaxed space-y-4">
                            <li class="flex gap-2">
                                <span class="text-tertiary font-bold">•</span>
                                <span>Gunakan nama produk yang jelas dan menarik.</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-tertiary font-bold">•</span>
                                <span>Pastikan <strong>Harga Modal</strong> diisi untuk memantau profit.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- RIGHT COLUMN: The Form --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                        {{-- Decorative top bar using 'bg-primary' --}}
                        <div class="h-2 bg-primary"></div>

                        <div class="p-8">
                            <div class="mb-8 pb-6 border-b border-gray-100 flex justify-between items-center">
                                <div>
                                    <h2 class="text-2xl font-bold text-secondary">Product Details</h2>
                                    <p class="text-gray-500 text-sm mt-1">Lengkapi informasi produk baru Anda.</p>
                                </div>
                                <span
                                    class="hidden sm:inline-block px-3 py-1 rounded-lg bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase tracking-wider">
                                    New Entry
                                </span>
                            </div>

                            <form action="{{ route('seller.product.store') }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                {{-- 1. Product Name --}}
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-secondary mb-2">
                                        Product Name
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="w-full bg-gray-50 border {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none"
                                        placeholder="Masukkan nama produk..." required>
                                </div>

                                {{-- 2. Category & Stock --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="category_id"
                                            class="block text-sm font-semibold text-secondary mb-2">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary outline-none appearance-none cursor-pointer">
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="stock"
                                            class="block text-sm font-semibold text-secondary mb-2">Stock
                                            Quantity</label>
                                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                            min="1"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary outline-none"
                                            placeholder="0">
                                    </div>
                                </div>

                                {{-- 3. Pricing - Highlight khusus harga --}}
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-background/50 p-6 rounded-2xl border border-gray-100">
                                    <div>
                                        <label for="price" class="block text-sm font-bold text-primary mb-2">Selling
                                            Price (Rp)</label>
                                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                                            min="0"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:ring-2 focus:ring-primary outline-none shadow-sm"
                                            placeholder="0">
                                    </div>

                                    <div>
                                        <label for="modal"
                                            class="block text-sm font-semibold text-gray-600 mb-2">Modal / Cost
                                            (Rp)</label>
                                        <input type="number" name="modal" id="modal" value="{{ old('modal') }}"
                                            min="0"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-gray-500 focus:ring-2 focus:ring-tertiary outline-none shadow-sm"
                                            placeholder="0">
                                    </div>
                                </div>

                                {{-- 4. Description --}}
                                <div>
                                    <label for="description"
                                        class="block text-sm font-semibold text-secondary mb-2">Description</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary outline-none resize-none"
                                        placeholder="Tuliskan deskripsi lengkap produk Anda...">{{ old('description') }}</textarea>
                                </div>

                                {{-- 5. Image Upload --}}
                                <div x-data="{ fileName: '' }">
                                    <label class="block text-sm font-semibold text-secondary mb-2">Product Image</label>
                                    <div
                                        class="mt-1 flex justify-center rounded-2xl border-2 border-dashed border-gray-200 px-6 py-10 hover:border-primary hover:bg-primary/5 transition-all relative">
                                        <div class="text-center">
                                            <img id="image-preview" src="/defaultpng.png"
                                                class="w-24 h-24 rounded-full object-cover">
                                            <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                                <label for="image"
                                                    class="relative cursor-pointer font-bold text-primary hover:text-secondary">
                                                    <span>Upload a file</span>
                                                    <input id="image" name="image" type="file" class="sr-only"
                                                        accept="image/*"
                                                        @change="fileName = $event.target.files[0].name">
                                                    <input type="hidden" name="crop_data" id="crop_data">
                                                </label>
                                            </div>
                                            <p x-show="fileName" x-text="fileName"
                                                class="text-xs font-bold text-primary mt-2"></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Bar - Tombol Utama menggunakan 'bg-accent' --}}
                                <div class="pt-8 flex items-center justify-end gap-4 border-t border-gray-100">
                                    <a href="{{ route('seller.product.index') }}"
                                        class="px-6 py-3 text-sm font-semibold text-gray-500 hover:text-secondary transition-colors">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-10 py-3 bg-accent hover:opacity-90 text-white font-bold rounded-xl shadow-lg shadow-accent/20 transform active:scale-95 transition-all duration-200 flex items-center gap-2">
                                        Create Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
