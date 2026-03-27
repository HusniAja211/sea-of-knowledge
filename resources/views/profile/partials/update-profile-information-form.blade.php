<section>
    <header>
        <h2 class="text-lg font-bold text-secondary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Name Input --}}
        <div class="group">
            <x-input-label for="name" :value="__('Name')" 
                class="text-secondary font-semibold transition-colors group-focus-within:text-primary" />
            <x-text-input id="name" name="name" type="text" 
                class="mt-1 block w-full bg-background border-gray-200 focus:border-primary focus:ring-primary rounded-lg transition-all" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email Input --}}
        <div class="group">
            <x-input-label for="email" :value="__('Email')" 
                class="text-secondary font-semibold transition-colors group-focus-within:text-primary" />
            <x-text-input id="email" name="email" type="email" 
                class="mt-1 block w-full bg-background border-gray-200 focus:border-primary focus:ring-primary rounded-lg transition-all" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-accent/10 border border-accent/20 rounded-lg">
                    <p class="text-sm text-secondary">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-accent hover:text-orange-600 font-bold transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-tertiary">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            {{-- Primary Action Button --}}
            <x-primary-button class="bg-primary hover:brightness-110 focus:ring-primary shadow-md px-8">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-tertiary font-bold flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Information updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>