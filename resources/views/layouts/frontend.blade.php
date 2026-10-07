<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['website_name'] ?? 'CSRGO' }} - @yield('title', 'Welcome')</title>
    @include('partials.favicon')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .group-hover\:flex { display: none; }
        .group:hover .group-hover\:flex { display: flex; }
        .mobile-menu-open { display: block !important; }
        
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
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white/90 backdrop-blur-md shadow-sm border-b border-slate-200 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 text-2xl font-extrabold text-teal-700 tracking-tight hover:opacity-90 transition-opacity">
                    @if(isset($settings['logo']) && $settings['logo'])
                        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['website_name'] ?? 'CSRGO' }}" class="h-10 w-auto">
                    @else
                        <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        {{ $settings['website_name'] ?? 'CSRGO' }}
                    @endif
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8 ml-auto mr-6 xl:mr-8">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200">Home</a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200">About</a>

                    
                    <!-- Dropdown -->
                    <div class="relative group py-8">
                        <a href="{{ route('products') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200 flex items-center gap-1 cursor-pointer">
                            Products 
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-teal-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 z-50 flex flex-col py-2">
                            @foreach($categories_menu as $cat)
                                <a href="{{ route('products.category', $cat->slug) }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-teal-50 hover:text-teal-700 transition-colors">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('gallery') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200">Gallery</a>
                    <a href="{{ route('requirement') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200">Requirement</a>
                    <a href="{{ route('contact') }}" class="text-slate-600 hover:text-teal-600 font-medium transition-colors duration-200">Contact</a>
                </nav>

                <!-- CTA & Mobile Toggle -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('contact') }}" class="hidden lg:inline-flex items-center justify-center bg-teal-600 text-white px-6 py-2.5 rounded-full font-medium shadow-sm hover:bg-teal-700 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">Enquire Now</a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-600 hover:text-teal-600 transition-colors focus:outline-none p-2">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" x-transition class="lg:hidden bg-white border-t border-slate-100 absolute w-full shadow-lg" style="display: none;">
            <div class="px-4 py-6 flex flex-col gap-4">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-teal-600 font-medium py-2">Home</a>
                <a href="{{ route('about') }}" class="text-slate-700 hover:text-teal-600 font-medium py-2">About</a>

                <div class="pl-4 border-l-2 border-slate-100 flex flex-col gap-2 my-1">
                    @foreach($categories_menu as $cat)
                        <a href="{{ route('products.category', $cat->slug) }}" class="text-sm text-slate-600 hover:text-teal-600">{{ $cat->name }}</a>
                    @endforeach
                </div>
                <a href="{{ route('gallery') }}" class="text-slate-700 hover:text-teal-600 font-medium py-2">Gallery</a>
                <a href="{{ route('requirement') }}" class="text-slate-700 hover:text-teal-600 font-medium py-2">Requirement</a>
                <a href="{{ route('contact') }}" class="text-slate-700 hover:text-teal-600 font-medium py-2">Contact</a>
                <a href="{{ route('contact') }}" class="bg-teal-600 text-white text-center px-6 py-3 rounded-xl font-medium mt-4 shadow-sm">Enquire Now</a>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Brand Column -->
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-extrabold text-white mb-6 hover:opacity-90 transition-opacity">
                    @if(isset($settings['logo']) && $settings['logo'])
                        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['website_name'] ?? 'CSRGO' }}" class="h-12 w-auto rounded-lg">
                    @else
                        <svg class="w-8 h-8 text-teal-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        {{ $settings['website_name'] ?? 'CSRGO' }}
                    @endif
                </a>
                <p class="text-sm text-slate-400 leading-relaxed pr-4 mb-6">{{ $settings['company_description'] ?? 'Delivering excellence through premium products and exceptional service globally.' }}</p>
                <div class="flex space-x-3">
                    @if(isset($settings['facebook'])) <a href="{{ $settings['facebook'] }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-teal-600 hover:text-white transition-colors"><span class="sr-only">Facebook</span>f</a> @endif
                    @if(isset($settings['instagram'])) <a href="{{ $settings['instagram'] }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-colors"><span class="sr-only">Instagram</span>i</a> @endif
                    @if(isset($settings['linkedin'])) <a href="{{ $settings['linkedin'] }}" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-teal-500 hover:text-white transition-colors"><span class="sr-only">LinkedIn</span>in</a> @endif
                </div>
            </div>
            
            <!-- Links Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> About Us</a></li>
                    <li><a href="{{ route('products') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> Our Products</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> Gallery</a></li>
                    <li><a href="{{ route('requirement') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> Submit Requirement</a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> Contact Us</a></li>
                </ul>
            </div>
            
            <!-- Products Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Products</h4>
                <ul class="space-y-3">
                    @foreach($categories_menu->take(4) as $cat)
                        <li><a href="{{ route('products.category', $cat->slug) }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> {{ $cat->name }}</a></li>
                    @endforeach
                    <li><a href="{{ route('products') }}" class="text-slate-400 hover:text-teal-400 transition-colors flex items-center gap-2"><span class="text-teal-500">&bull;</span> View All Products</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-slate-400">
                        <svg class="w-5 h-5 text-teal-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $settings['address'] ?? '123 Main St, Business Hub' }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-400">
                        <svg class="w-5 h-5 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>{{ $settings['phone'] ?? '+123 456 7890' }}</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-400">
                        <svg class="w-5 h-5 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>{{ $settings['email'] ?? 'info@csrgo.com' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-slate-800/50 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} {{ $settings['company_name'] ?? 'CSRGO Corporate' }}. All rights reserved.</p>
            <div class="flex gap-4">
                <a href="{{ route('privacy') }}" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-slate-300 transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Sticky Social Sidebar -->
    @if(!empty($settings['phone']) || !empty($settings['whatsapp']) || !empty($settings['instagram']) || !empty($settings['facebook']))
    <div x-data="{ open: true }" class="fixed right-0 top-1/2 -translate-y-1/2 z-[100] flex items-center">

        <!-- Toggle tab -->
        <button type="button" @click="open = !open" class="w-5 h-12 md:w-6 md:h-14 bg-white text-slate-500 hover:text-slate-800 border border-r-0 border-slate-200 rounded-l-lg shadow-md flex items-center justify-center transition-colors" :aria-expanded="open.toString()" aria-label="Toggle social menu">
            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 transition-transform duration-300" :class="open ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Icons -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" class="bg-white border border-r-0 border-slate-200 rounded-l-2xl shadow-lg p-1.5 md:p-2 flex flex-col gap-1.5 md:gap-2">

            @if(!empty($settings['phone']))
            <a href="tel:{{ $settings['phone'] }}" class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-emerald-500 focus-visible:ring-emerald-400" title="Call Us" aria-label="Call Us">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>
                <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Call</span>
            </a>
            @endif

            @if(!empty($settings['whatsapp']))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-[#25D366] focus-visible:ring-[#25D366]" title="WhatsApp" aria-label="WhatsApp">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">WhatsApp</span>
            </a>
            @endif

            @if(!empty($settings['instagram']))
            <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-pink-400" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);" title="Instagram" aria-label="Instagram">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Instagram</span>
            </a>
            @endif

            @if(!empty($settings['facebook']))
            <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex flex-col items-center justify-center text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 bg-[#1877F2] focus-visible:ring-[#1877F2]" title="Facebook" aria-label="Facebook">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                <span class="mt-1 text-[7px] md:text-[8px] font-bold leading-none tracking-wide">Facebook</span>
            </a>
            @endif
        </div>
    </div>
    @endif
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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