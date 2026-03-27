<x-app-layout>
    {{-- Background Texture (Atmosphere) --}}
    <main class="min-h-screen relative py-12 bg-background">
        <div class="absolute inset-0 z-0 opacity-5 pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'2\' cy=\'2\' r=\'1\' fill=\'%231E40AF\'/%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Header --}}
            <div class="mb-8 flex items-center space-x-2 text-sm text-primary">
                <a href="{{ route('admin.buyer.index') }}"
                    class="hover:text-tertiary transition font-medium">Category</a>
                <span class="text-slate-400">/</span>
                <span class="font-bold text-secondary">Update Buyer</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: The Visual Persona (ID Card Style) --}}
                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-secondary rounded-2xl shadow-xl overflow-hidden text-white relative group transform hover:-translate-y-1 transition duration-500">
                        {{-- Decorative background curves --}}
                        <div
                            class="absolute top-0 right-0 -mr-8 -mt-8 w-40 h-40 rounded-full bg-primary opacity-20 blur-2xl">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 -ml-8 -mb-8 w-40 h-40 rounded-full bg-tertiary opacity-10 blur-2xl">
                        </div>

                        <div class="p-8 relative z-10 flex flex-col items-center text-center">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                class="w-24 h-24 rounded-full border-4 border-primary/30 bg-slate-800 flex items-center justify-center text-3xl font-serif font-bold shadow-lg mb-4 object-cover" />

                            <h3 class="font-sans text-2xl font-bold tracking-wide">{{ $user->name }}</h3>
                            <p class="text-tertiary text-sm uppercase tracking-wider font-semibold mt-1">
                                {{ $user->role->name }}
                            </p>

                            <div class="mt-6 w-full border-t border-slate-700 pt-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-slate-400">ID Number</span>
                                    <span class="font-mono text-slate-200">{{ $user->id ?? '---' }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-400">Joined</span>
                                    <span class="text-slate-200">{{ $user->created_at->format('D M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Bottom decorative strip --}}
                        <div class="h-2 bg-gradient-to-r from-primary via-tertiary to-accent"></div>
                    </div>

                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                        <h4 class="text-secondary font-bold flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Note
                        </h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Ensure NIK matches your official government ID. Changes to sensitive data may require
                            re-verification by the System Administrator.
                        </p>
                    </div>
                </div>

                {{-- RIGHT COLUMN: The Form (Clean Paper Style) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-primary overflow-hidden">

                        <div class="p-8">
                            <div class="mb-6 pb-6 border-b border-slate-100 flex justify-between items-end">
                                <div>
                                    <h2 class="text-2xl font-bold text-secondary">Update Information</h2>
                                    <p class="text-slate-500 text-sm mt-1">Update your personal details and contact
                                        address.</p>
                                </div>
                                {{-- Status Indicator --}}
                                <span
                                    class="hidden sm:inline-block px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold uppercase tracking-wide">
                                    Active Mode
                                </span>
                            </div>

                            <form action="{{ route('admin.buyer.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PATCH')

                                {{-- Section: Identity --}}
                                <div class="space-y-4">
                                    <h3 class="text-sm font-bold text-primary uppercase tracking-wider mb-3">
                                        Identity</h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- Name Input --}}
                                        <div class="group">
                                            <label for="name"
                                                class="block text-sm font-medium text-slate-700 mb-1 transition-colors group-focus-within:text-primary">Full
                                                Name</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none"
                                                placeholder="e.g. Eleanor Fern" required>
                                            @error('name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- NIK Input --}}
                                        <div class="group">
                                            <label for="nik"
                                                class="block text-sm font-medium text-slate-700 mb-1 transition-colors group-focus-within:text-primary">NIK
                                                (Identity Number)</label>
                                            <div class="relative">
                                                <input type="text" name="nik" id="nik"
                                                    value="{{ old('nik', $user->nik) }}" inputmode="numeric"
                                                    pattern="[0-9]{16}" maxlength="16" minlength="16"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="w-full bg-slate-50 border
                                                    {{ $errors->has('nik') ? 'border-red-400 focus:ring-red-100' : 'border-slate-200 focus:ring-primary/20 focus:border-primary' }}
                                                    rounded-lg px-4 py-2.5 font-mono text-secondary focus:bg-white focus:ring-2 transition-all outline-none"
                                                    placeholder="16-digit NIK" required>

                                                <div class="absolute right-3 top-2.5 text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            @error('nik')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Section: Contact --}}
                                <div class="space-y-4 pt-4">
                                    <h3 class="text-sm font-bold text-primary uppercase tracking-wider mb-3">
                                        Correspondence</h3>

                                    {{-- Email Input --}}
                                    <div class="group">
                                        <label for="email"
                                            class="block text-sm font-medium text-slate-700 mb-1 transition-colors group-focus-within:text-primary">Email
                                            Address</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none"
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Address Input --}}
                                    <div class="group">
                                        <label for="address"
                                            class="block text-sm font-medium text-slate-700 mb-1 transition-colors group-focus-within:text-primary">Full
                                            Address</label>
                                        <textarea name="address" id="address" rows="4"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none resize-none leading-relaxed"
                                            placeholder="Street, City, Province, Postal Code...">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Profile Picture Input --}}
                                    <div class="group" x-data="{ fileName: '' }">
                                        <label for="pfp"
                                            class="block text-sm font-medium text-slate-700 mb-1 transition-colors group-focus-within:text-primary">
                                            Profile Picture
                                        </label>

                                        <div
                                            class="mt-2 flex justify-center rounded-lg border border-dashed border-slate-300 px-6 py-10 hover:bg-slate-50 transition-colors relative">
                                            <div class="text-center">
                                                <img id="image-preview" src="/defaultpng.png"
                                                    class="w-24 h-24 rounded-full object-cover">
                                                <div class="mt-4 flex text-sm leading-6 text-slate-600 justify-center">
                                                    <label for="pfp"
                                                        class="relative cursor-pointer rounded-md font-bold text-primary hover:text-secondary focus-within:outline-none">
                                                        <span>Change file</span>
                                                        <input id="pfp" name="pfp" type="file"
                                                            class="sr-only" accept="image/*"
                                                            @change="fileName = $event.target.files[0].name">
                                                        <input type="hidden" name="crop_data" id="crop_data">
                                                    </label>
                                                </div>
                                                <p class="text-xs leading-5 text-slate-500">PNG, JPG up to 10MB</p>

                                                <p x-show="fileName" x-text="fileName"
                                                    class="text-xs font-bold text-primary mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        {{-- Action Bar --}}
                        <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.buyer.index') }}"
                                class="px-6 py-2.5 text-sm font-medium text-slate-600 hover:text-secondary transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-8 py-2.5 bg-accent text-white font-bold rounded-lg shadow-md hover:opacity-90 transform active:scale-95 transition-all duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>
</x-app-layout>
