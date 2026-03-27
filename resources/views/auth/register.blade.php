<x-guest-layout>

    {{-- Header Form --}}
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-serif font-bold text-secondary tracking-tight">
            Mulai Perjalananmu
        </h2>
        <p class="text-secondary/70 mt-2 text-sm">
            Bergabunglah dengan komunitas {{ config('app.name') }} hari ini.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- ROLE --}}
        <div class="space-y-2">
            <label class="text-xs font-bold text-secondary uppercase tracking-wider ml-1">
                Saya ingin mendaftar sebagai:
            </label>

            <div class="grid grid-cols-2 gap-4">

                {{-- BUYER --}}
                <label class="cursor-pointer group relative">
                    <input type="radio" name="role" value="buyer" class="peer sr-only"
                        {{ old('role') == 'buyer' ? 'checked' : '' }} required>

                    <div
                        class="p-4 rounded-xl border-2 border-tertiary/30 bg-surface
                        hover:border-tertiary/60 hover:bg-tertiary/10
                        transition-all duration-200
                        peer-checked:border-tertiary
                        peer-checked:bg-tertiary/20
                        peer-checked:shadow-md
                        flex flex-col items-center justify-center text-center">

                        <span class="text-3xl mb-2 filter grayscale peer-checked:grayscale-0 transition-all">
                            🛍️
                        </span>

                        <span
                            class="text-sm font-bold text-gray-500 group-hover:text-secondary peer-checked:text-secondary">
                            Buyer
                        </span>

                        <span class="text-[10px] text-gray-400 peer-checked:text-secondary">
                            Untuk berbelanja
                        </span>
                    </div>

                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-tertiary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293
                                  a1 1 0 00-1.414-1.414L9 10.586
                                  7.707 9.293a1 1 0 00-1.414
                                  1.414l2 2a1 1 0 001.414
                                  0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </label>

                {{-- SELLER --}}
                <label class="cursor-pointer group relative">
                    <input type="radio" name="role" value="seller" class="peer sr-only"
                        {{ old('role') == 'seller' ? 'checked' : '' }}>

                    <div
                        class="p-4 rounded-xl border-2 border-tertiary/30 bg-surface
                        hover:border-tertiary/60 hover:bg-tertiary/10
                        transition-all duration-200
                        peer-checked:border-tertiary
                        peer-checked:bg-tertiary/20
                        peer-checked:shadow-md
                        flex flex-col items-center justify-center text-center">

                        <span class="text-3xl mb-2 filter grayscale peer-checked:grayscale-0 transition-all">
                            🏪
                        </span>

                        <span
                            class="text-sm font-bold text-gray-500 group-hover:text-secondary peer-checked:text-secondary">
                            Seller
                        </span>

                        <span class="text-[10px] text-gray-400 peer-checked:text-secondary">
                            Untuk berjualan
                        </span>
                    </div>

                    <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-tertiary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293
                                  a1 1 0 00-1.414-1.414L9 10.586
                                  7.707 9.293a1 1 0 00-1.414
                                  1.414l2 2a1 1 0 001.414
                                  0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </label>

            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>


        {{-- INPUT (Reusable pattern) --}}
        @php
            $inputClass = "block w-full pl-10 pr-4 py-3
                bg-background border border-tertiary/30 rounded-lg
                focus:ring-2 focus:ring-tertiary
                focus:border-tertiary focus:bg-surface
                transition-all placeholder-gray-400 text-sm";
        @endphp


        {{-- NAME --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-tertiary">
                {{-- icon --}}
            </div>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                class="{{ $inputClass }}" placeholder="Nama Lengkap">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- EMAIL --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-tertiary">
                {{-- icon --}}
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="{{ $inputClass }}" placeholder="Alamat Email">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- PASSWORD --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-tertiary"></div>
            <input id="password" type="password" name="password" required
                class="{{ $inputClass }}" placeholder="Kata Sandi">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-tertiary"></div>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="{{ $inputClass }}" placeholder="Ulangi Kata Sandi">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>


        {{-- BUTTON --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full py-3.5 px-4
                bg-gradient-to-r from-primary to-tertiary
                hover:from-tertiary hover:to-primary
                text-white font-bold rounded-xl
                shadow-lg shadow-primary/30
                transform transition-all duration-200
                hover:-translate-y-0.5
                focus:outline-none focus:ring-2
                focus:ring-offset-2 focus:ring-primary">

                {{ __('Daftar Sekarang') }}

            </button>
        </div>


        {{-- LOGIN LINK --}}
        <div class="mt-6 text-center text-sm text-gray-500">
            Sudah memiliki akun?

            <a href="{{ route('login') }}"
                class="font-bold text-tertiary hover:text-primary hover:underline transition-colors">
                Masuk di sini
            </a>
        </div>

    </form>

</x-guest-layout>