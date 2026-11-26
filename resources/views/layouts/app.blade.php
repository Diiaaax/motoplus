<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<script>if(localStorage.getItem('theme')==='dark'||(!localStorage.getItem('theme')&&matchMedia('(prefers-color-scheme:dark)').matches))document.documentElement.classList.add('dark')</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }} - {{ __('Premium Electric Motorcycles Algeria') }}</title>
    @endif

    <meta name="description" content="@yield('meta_description', 'MotoPlus - Premium electric motorcycles and scooters in Algeria. Discover the future of urban mobility with our range of eco-friendly electric vehicles.')">

    @yield('meta_tags')
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if(app()->getLocale() === 'ar')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=Play:wght@400;700&display=swap" rel="stylesheet">
    @else
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Hreflang tags --}}
    <link rel="alternate" hreflang="en" href="{{ url('en') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('fr') }}">
    <link rel="alternate" hreflang="ar" href="{{ url('ar') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @if(app()->getLocale() === 'ar')
    <style>
        body { font-family: 'Tajawal', 'Inter', sans-serif; }
        .font-display { font-family: 'Tajawal', 'Play', sans-serif; }
        .nav-link { font-family: 'Tajawal', sans-serif; }
        .hero-title, .sub-title, .sec-title, .widget-title { font-family: 'Tajawal', 'Play', sans-serif; }
    </style>
    @endif

    <style>[x-cloak]{display:none!important}</style>

    @stack('styles')

    @yield('schema')
</head>
<body class="antialiased">
    <x-home.header />

    <main class="min-h-screen">
        @yield('content')
    </main>

    <x-home.footer />

    @livewireScripts

    @stack('scripts')
</body>
</html>
