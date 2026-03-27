<x-app-layout>
    {{-- Background Atmosphere --}}
    <main class="min-h-screen py-12">

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb / Header --}}
            <div class="mb-8 flex items-center space-x-2 text-sm">
                <a href="{{ route('admin.seller.index') }}"
                    class="text-slate-500 hover:text-primary transition">Seller</a>
                <span class="text-slate-400">/</span>
                <span class="font-bold text-secondary">Add New Seller</span>
            </div>

            <form action="{{ route('admin.seller.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- LEFT COLUMN: Information --}}
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                            <h4 class="text-secondary font-bold flex items-center gap-2 mb-3 text-lg">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Data Verification
                            </h4>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Pastikan NIK dan Informasi Bank sudah sesuai. Data ini akan digunakan untuk proses
                                verifikasi identitas dan pencairan dana seller.
                            </p>
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                                <p class="text-xs text-primary font-medium">Format NIK: 16 Digit Angka</p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN: Form --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-xl border-t-4 border-primary overflow-hidden">
                            <div class="p-8">
                                {{-- Header --}}
                                <div class="mb-8 pb-6 border-b border-slate-100 flex justify-between items-end">
                                    <div>
                                        <h2 class="text-2xl font-bold text-secondary">Seller Registration</h2>
                                        <p class="text-slate-500 text-sm mt-1">Lengkapi formulir pendaftaran mitra baru.
                                        </p>
                                    </div>
                                    <span
                                        class="hidden sm:inline-block px-3 py-1 rounded-full bg-tertiary/10 text-tertiary text-xs font-bold uppercase tracking-wide">
                                        New Partner
                                    </span>
                                </div>

                                {{-- Validation Errors --}}
                                @if ($errors->any())
                                    <div
                                        class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                                        <ul class="list-disc list-inside space-y-1 font-medium">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="space-y-8">
                                    {{-- Section I --}}
                                    <div>
                                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-5">I.
                                            Personal Identity</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="group">
                                                <label for="name"
                                                    class="block text-sm font-semibold text-secondary mb-2">Full
                                                    Name</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name') }}" required
                                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                                    placeholder="Contoh: John Doe">
                                            </div>
                                            <div class="group">
                                                <label for="nik"
                                                    class="block text-sm font-semibold text-secondary mb-2">NIK
                                                    Number</label>
                                                <input type="text" name="nik" id="nik"
                                                    value="{{ old('nik') }}" maxlength="16" required
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-mono text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                                    placeholder="16 Digit NIK">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Section II --}}
                                    <div>
                                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-5">
                                            II. Account Access</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="group">
                                                <label for="email"
                                                    class="block text-sm font-semibold text-secondary mb-2">Email
                                                    Address</label>
                                                <input type="email" name="email" id="email"
                                                    value="{{ old('email') }}" required
                                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                            </div>
                                            <div class="group">
                                                <label for="password"
                                                    class="block text-sm font-semibold text-secondary mb-2">Secure
                                                    Password</label>
                                                <input type="password" name="password" id="password" required
                                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                            </div>
                                        </div>
                                        <div class="mt-6 group">
                                            <label for="address"
                                                class="block text-sm font-semibold text-secondary mb-2">Residential
                                                Address</label>
                                            <textarea name="address" id="address" rows="3" required
                                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-secondary focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary resize-none transition-all outline-none">{{ old('address') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Section III --}}
                                    <div class="pt-6 border-t border-slate-100" x-data="{ fileName: '' }">
                                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-5">
                                            IV. Profile Persona</h3>
                                        <div
                                            class="flex justify-center rounded-2xl border-2 border-dashed border-slate-200 px-6 py-8 hover:bg-slate-50 hover:border-primary/50 transition-all relative">
                                            <div class="text-center">
                                                {{-- Preview pfp --}}
                                                <img id="image-preview" src="/defaultpng.png"
                                                    class="w-24 h-24 rounded-full object-cover">
                                                <div class="mt-4 flex text-sm text-slate-600 justify-center">
                                                    <label for="pfp"
                                                        class="relative cursor-pointer rounded-md font-bold text-primary hover:text-secondary">
                                                        <span>Upload Photo Profile</span>
                                                        <input id="pfp" name="pfp" type="file"
                                                            class="sr-only" accept="image/*"
                                                            @change="fileName = $event.target.files[0].name">
                                                        <input type="hidden" name="crop_data" id="crop_data">
                                                    </label>
                                                </div>
                                                <p x-show="fileName" x-text="fileName"
                                                    class="text-xs font-bold text-primary mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Action Bar --}}
                                <div class="mt-12 pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.seller.index') }}"
                                        class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-secondary transition-colors uppercase tracking-widest">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-12 py-4 bg-primary text-white font-black rounded-xl shadow-lg shadow-primary/30 hover:bg-secondary hover:shadow-secondary/20 transform active:scale-95 transition-all duration-300 flex items-center gap-3 uppercase tracking-widest text-sm">
                                        Register Mitra
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
