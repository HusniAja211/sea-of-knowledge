<nav x-data="{ open: false }" class="bg-primary shadow-lg shadow-secondary/30">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('seller.index') }}" class="flex items-center gap-2">
                        <div
                            class="w-9 h-9 bg-[#0077B6] rounded-lg flex items-center justify-center text-white font-bold">
                            S
                        </div>
                        <span class="font-semibold text-white text-lg hidden sm:block">
                            SellerPanel
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-8">
                    <x-nav-link :href="route('seller.index')" :active="request()->routeIs('index')" class="text-white hover:text-white transition">
                        Home
                    </x-nav-link>

                    <x-nav-link :href="route('seller.product.index')" :active="request()->routeIs('dashboard')" class="text-white hover:text-white transition">
                        Products
                    </x-nav-link>

                    <x-nav-link :href="route('admin.buyer.index')" :active="request()->routeIs('dashboard')" class="text-white hover:text-white transition">
                        Order Status
                    </x-nav-link>

                    <x-nav-link :href="route('admin.category.index')" :active="request()->routeIs('index')" class="text-white hover:text-white transition">
                        Report
                    </x-nav-link>

                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden sm:flex sm:items-center">

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 focus:outline-none">
                            <div class="text-sm font-medium text-white">
                                {{ Auth::user()->name }}
                            </div>
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="object-cover w-10 h-10 rounded-full border-4 border-forest-moss bg-forest-pine flex items-center justify-center shadow-lg" />

                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-medium text-slate-700">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-slate-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        {{-- <x-dropdown-link :href="route('admin.faq')">
                            Help
                        </x-dropdown-link> --}}

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>


            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-slate-500 hover:bg-blue-50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="sm:hidden border-t border-blue-100 bg-white">
        <div class="px-6 py-4 space-y-2">
            {{-- <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link> --}}
        </div>

        <div class="border-t border-blue-100 px-6 py-4">
            <p class="font-medium text-slate-700">{{ Auth::user()->name }}</p>
            <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
            <p class="text-sm text-slate-500">{{ Auth::user()->roles }}</p>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>