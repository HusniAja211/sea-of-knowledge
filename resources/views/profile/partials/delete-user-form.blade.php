<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Danger button menggunakan merah standar untuk peringatan, namun ring focus menggunakan accent atau red --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 focus:ring-red-500 shadow-md transition-all"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        {{-- Mengganti bg-forest-paper dengan bg-white atau bg-background --}}
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-xl">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-secondary">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                {{-- Input disesuaikan dengan style form sebelumnya (bg-background dan border gray) --}}
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4 bg-background border-gray-200 focus:border-red-500 focus:ring-red-500 rounded-lg py-2.5"
                    placeholder="{{ __('Verify Password to Proceed') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end items-center gap-3">
                {{-- Cancel button menggunakan gaya yang lebih subtle --}}
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-secondary transition-colors">
                    {{ __('Cancel') }}
                </button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500 px-6 py-2.5 shadow-lg">
                    {{ __('Permanently Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>