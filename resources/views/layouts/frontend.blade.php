<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['website_name'] ?? 'GSC-RO Aqua Water Treatment' }} - @yield('title', 'Welcome')</title>
    @include('partials.favicon')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .group-hover\:flex {
            display: none;
        }

        .group:hover .group-hover\:flex {
            display: flex;
        }

        .mobile-menu-open {
            display: block !important;
        }

        /* Scroll Animations */
        .reveal-fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .reveal-fade-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <!-- AlpineJS for mobile menu & simple interactivity -->
    <!-- Alpine is already included via resources/js/app.js -->
</head>

<body class="bg-page text-slate-800 antialiased flex flex-col min-h-screen overflow-x-hidden">

    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false }"
        class="bg-white/90 backdrop-blur-md shadow-sm border-b border-slate-200 sticky top-0 z-50 transition-all duration-300">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center gap-4 h-16 lg:h-20 2xl:h-24 min-[1800px]:h-28">
                <!-- Logo (Left Side) -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-3 xl:gap-5 transition-opacity hover:opacity-90">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ $settings['website_name'] ?? 'GSC-RO' }}"
                            class="h-12 xl:h-16 2xl:h-20 min-[1800px]:h-24 w-auto">
                        {{-- Text logo: the logo uploaded in admin Settings, or the bundled one. Hidden on small laptops
                        (lg) so the menu fits on one line. --}}
                        <img src="{{ !empty($settings['logo']) ? asset('storage/' . $settings['logo']) : asset('images/text-logo.png') }}"
                            alt="GSC-RO AQUA WATER TREATMENT"
                            class="h-8 sm:h-9 xl:h-10 2xl:h-12 min-[1800px]:h-16 w-auto hidden sm:block lg:hidden xl:block">
                    </a>
                </div>

                @php
                    // Which menu item matches the current page (used to highlight it).
                    $navActive = [
                        'home' => request()->routeIs('home'),
                        'about' => request()->routeIs('about'),
                        'products' => request()->routeIs('products', 'products.*', 'product.*'),
                        'gallery' => request()->routeIs('gallery'),
                        'requirement' => request()->routeIs('requirement', 'requirement.*'),
                        'contact' => request()->routeIs('contact', 'contact.*'),
                    ];
                    $navLink = fn($key) => 'border-b-2 pb-1 font-semibold transition-colors duration-200 ' . ($navActive[$key] ? 'text-brand-600 border-brand-600' : 'text-slate-700 border-transparent hover:text-brand-600');
                    $mobileLink = fn($key) => 'font-medium py-2 ' . ($navActive[$key] ? 'text-brand-600 font-semibold' : 'text-slate-700 hover:text-brand-600');
                    $routeCategory = request()->route('category');
                    $currentCategory = $routeCategory instanceof \App\Models\Category ? $routeCategory->slug : $routeCategory;
                @endphp

                <!-- Desktop Navigation -->
                <nav
                    class="hidden lg:flex items-center justify-center gap-4 xl:gap-5 2xl:gap-6 flex-1 text-sm xl:text-[15px] 2xl:text-base min-[1800px]:text-lg">
                    <a href="{{ route('home') }}" class="{{ $navLink('home') }}" @if($navActive['home'])
                    aria-current="page" @endif>Home</a>
                    <a href="{{ route('about') }}" class="{{ $navLink('about') }}" @if($navActive['about'])
                    aria-current="page" @endif>About Us</a>

                    <!-- Dropdown -->
                    <div class="relative group py-6">
                        <span class="{{ $navLink('products') }} flex items-center gap-1 cursor-default"
                            @if(request()->routeIs('products.category')) aria-current="page" @endif>
                            Products
                            <svg class="w-4 h-4 {{ $navActive['products'] ? 'text-brand-600' : 'text-slate-500' }} group-hover:text-brand-600 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                        <div
                            class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-50 flex flex-col py-2">
                            @foreach($categories_menu as $cat)
                                <a href="{{ route('products.category', $cat->slug) }}"
                                    class="px-5 py-2.5 text-sm transition-colors {{ $currentCategory === $cat->slug ? 'bg-brand-50 text-brand-700 font-semibold' : 'font-medium text-slate-600 hover:bg-brand-50 hover:text-brand-700' }}"
                                    @if($currentCategory === $cat->slug) aria-current="page" @endif>{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('gallery') }}" class="{{ $navLink('gallery') }}" @if($navActive['gallery'])
                    aria-current="page" @endif>Gallery</a>
                    <a href="{{ route('requirement') }}" class="{{ $navLink('requirement') }}"
                        @if($navActive['requirement']) aria-current="page" @endif>Requirement</a>
                    <a href="{{ route('contact') }}" class="{{ $navLink('contact') }}" @if($navActive['contact'])
                    aria-current="page" @endif>Contact</a>
                </nav>

                <!-- Certifications & Mobile Toggle -->
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="flex items-center gap-2 sm:gap-3 2xl:gap-4">
                        @if(file_exists(public_path('images/gem.png')))
                            <img src="{{ asset('images/gem.png') }}" alt="GeM"
                                class="h-5 sm:h-6 md:h-7 xl:h-7 2xl:h-8 min-[1800px]:h-9 w-auto object-contain">
                        @endif
                        @if(file_exists(public_path('images/udyam.png')))
                            <img src="{{ asset('images/udyam.png') }}" alt="Udyam"
                                class="h-6 sm:h-7 md:h-8 xl:h-8 2xl:h-9 min-[1800px]:h-10 w-auto object-contain">
                        @endif
                        @if(file_exists(public_path('images/msme.png')))
                            <img src="{{ asset('images/msme.png') }}" alt="MSME"
                                class="h-6 sm:h-7 md:h-8 xl:h-8 2xl:h-9 min-[1800px]:h-10 w-auto object-contain">
                        @endif
                    </div>
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden text-slate-600 hover:text-brand-600 transition-colors focus:outline-none p-1 sm:p-2 ml-1">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" x-transition
            class="lg:hidden bg-white border-t border-slate-100 absolute w-full shadow-lg" style="display: none;">
            <div class="px-4 py-6 flex flex-col gap-4">
                <a href="{{ route('home') }}" class="{{ $mobileLink('home') }}" @if($navActive['home'])
                aria-current="page" @endif>Home</a>
                <a href="{{ route('about') }}" class="{{ $mobileLink('about') }}" @if($navActive['about'])
                aria-current="page" @endif>About Us</a>

                <!-- Products, with its categories (same as the desktop dropdown) -->
                <div x-data="{ productsOpen: @js(request()->routeIs('products.category')) }">
                    <div class="flex items-center justify-between gap-2">
                        <span class="{{ $mobileLink('products') }} cursor-default"
                            @if(request()->routeIs('products.category')) aria-current="page" @endif>Products</span>
                        @if($categories_menu->isNotEmpty())
                            <button type="button" @click="productsOpen = !productsOpen"
                                class="p-2 text-slate-400 hover:text-brand-600 transition-colors focus:outline-none"
                                :aria-expanded="productsOpen.toString()" aria-label="Show product categories">
                                <svg class="w-5 h-5 transition-transform duration-200"
                                    :class="productsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                    @if($categories_menu->isNotEmpty())
                        <div x-show="productsOpen" x-transition
                            class="pl-4 border-l-2 border-slate-100 flex flex-col gap-2 mt-2 mb-1" style="display: none;">
                            @foreach($categories_menu as $cat)
                                <a href="{{ route('products.category', $cat->slug) }}"
                                    class="text-sm {{ $currentCategory === $cat->slug ? 'text-brand-600 font-semibold' : 'text-slate-600 hover:text-brand-600' }}"
                                    @if($currentCategory === $cat->slug) aria-current="page" @endif>{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <a href="{{ route('gallery') }}" class="{{ $mobileLink('gallery') }}" @if($navActive['gallery'])
                aria-current="page" @endif>Gallery</a>
                <a href="{{ route('requirement') }}" class="{{ $mobileLink('requirement') }}"
                    @if($navActive['requirement']) aria-current="page" @endif>Requirement</a>
                <a href="{{ route('contact') }}" class="{{ $mobileLink('contact') }}" @if($navActive['contact'])
                aria-current="page" @endif>Contact</a>
                <a href="{{ route('contact') }}"
                    class="bg-brand-600 text-white text-center px-6 py-3 rounded-xl font-medium mt-4 shadow-sm">Enquire
                    Now</a>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#006064] text-brand-50 pt-16 pb-8 border-t-4 border-brand-500 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Brand Column -->
            <div class="min-w-0">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-2 text-2xl font-extrabold text-white mb-6 hover:opacity-90 transition-opacity">
                    @if(isset($settings['logo']) && $settings['logo'])
                        <img src="{{ asset('storage/' . $settings['logo']) }}"
                            alt="{{ $settings['website_name'] ?? 'CSRGO' }}" class="h-14 w-auto bg-white p-2 rounded-xl">
                    @else
                        <img src="{{ asset('images/text-logo.png') }}" alt="{{ $settings['website_name'] ?? 'CSRGO' }}"
                            class="h-14 w-auto bg-white p-2 rounded-xl">
                    @endif
                </a>
                <p class="text-sm text-brand-50 leading-relaxed pr-4 mb-6">
                    {{ $settings['company_description'] ?? 'Delivering excellence through premium products and exceptional service globally.' }}
                </p>
                @php
                    // WhatsApp: the WhatsApp number from Website Settings, otherwise the last phone number.
                    $phoneList = explode(',', $settings['phone'] ?? '');
                    $lastPhone = trim(end($phoneList));
                    $footerWhatsapp = preg_replace('/[^0-9]/', '', ($settings['whatsapp'] ?? '') ?: $lastPhone);
                    $socialIcon = 'w-10 h-10 shrink-0 rounded-full bg-white/10 text-white flex items-center justify-center hover:bg-brand-500 hover:text-white transition-colors';
                @endphp
                <div class="flex flex-wrap items-center gap-3">
                    @if(filled($settings['facebook'] ?? null))
                        <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener"
                            class="{{ $socialIcon }}" aria-label="Facebook" title="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    @endif
                    @if(filled($settings['instagram'] ?? null))
                        <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener"
                            class="{{ $socialIcon }}" aria-label="Instagram" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                            </svg>
                        </a>
                    @endif
                    @if(filled($settings['linkedin'] ?? null))
                        <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener"
                            class="{{ $socialIcon }}" aria-label="LinkedIn" title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    @endif
                    @if($footerWhatsapp)
                        <a href="https://wa.me/{{ $footerWhatsapp }}" target="_blank" rel="noopener"
                            class="{{ $socialIcon }}" aria-label="WhatsApp" title="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Links Column -->
            <div class="min-w-0">
                <h4 class="text-white font-bold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}"
                            class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg> Home</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg> About Us</a></li>

                    <li><a href="{{ route('gallery') }}"
                            class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg> Gallery</a></li>
                    <li><a href="{{ route('requirement') }}"
                            class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg> Submit Requirement</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg> Contact Us</a></li>
                </ul>
            </div>

            <!-- Products Column -->
            <div class="min-w-0">
                <h4 class="text-white font-bold text-lg mb-6">Products</h4>
                <ul class="space-y-3">
                    @foreach($categories_menu->take(5) as $cat)
                        <li><a href="{{ route('products.category', $cat->slug) }}"
                                class="text-brand-50 hover:text-white transition-colors flex items-center gap-2"><svg
                                    class="w-3.5 h-3.5 text-brand-200 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7"></path>
                                </svg> {{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="min-w-0">
                <h4 class="text-white font-bold text-lg mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-brand-50">
                        <svg class="w-5 h-5 text-brand-200 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <address class="min-w-0 break-words not-italic">

                            Back KAKC Petrol Bunk,<br>
                            No 3D, 3rd Cross, Power House Colony,<br>
                            Krishnagiri
                        </address>
                    </li>
                    <li class="flex items-start gap-3 text-brand-50">
                        <svg class="w-5 h-5 text-brand-200 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <div class="flex flex-col gap-1 min-w-0">
                            <a href="tel:+919486667373" class="w-fit hover:text-white transition-colors">+91 94866
                                67373</a>
                            <a href="tel:+917904332288" class="w-fit hover:text-white transition-colors">+91 79043
                                32288</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-3 text-brand-50">
                        <svg class="w-5 h-5 text-brand-200 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <a href="mailto:gscro999@gmail.com"
                            class="min-w-0 break-all hover:text-white transition-colors">gscro999@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-white/20 grid grid-cols-1 md:grid-cols-3 items-center gap-4 text-sm text-brand-100">
            <p class="min-w-0 text-center md:text-left">&copy; {{ date('Y') }} GSC-RO Aqua. All rights reserved.</p>
            <div class="flex flex-nowrap items-center justify-center gap-4 whitespace-nowrap">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <span class="w-px h-4 bg-brand-100/50" aria-hidden="true"></span>
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
            <div class="min-w-0 flex items-center justify-center md:justify-end gap-3 text-brand-100 text-[0.9rem]">
                <span>Powered by</span>
                <a href="https://aspirentech.com" target="_blank" rel="noopener">
                    <img src="https://aspirentech.com/assets/aspirentech-logo-new-B7I5o4Z6.png" alt="Aspirentech"
                        class="h-[22px] w-auto brightness-0 invert opacity-80 hover:opacity-100 transition-opacity duration-300">
                </a>
            </div>
        </div>
    </footer>

    <!-- Sticky Social Sidebar -->
    @php
        // Google Reviews: the link saved in Admin > Settings, otherwise the specific Google search listing.
        $googleReviewsUrl = !empty($settings['google_reviews'])
            ? $settings['google_reviews']
            : 'https://www.google.com/search?sca_esv=eb50063a5605cecb&hl=en&authuser=0&sxsrf=AE3TifNwfvRGvS31HZ-fljwXJmIJA3qBKg:1753078427615&kgmid=/g/11fpgtvwqb&q=GSC-+RO+Aqua+Water+Treatment&shndl=30&shem=lcuae,uaasie&source=sh/x/loc/uni/m1/1&kgs=865ff3e9039b42cb';
    @endphp
    <div x-data="{ open: true }" class="fixed right-0 top-1/2 -translate-y-1/2 z-[100] flex items-center">

        <!-- Toggle tab -->
        <button type="button" @click="open = !open"
            class="w-5 h-12 md:w-6 md:h-14 bg-white text-slate-500 hover:text-slate-800 border border-r-0 border-slate-200 rounded-l-lg shadow-md flex items-center justify-center transition-colors"
            :aria-expanded="open.toString()" aria-label="Toggle social menu">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 transition-transform duration-300" :class="open ? '' : 'rotate-180'"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Icons -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="bg-white border border-r-0 border-slate-200 rounded-l-2xl shadow-lg p-1.5 md:p-2 flex flex-col gap-1.5 md:gap-2">

            @if(!empty($settings['phone']))
                @php
                    $callPhones = explode(',', $settings['phone']);
                    $callPhone = trim(end($callPhones));
                @endphp
                <a href="tel:{{ $callPhone }}"
                    class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-emerald-500 focus-visible:ring-emerald-400"
                    title="Call Us" aria-label="Call Us">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
                    </svg>
                    <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Call</span>
                </a>
            @endif

            @if(!empty($settings['whatsapp']))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-[#25D366] focus-visible:ring-[#25D366]"
                    title="WhatsApp" aria-label="WhatsApp">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">WhatsApp</span>
                </a>
            @endif

            @if(!empty($settings['instagram']))
                <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer"
                    class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-pink-400"
                    style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);"
                    title="Instagram" aria-label="Instagram">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                    </svg>
                    <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Instagram</span>
                </a>
            @endif

            @if(!empty($settings['facebook']))
                <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer"
                    class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-[#1877F2] focus-visible:ring-[#1877F2]"
                    title="Facebook" aria-label="Facebook">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Facebook</span>
                </a>
            @endif

            <a href="{{ $googleReviewsUrl }}" target="_blank" rel="noopener noreferrer"
                class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center bg-white border border-slate-200 text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#4285F4]"
                title="Google Reviews" aria-label="Google Reviews">
                <svg class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#4285F4"
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                    <path fill="#34A853"
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                    <path fill="#FBBC05"
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                    <path fill="#EA4335"
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                </svg>
                <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Reviews</span>
            </a>

            @if(!empty($settings['truecaller']))
                @php
                    // Truecaller's profile page for an Indian mobile number: digits only, without +91 or a leading 0.
                    $truecallerNumber = preg_replace('/^(91(?=\d{10}$)|0)/', '', preg_replace('/\D/', '', $settings['truecaller']));
                @endphp
                <a href="https://www.truecaller.com/search/in/{{ $truecallerNumber }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-[#0087FF] focus-visible:ring-[#0087FF]"
                    title="Truecaller" aria-label="Truecaller">
                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
                        <path
                            d="M15 3.5a1 1 0 011-1h.5A4.5 4.5 0 0121 7v.5a1 1 0 11-2 0V7a2.5 2.5 0 00-2.5-2.5H16a1 1 0 01-1-1z" />
                    </svg>
                    <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Truecaller</span>
                </a>
            @endif
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

        document.querySelectorAll('.reveal-fade-up').forEach((el) => {
            observer.observe(el);
        });
    });
</script>

</html>