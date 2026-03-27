<section>
    <header>
        <h2 class="text-lg font-bold text-secondary">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile picture.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- File Upload Input Styling --}}
        <div class="group" x-data="{ fileName: '' }">
            <x-input-label for="pfp" :value="__('Profile Picture')"
                class="text-secondary font-semibold group-focus-within:text-primary" />

            <div
                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10 hover:border-tertiary hover:bg-tertiary/5 transition-all relative">
                <div class="text-center">
                    {{-- Preview pfp --}}
                    <img id="image-preview" src="/defaultpfp.png" class="w-24 h-24 rounded-full object-cover">

                    <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                        <label for="pfp"
                            class="relative cursor-pointer rounded-md font-bold text-primary hover:text-tertiary focus-within:outline-none focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 transition-colors">
                            <span>Upload a file</span>
                            {{-- Input File --}}
                            <input id="pfp" name="pfp" type="file" class="sr-only" accept="image/*"
                                @change="fileName = $event.target.files[0].name">
                            <input type="hidden" name="crop_data" id="crop_data">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-500">PNG, JPG up to 2MB</p>

                    {{-- Feedback Nama File --}}
                    <p x-show="fileName" x-text="fileName" class="text-xs font-bold text-primary mt-2"></p>
                </div>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('pfp')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-primary hover:brightness-110 focus:ring-primary shadow-md">
                {{ __('Update Photo') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-tertiary font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Photo updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>
