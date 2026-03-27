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

                    {{-- Total Seller --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex justify-between mb-4">
                                <div class="text-primary bg-background p-3 rounded-full">
                                    <svg class="h-6 w-6 fill-current" viewBox="-351 153 256 256">
                                        <path d="M-276.9,265.2h19v14.9h-19V265.2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-accent bg-orange-50 px-2 py-1 rounded">
                                    +5 this week
                                </span>
                            </div>

                            <div class="text-3xl font-bold text-secondary"></div>
                            <div class="text-sm text-gray-500">Total Seller</div>
                        </div>
                    </div>

                    {{-- Total Buyer --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="text-primary bg-background p-3 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857" />
                                </svg>
                            </div>

                            <div class="text-3xl font-bold text-secondary"></div>
                            <div class="text-sm text-gray-500">Total Buyer</div>
                        </div>
                    </div>

                    {{-- Total Product --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex justify-between mb-4">
                                <div class="text-primary bg-background p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2"
                                            d="M12 6v13m0 0C9 17 6 16 3 16V3c3 0 6 1 9 3m0 13c3-2 6-3 9-3V3c-3 0-6 1-9 3" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-tertiary bg-teal-50 px-2 py-1 rounded">
                                    +12%
                                </span>
                            </div>

                            <div class="text-3xl font-bold text-secondary"></div>
                            <div class="text-sm text-gray-500">Total Products</div>
                        </div>
                    </div>

                    {{-- Total Categories --}}
                    <div class="bg-white shadow-sm rounded-lg border-l-4 border-tertiary hover:shadow-md transition">
                        <div class="p-6">
                            <div class="text-primary bg-background p-3 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-width="2"
                                        d="M5 8h14M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8" />
                                </svg>
                            </div>

                            <div class="text-3xl font-bold text-secondary"></div>
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
                                <p>New Book Added: <span class="italic text-primary">"The Hidden Life of Trees"</span></p>
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
                                <div class="h-12 w-12 rounded-full bg-tertiary flex items-center justify-center text-secondary font-bold">
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