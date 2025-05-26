<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="boa-corporate">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM Investisseurs') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
<!-- Background Pattern -->
<div class="fixed inset-0 opacity-5">
    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23000000" fill-opacity="0.05"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
</div>

<!-- Main Container -->
<div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Login Card -->
        <div class="bg-white/80 backdrop-blur-xl shadow-2xl rounded-2xl border border-white/20 overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 px-8 py-12 text-center relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-0 w-full h-full">
                    <div class="absolute top-4 right-4 w-20 h-20 border border-white/20 rounded-full"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 border border-white/20 rounded-full"></div>
                    <div class="absolute top-8 left-8 w-2 h-2 bg-white/30 rounded-full"></div>
                    <div class="absolute bottom-8 right-8 w-3 h-3 bg-white/30 rounded-full"></div>
                </div>

                <!-- Logo Section -->
                <div class="relative z-10 mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 mb-4">
                        <!-- Remplacez cette icône par le logo BOA -->
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Bank of Africa</h1>
                    <p class="text-blue-100 text-sm font-medium mt-1">CRM Investisseurs</p>
                </div>

                <div class="text-white/90 text-sm">
                    Plateforme de gestion des relations investisseurs
                </div>
            </div>

            <!-- Form Section -->
            <div class="px-8 py-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-sm text-slate-600">
                © {{ date('Y') }} Bank of Africa. Tous droits réservés.
            </p>
            <p class="text-xs text-slate-500 mt-1">
                Version sécurisée - Accès réservé aux utilisateurs autorisés
            </p>
        </div>
    </div>
</div>
</body>
</html>
