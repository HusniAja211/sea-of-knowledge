<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sea of Knowledge') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-secondary bg-foam">

    <div class="min-h-screen flex">

        {{-- =======================
         PANEL KIRI (VISUAL BRAND)
    ======================= --}}
        <div class="hidden lg:flex w-1/2 relative items-center justify-center bg-primary overflow-hidden">

            {{-- Background Image --}}
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1558527131-f77c08f1d56d?auto=format&fit=crop&w=1974&q=80"
                    alt="SeaOfKnowledge Atmosphere"
                    class="w-full h-full object-cover opacity-50 mix-blend-overlay filter blur-sm scale-105">
            </div>

            {{-- Overlay Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-t from-secondary via-secondary/80 to-tertiary/50 z-10"></div>

            {{-- Content --}}
            <div class="relative z-20 p-12 text-center text-white max-w-xl">

                {{-- Logo --}}
                <div class="flex justify-center mb-8">
                    <div
                        class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-white border border-white/20 shadow-2xl">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                </div>

                <h1 class="font-serif text-4xl md:text-5xl font-bold mb-6 tracking-tight">
                    Selamat Datang di <br>
                    <span class="text-tertiary">{{ config('app.name') }}</span>
                </h1>

                <p class="text-lg text-white/80 leading-relaxed font-light">
                    Selami lautan pengetahuan. Temukan ribuan buku inspiratif yang akan membuka wawasan dan memperluas
                    dunia Anda.
                </p>

                {{-- Decorative Dots --}}
                <div class="mt-12 flex justify-center gap-4 opacity-60">
                    <span class="w-2 h-2 rounded-full bg-tertiary"></span>
                    <span class="w-2 h-2 rounded-full bg-white"></span>
                    <span class="w-2 h-2 rounded-full bg-accent"></span>
                </div>

            </div>
        </div>


        {{-- =======================
         PANEL KANAN (FORM)
    ======================= --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 relative bg-foam overflow-hidden">

            {{-- Decorative Blob --}}
            <div class="absolute top-0 right-0 -mt-20 -mr-20 opacity-10 text-tertiary">
                <svg width="400" height="400" viewBox="0 0 200 200">
                    <path fill="currentColor"
                        d="M45.7,-51C59.9,-36.4,72.3,-18.2,73.6,1.3C74.9,20.8,65.1,41.6,50.9,55.9C36.7,70.2,18.3,78,0.5,77.5C-17.3,77,-34.6,68.3,-48.4,54C-62.2,39.7,-72.5,19.9,-73.1,-0.6C-73.7,-21.1,-64.6,-42.2,-50.8,-56.8C-37,-71.4,-18.5,-79.5,-0.1,-79.4C18.3,-79.2,36.5,-70.8,45.7,-51Z"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <div class="absolute bottom-0 left-0 -mb-32 -ml-32 opacity-10 text-primary">
                <svg width="500" height="500" viewBox="0 0 200 200">
                    <path fill="currentColor"
                        d="M41.3,-49.8C54.8,-37.7,67.8,-24.8,71.1,-9.5C74.4,5.8,68,23.4,57.4,38.4C46.8,53.4,32.1,65.8,15.1,71.9C-1.9,78.1,-21.1,78,-36.8,70.1C-52.5,62.3,-64.6,46.6,-70.5,29.1C-76.3,11.6,-75.9,-7.7,-67.6,-23.6C-59.4,-39.6,-43.2,-52.2,-27.5,-62.9C-11.8,-73.6,4.1,-82.3,17.3,-79.1C30.5,-75.9,40.9,-60.8,41.3,-49.8Z"
                        transform="translate(100 100)" />
                </svg>
            </div>

            <div class="w-full sm:max-w-md relative z-10">

                {{-- Logo Mobile --}}
                <div class="lg:hidden text-center mb-8">
                    <a href="/" class="inline-flex items-center gap-2 group">
                        <div
                            class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>

                        <span class="font-serif font-bold text-2xl text-secondary tracking-tight">
                            {{ config('app.name') }}
                        </span>
                    </a>
                </div>

                {{-- Form Card --}}
                <div
                    class="px-8 py-10 bg-white/95 backdrop-blur-lg shadow-[0_20px_50px_rgba(0,0,0,0.1)] rounded-3xl border-t-4 border-accent ring-1 ring-gray-100">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                <div class="mt-6 text-center text-xs text-secondary/70 font-medium">
                    &copy; {{ date('Y') }} {{ config('app.name') }} Store. <br class="sm:hidden">
                    Semua hak dilindungi.
                </div>

            </div>
        </div>

    </div>

</body>

</html>
