<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            // Website name from Admin > Settings (same as the public site).
            $siteName = $settings['website_name'] ?? \App\Models\WebsiteSetting::where('key', 'website_name')->value('value') ?: 'GSC-RO Aqua Water Treatment';
        @endphp
        <title>Admin Login - {{ $siteName }}</title>
        @include('partials.favicon')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden">
        
        <!-- Background Effects -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-600 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-indigo-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="w-full max-w-md px-8 py-10 bg-white shadow-2xl border border-slate-100 rounded-[2.5rem] relative z-10">
            <div class="flex justify-center mb-8">
                <a href="/" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="GSC-RO" class="h-20 w-auto">
                    @if(file_exists(public_path('images/text-logo.png')))
                        <img src="{{ asset('images/text-logo.png') }}" alt="GSC-RO AQUA WATER TREATMENT" class="h-10 w-auto mt-2">
                    @endif
                </a>
            </div>
            
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-slate-800">Secure Admin Portal</h2>
                <p class="text-slate-500 text-sm mt-2">Enter your credentials to access the dashboard</p>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
