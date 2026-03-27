<section>
    <header>
        <h2 class="text-lg font-bold text-secondary">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" 
                class="text-secondary font-semibold transition-colors group-focus-within:text-primary" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                class="mt-1 block w-full bg-background border-gray-200 focus:border-primary focus:ring-primary rounded-lg transition-all" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div class="group">
            <x-input-label for="update_password_password" :value="__('New Password')" 
                class="text-secondary font-semibold transition-colors group-focus-within:text-primary" />
            <x-text-input id="update_password_password" name="password" type="password" 
                class="mt-1 block w-full bg-background border-gray-200 focus:border-primary focus:ring-primary rounded-lg transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div class="group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" 
                class="text-secondary font-semibold transition-colors group-focus-within:text-primary" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="mt-1 block w-full bg-background border-gray-200 focus:border-primary focus:ring-primary rounded-lg transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            {{-- Menggunakan Primary Color (Blue) untuk Save Button --}}
            <x-primary-button class="bg-primary hover:brightness-110 focus:ring-primary shadow-md">
                {{ __('Save Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
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
                    {{ __('Saved Successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>