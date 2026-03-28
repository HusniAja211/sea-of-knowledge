<x-app-layout>
    {{-- Main Container menggunakan 'bg-background' --}}
    <main class="min-h-screen bg-background relative py-12 font-sans">

        {{-- Background Texture - Menggunakan opacity rendah dari Primary --}}
        <div class="absolute inset-0 z-0 opacity-5 pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'2\' cy=\'2\' r=\'1\' fill=\'%231E40AF\'/%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Header --}}
            <div class="mb-8 flex items-center space-x-2 text-sm text-primary">
                <a href="{{ route('seller.product.index') }}" class="hover:underline transition">Products</a>
                <span class="text-gray-400">/</span>
                <span class="font-bold text-secondary">Edit Product</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: Tips & Current Image --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- Editing Tips - Menggunakan 'tertiary' untuk aksen --}}
                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                        <h4 class="text-secondary font-bold flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Editing Tips
                        </h4>
                        <ul class="text-sm text-gray-600 leading-relaxed space-y-3 list-disc list-inside">
                            <li>Perbarui stok secara berkala agar tidak terjadi <em>overselling</em>.</li>
                            <li>Jika mengganti gambar, pastikan resolusinya tetap baik.</li>
                        </ul>
                    </div>

                    {{-- CURRENT IMAGE DISPLAY --}}
                    @if ($product->image)
                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm text-center">
                            <p class="text-[10px] font-bold text-gray-400 mb-3 uppercase tracking-wider text-left">
                                Current Image</p>
                            <div
                                class="relative w-full aspect-square rounded-lg overflow-hidden border border-gray-100">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: The Form --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-primary overflow-hidden">

                        <div class="p-8">
                            <div class="mb-8 pb-6 border-b border-gray-100 flex justify-between items-end">
                                <div>
                                    <h2 class="text-2xl font-bold text-secondary">Edit Product</h2>
                                    <p class="text-gray-500 text-sm mt-1">Update: <strong>{{ $product->name }}</strong>
                                    </p>
                                </div>
                                <span
                                    class="hidden sm:inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase">
                                    Edit Mode
                                </span>
                            </div>

                            <form action="{{ route('seller.product.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PUT')

                                {{-- 1. Product Name --}}
                                <div>
                                    <label for="name"
                                        class="block text-sm font-semibold text-secondary mb-2">Product Name</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $product->name) }}"
                                        class="w-full bg-gray-50 border {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary outline-none transition-all"
                                        required>
                                </div>

                                {{-- 2. Category & Stock --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="category_id"
                                            class="block text-sm font-semibold text-secondary mb-2">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:ring-2 focus:ring-primary outline-none appearance-none">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="stock"
                                            class="block text-sm font-semibold text-secondary mb-2">Stock
                                            Quantity</label>
                                        <input type="number" name="stock" id="stock"
                                            value="{{ old('stock', $product->stock) }}"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:ring-2 focus:ring-primary outline-none">
                                    </div>
                                </div>

                                {{-- 3. Pricing & Internal Profit --}}
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-background/50 p-6 rounded-2xl border border-gray-100">
                                    <div>
                                        <label for="price" class="block text-sm font-bold text-primary mb-2">Selling
                                            Price (Rp)</label>
                                        <input type="number" name="price" id="price"
                                            value="{{ old('price', $product->price) }}"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:ring-2 focus:ring-primary outline-none shadow-sm">
                                    </div>
                                    <div>
                                        <label for="modal"
                                            class="block text-sm font-semibold text-gray-500 mb-2">Internal Cost
                                            (Rp)</label>
                                        <input type="number" name="modal" id="modal"
                                            value="{{ old('modal', $product->modal) }}"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-gray-400 focus:ring-2 focus:ring-tertiary outline-none shadow-sm">
                                    </div>
                                </div>

                                {{-- 4. Description --}}
                                <div>
                                    <label for="description"
                                        class="block text-sm font-semibold text-secondary mb-2">Description</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary outline-none resize-none">{{ old('description', $product->description) }}</textarea>
                                </div>

                                {{-- 5. Image Upload --}}
                                <div x-data="{ fileName: '' }">
                                    <label for="image" class="block text-sm font-semibold text-secondary mb-2">Change
                                        Product Image</label>
                                    <div
                                        class="mt-2 flex justify-center rounded-xl border-2 border-dashed border-gray-200 px-6 py-10 hover:border-primary hover:bg-primary/5 transition-all relative">
                                        <div class="text-center">
                                            <img id="image-preview" src="/defaultpng.png"
                                                class="w-24 h-24 rounded-full object-cover">
                                            <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                                <label for="image"
                                                    class="relative cursor-pointer font-bold text-primary hover:text-secondary">
                                                    <span>Click to change image</span>
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

                                {{-- Action Bar --}}
                                <div class="pt-8 flex items-center justify-end gap-4 border-t border-gray-100">
                                    <a href="{{ route('seller.product.index') }}"
                                        class="px-6 py-3 text-sm font-semibold text-gray-400 hover:text-secondary transition-colors">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-10 py-3 bg-accent hover:opacity-90 text-white font-bold rounded-xl shadow-lg shadow-accent/20 transition-all flex items-center gap-2">
                                        Save Changes
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
