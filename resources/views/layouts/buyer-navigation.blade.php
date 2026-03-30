<nav x-data="{ open: false }" class="bg-primary border-b border-white/10 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center gap-10">
                <a href="{{ route('buyer.index') }}" class="flex items-center gap-2 group">
                    <div class="w-9 h-9 bg-primary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-105 transition-transform">
                        A
                    </div>
                    <span class="font-serif font-bold text-white text-lg hidden sm:block tracking-tight group-hover:text-tertiary transition-colors">
                        AkuDatang
                    </span>
                </a>

                <div class="hidden sm:flex items-center gap-6">
                    {{-- Link 1: Shopping --}}
                    <x-nav-link :href="route('buyer.index')" :active="request()->routeIs('buyer.index')"
                        class="text-slate-300 hover:text-white transition font-medium {{ request()->routeIs('buyer.index') ? 'text-white font-bold border-b-2 border-tertiary' : '' }}">
                        Shopping
                    </x-nav-link>

                    {{-- Link 2: My Orders --}}
                    <x-nav-link :href="route('buyer.orders.index')" :active="request()->routeIs('buyer.orders.*')"
                        class="text-slate-300 hover:text-white transition font-medium {{ request()->routeIs('buyer.orders.*') ? 'text-white font-bold border-b-2 border-tertiary' : '' }}">
                        My Orders
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-4">

                {{-- Chatting --}}
                <a 
                {{-- href="{{ route('chat.chatlist') }}" --}}
                    class="relative p-2 text-slate-300 hover:text-white transition group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 21l1.8-4.2A7.962 7.962 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-accent rounded-full">
                        {{ auth()->user()->cart_count }}
                    </span>
                </a>

                {{-- Shopping Cart --}}
                <a href="{{ route('buyer.cart.index') }}"
                    class="relative p-2 text-slate-300 hover:text-white transition group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-accent rounded-full">
                        {{ auth()->user()->cart_count }}
                    </span>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 transition focus:outline-none">
                            <div class="hidden md:block text-right">
                                <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                            </div>
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="object-cover w-9 h-9 rounded-full border-2 border-primary bg-primary/20" />
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-medium text-secondary truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        {{-- <x-dropdown-link :href="route('buyer.faq')">FAQ</x-dropdown-link> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-600">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-slate-400 hover:text-white hover:bg-white/10">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" class="sm:hidden bg-secondary border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('buyer.index')" :active="request()->routeIs('buyer.index')"
                class="text-white hover:bg-primary/20 border-tertiary">
                Shopping
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('buyer.orders.index')" :active="request()->routeIs('buyer.orders.*')"
                class="text-white hover:bg-primary/20 border-tertiary">
                My Orders
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('buyer.cart.index') }}"
                class="text-slate-300 hover:text-white hover:bg-primary/20">
                Cart ({{ auth()->user()->cart_count }})
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-white/10">
            <div class="px-4 flex items-center gap-3">
                <div class="flex-shrink-0">
                    <img src="{{ Auth::user()->avatar_url }}" class="h-10 w-10 rounded-full border-2 border-primary">
                </div>
                <div>
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-slate-300 hover:text-white hover:bg-primary/20">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-400 hover:text-red-300 hover:bg-primary/20">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>