<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-scaleIn {
            animation: scaleIn 0.2s ease-out;
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-background relative overflow-hidden">

        {{-- 🌊 Ocean Pattern Background --}}
        {{-- <div class="absolute inset-0 z-0 pointer-events-none"
            style="
        background-image: url('{{ asset('images/bg.jpg') }}');
        background-size: cover;
        background-position: top center;
        background-repeat: no-repeat;
        opacity: 100;"> --}}

        {{-- 🔝 Content --}}
        <div class="relative z-10">
            @switch(auth()->user()->role->name)
                @case('admin')
                    @include('layouts.admin-navigation')
                @break

                @case('seller')
                    @include('layouts.seller-navigation')
                @break

                @case('buyer')
                    @include('layouts.buyer-navigation')
                @break

                @default
                    @include('layouts.navigation')
            @endswitch

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
            <x-sweetalert />

        </div>
    </div>
    <x-cropper />
</body>

</html>
