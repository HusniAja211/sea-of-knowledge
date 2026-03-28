<x-app-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    {{-- Main Background --}}
    <main class="min-h-screen">

        <div class="relative py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

                {{-- 🌊 Welcome Section --}}
                <div
                    class="bg-gradient-to-r from-secondary to-primary rounded-xl shadow-lg p-8 text-white relative overflow-hidden border-b-4 border-accent">
                    <div class="relative z-10">
                        <h3 class="text-3xl font-serif mb-2">
                            Welcome back, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-gray-300 max-w-2xl text-lg">
                            The ocean is calm today. You have
                            <span class="font-bold text-white">4 new orders</span>
                            waiting to be processed and
                            <span class="font-bold text-white">12 new titles</span>
                            drifting into your collection.
                        </p>
                    </div>

                    <div class="absolute -right-10 -bottom-16 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl"></div>
                </div>

                {{-- 📊 Statistics --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Total Seller - Ikon: Storefront --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex justify-between mb-4">
                                <div class="text-primary bg-background p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 21h3.75V13.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21Z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-accent bg-orange-50 px-2 py-1 rounded">
                                    +5 this week
                                </span>
                            </div>
                            <div class="text-3xl font-bold text-secondary">{{ $totalSeller }}</div>
                            <div class="text-sm text-gray-500">Total Seller</div>
                        </div>
                    </div>

                    {{-- Total Buyer - Ikon: Users --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="text-primary bg-background p-3 rounded-full mb-4 w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-secondary">{{ $totalBuyer }}</div>
                            <div class="text-sm text-gray-500">Total Buyer</div>
                        </div>
                    </div>

                    {{-- Total Product - Ikon: Book Open (Sesuai tema buku Anda) --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex justify-between mb-4">
                                <div class="text-primary bg-background p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-tertiary bg-teal-50 px-2 py-1 rounded">
                                    +12%
                                </span>
                            </div>
                            <div class="text-3xl font-bold text-secondary">lorem</div>
                            <div class="text-sm text-gray-500">Total Products</div>
                        </div>
                    </div>

                    {{-- Total Categories - Ikon: Tag/Squares --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="text-primary bg-background p-3 rounded-full mb-4 w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182 0l4.318-4.318a2.25 2.25 0 0 0 0-3.182L11.159 3.659A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-secondary">{{ $totalCategories }}</div>
                            <div class="text-sm text-gray-500">Total Categories</div>
                        </div>
                    </div>
                </div>

                {{-- 📜 Activity + Profile --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Activity --}}
                    <div class="lg:col-span-2 bg-white shadow-sm rounded-lg border-t-4 border-secondary">
                        <div class="p-6 border-b flex justify-between">
                            <h3 class="font-bold text-secondary">
                                Recent Activity in the Coral Reef
                            </h3>
                            <button class="text-tertiary hover:text-primary">
                                View All
                            </button>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex space-x-3">
                                <div class="w-2 h-2 bg-accent rounded-full mt-2"></div>
                                <p>New Book Added: <span class="italic text-primary">"The Hidden Life of Trees"</span>
                                </p>
                            </div>

                            <div class="flex space-x-3">
                                <div class="w-2 h-2 bg-tertiary rounded-full mt-2"></div>
                                <p>Order #4092 Shipped</p>
                            </div>
                        </div>
                    </div>

                    {{-- Profile --}}
                    <div class="bg-secondary text-white rounded-lg shadow-lg">
                        <div class="p-6">
                            <h3 class="font-bold mb-4 border-b border-tertiary pb-2">
                                Ocean Keeper Profile
                            </h3>

                            <div class="flex items-center space-x-4 mb-6">
                                <div
                                    class="h-12 w-12 rounded-full bg-tertiary flex items-center justify-center text-secondary font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>

                                <div>
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="text-sm text-gray-300">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between bg-primary p-2 rounded">
                                    <span>Role</span>
                                    <span class="font-bold">{{ Auth::user()->role->name }}</span>
                                </div>

                                <div class="flex justify-between bg-primary p-2 rounded">
                                    <span>Region</span>
                                    <span class="font-bold">Deep Sea</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
</x-app-layout>
