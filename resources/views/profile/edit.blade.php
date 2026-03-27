<x-app-layout>

    <main class="min-h-screen py-12 relative overflow-hidden">
       
        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="space-y-8">

                {{-- PROFILE CARD (VISUAL HEADER) --}}
                <div class="bg-secondary rounded-2xl shadow-xl text-white overflow-hidden relative group">
                    {{-- Decorative Glows --}}
                    <div
                        class="absolute top-0 right-0 -mr-8 -mt-8 w-40 h-40 rounded-full bg-primary opacity-20 blur-2xl">
                    </div>

                    <div class="p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 relative z-10">
                        {{-- Avatar --}}
                        <div class="relative">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="object-cover w-24 h-24 rounded-full border-4 border-primary/30 bg-primary/20 shadow-lg" />
                        </div>

                        {{-- Text Info --}}
                        <div class="text-center sm:text-left flex-1">
                            <h3 class="text-2xl font-bold tracking-wide">
                                {{ $user->name }}
                            </h3>
                            <p class="text-tertiary text-sm uppercase font-semibold mt-1 tracking-wider">
                                {{ $user->role->name}}
                            </p>
                            <div
                                class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/10 text-xs text-blue-100">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Member since {{ $user->created_at->format('F Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Stripe Gradient --}}
                    <div class="h-2 bg-gradient-to-r from-primary via-tertiary to-accent"></div>
                </div>

                {{-- UPDATE PROFILE FORM --}}
                <div
                    class="bg-white shadow-lg rounded-xl border-l-4 border-primary overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- UPDATE PFP --}}
                <div
                    class="bg-white shadow-lg rounded-xl border-l-4 border-primary/50 overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-4 border-b border-gray-50 bg-background/50">
                        <h4 class="text-xs uppercase tracking-wider text-secondary font-bold flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Profile Image Settings
                        </h4>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-user-pfp-form')
                    </div>
                </div>

                {{-- UPDATE PASSWORD --}}
                <div
                    class="bg-white shadow-lg rounded-xl border-l-4 border-secondary overflow-hidden transition-all hover:shadow-xl">
                    <div class="p-4 border-b border-gray-50 bg-background/50">
                        <h4 class="text-xs uppercase tracking-wider text-secondary font-bold flex items-center gap-2">
                            <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                </path>
                            </svg>
                            Security & Credentials
                        </h4>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- DELETE ACCOUNT (DANGER ZONE) --}}
                <div
                    class="bg-white shadow-md rounded-xl border-l-4 border-red-500 overflow-hidden opacity-95 hover:opacity-100 transition-opacity">
                    <div class="p-4 border-b border-red-50 bg-red-50/30">
                        <h4 class="text-xs uppercase tracking-wider text-red-600 font-bold flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            Danger Zone
                        </h4>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </main>

</x-app-layout>
