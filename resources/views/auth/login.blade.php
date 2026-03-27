<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-3xl font-serif font-bold text-secondary tracking-tight">
            Selamat Datang Kembali
        </h2>
        <p class="text-secondary/70 mt-2 text-sm">
            Masuk untuk melanjutkan perjalananmu 
        </p>
        <p class="text-secondary/70 mt-2 text-sm">
            di {{ config('app.name') }}. Belum punya akun? <a href="{{ route('register') }}" class="text-tertiary hover:text-primary hover:underline transition-colors">Daftar di sini</a>
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-tertiary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <input id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"

                class="block w-full pl-10 pr-4 py-3
                bg-background border border-tertiary/30 rounded-lg
                focus:ring-2 focus:ring-tertiary
                focus:border-tertiary focus:bg-white
                transition-all placeholder-gray-400 text-sm"

                placeholder="Alamat Email">

            <x-input-error :messages="$errors->get('email')" class="mt-1"/>
        </div>


        <!-- Password -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-tertiary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <input id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"

                class="block w-full pl-10 pr-4 py-3
                bg-background border border-tertiary/30 rounded-lg
                focus:ring-2 focus:ring-tertiary
                focus:border-tertiary focus:bg-white
                transition-all placeholder-gray-400 text-sm"

                placeholder="Kata Sandi">

            <x-input-error :messages="$errors->get('password')" class="mt-1"/>
        </div>


        <!-- Remember -->
        <div class="flex items-center justify-between mt-2">

            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-tertiary text-tertiary shadow-sm focus:ring-tertiary">

                <span class="ms-2 text-sm text-secondary/80">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-tertiary hover:text-primary hover:underline transition-colors">
                    {{ __('Forgot password?') }}
                </a>
            @endif

        </div>


        <!-- Button -->
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

                {{ __('Masuk') }}

            </button>
        </div>

    </form>

</x-guest-layout>