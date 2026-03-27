<x-app-layout>
    <x-slot:title>
        Add New Category
    </x-slot:title>
    {{-- Background Texture (Atmosphere) --}}
    <main class="min-h-screen relative py-12">
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Header --}}
            <div class="mb-8 flex items-center space-x-2 text-sm text-primary">
                <a href="{{ route('admin.category.index') }}" class="hover:text-tertiary transition">Category</a>
                <span class="text-primary/50">/</span>
                <span class="font-bold text-secondary">Update Category</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: The Visual Persona (ID Card Style) --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white backdrop-blur-sm rounded-xl p-6 border border-white/60 shadow-sm">
                        <h4 class="text-secondary font-bold flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Note
                        </h4>
                        <p class="text-sm text-secondary/70 leading-relaxed">
                            Ensure NIK matches your official government ID. Changes to sensitive data may require
                            re-verification by the Admin Team.
                        </p>
                    </div>
                </div>

                {{-- RIGHT COLUMN: The Form (Clean Paper Style) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-primary overflow-hidden">

                        <div class="p-8">
                            <div class="mb-6 pb-6 border-b border-secondary/20 flex justify-between items-end">
                                <div>
                                    <h2 class="text-2xl font-serif font-bold text-secondary">Update Category</h2>
                                    <p class="text-secondary/70 text-sm mt-1"> Update Category Data</p>
                                </div>
                                {{-- Status Indicator --}}
                                <span
                                    class="hidden sm:inline-block px-3 py-1 rounded-full bg-tertiary text-white text-xs font-bold uppercase tracking-wide">
                                    Active Mode
                                </span>
                            </div>

                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PATCH')
                                {{-- Section: Identity --}}
                                <div class="space-y-4">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                        {{-- Name Input --}}
                                        <div class="group">
                                            <label for="name"
                                                class="block text-sm font-medium text-secondary mb-1 transition-colors group-focus-within:text-primary">
                                                Name
                                            </label>
                                            <div class="relative">
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name', $category->name) }}"
                                                    class="w-full bg-background border
                                                           {{ $errors->has('name') ? 'border-accent focus:ring-accent' : 'border-secondary/50 focus:ring-primary' }}
                                                           rounded-lg px-4 py-2.5 text-secondary focus:bg-white focus:ring-2 focus:border-transparent transition-all duration-200 outline-none"
                                                    placeholder="e.g. Book" required>
                                            </div>
                                            @error('name')
                                                <p class="text-accent text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Bar --}}
                                <div class="pt-6 mt-6 border-t border-secondary/20 flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.category.index') }}"
                                        class="px-6 py-2.5 text-sm font-medium text-secondary/70 hover:text-secondary transition-colors">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-8 py-2.5 bg-accent text-white font-bold rounded-lg shadow-md hover:bg-primary hover:shadow-lg transform active:scale-95 transition-all duration-200 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Update Data
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