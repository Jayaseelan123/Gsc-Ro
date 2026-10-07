<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CSRGO') }} - Admin Portal</title>
        @include('partials.favicon')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 6px; height: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="w-72 bg-slate-900 text-white flex flex-col transition-all duration-300 shadow-2xl relative z-20 h-screen overflow-y-auto">
                <div class="h-24 flex items-center justify-center border-b border-white/10 px-6 shrink-0 relative overflow-hidden">
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-teal-600 rounded-full blur-3xl opacity-30 pointer-events-none"></div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-2xl font-extrabold tracking-tight relative z-10">
                        <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-teal-600/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        CSRGO <span class="text-teal-400 font-light">Admin</span>
                    </a>
                </div>

                <div class="p-6 flex-1">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Main Navigation</p>
                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Categories
                        </a>

                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.products.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Products
                        </a>

                        <a href="{{ route('admin.enquiries.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.enquiries.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Enquiries & Leads
                        </a>

                        <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.banners.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Banners
                        </a>

                        <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.gallery.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Gallery
                        </a>

                        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-teal-600 text-white shadow-lg shadow-teal-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Website Settings
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
                
                <!-- Decorative Blur -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-teal-100/40 rounded-full blur-3xl pointer-events-none -translate-y-1/2 translate-x-1/3"></div>

                <!-- Topbar -->
                <header class="h-24 bg-white/80 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-30">
                    <div>
                        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">
                            @yield('header')
                        </h2>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-slate-100 transition-colors focus:outline-none">
                                <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 font-bold flex items-center justify-center border border-teal-200 shadow-sm">
                                    {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden md:flex flex-col items-start text-left">
                                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-500 font-medium flex items-center gap-1">Admin <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></p>
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-2" class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50" style="display: none;">
                                
                                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-teal-50 hover:text-teal-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    My Profile
                                </a>
                                
                                <div class="h-px bg-slate-100 my-1"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" data-progress="Signing out…">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors text-left">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Scrollable Main Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto p-10 relative">
                    

                    @if (session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 translate-y-2" class="mb-8 bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in-down">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-red-900">{{ session('error_title', 'Error!') }}</p>
                                <p class="text-sm font-medium">{{ session('error') }}</p>
                                @if (session('error_action'))
                                    <a href="{{ session('error_action.url') }}" class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-bold transition-colors">
                                        {{ session('error_action.label') }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                @endif
                            </div>
                            <button type="button" @click="show = false" class="self-start w-8 h-8 shrink-0 rounded-lg flex items-center justify-center text-red-400 hover:text-red-700 hover:bg-red-100 transition-colors" aria-label="Dismiss message" title="Dismiss">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    @endif

                    <!-- Yield Page Content -->
                    <div class="pb-10">
                        @yield('content')
                    </div>
                    
                </main>
            </div>
        </div>
    <!-- Save feedback: "Updating, please wait…" while a form is being saved, then the success message -->
    <div class="fixed top-28 right-6 z-[120] w-[calc(100%-3rem)] max-w-sm space-y-3 pointer-events-none" aria-live="polite">
        <div id="progress-toast" class="hidden pointer-events-auto items-center gap-3 bg-white border-2 border-teal-200 text-slate-800 px-5 py-4 rounded-2xl shadow-xl" role="status">
            <svg class="w-6 h-6 shrink-0 text-teal-600 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
            <p id="progress-toast-text" class="font-bold text-slate-900">Updating, please wait…</p>
        </div>

        @if (session('success'))
            @php
                $successMessage = (string) session('success');
                $successTitle = match (true) {
                    str_contains(strtolower($successMessage), 'nothing to update') => 'Already up to date',
                    (bool) preg_match('/\bdeleted\b/i', $successMessage) => 'Deleted successfully!',
                    (bool) preg_match('/\b(created|added)\b/i', $successMessage) => 'Added successfully!',
                    default => 'Updated successfully!',
                };
            @endphp
            <div id="success-toast" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                 class="pointer-events-auto flex items-center gap-3 bg-green-50 border-2 border-green-200 text-green-800 px-5 py-4 rounded-2xl shadow-xl" role="status">
                <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-green-900">{{ $successTitle }}</p>
                    <p class="text-sm font-medium break-words">{{ $successMessage }}</p>
                </div>
                <button type="button" @click="show = false" class="self-start w-7 h-7 shrink-0 rounded-lg flex items-center justify-center text-green-500 hover:text-green-800 hover:bg-green-100 transition-colors" aria-label="Dismiss message">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Confirm Delete Modal (replaces the browser's "localhost says" popup) -->
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="confirm-modal-title">
        <div data-confirm-cancel class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-[2rem] shadow-2xl border border-slate-100 w-full max-w-md p-8 text-center">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 id="confirm-modal-title" class="text-2xl font-extrabold text-slate-900 mb-2">Are you sure?</h3>
            <p id="confirm-modal-message" class="text-slate-500 font-medium mb-8"></p>
            <div class="flex gap-3">
                <button type="button" data-confirm-cancel class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 rounded-xl transition-all">
                    Cancel
                </button>
                <button type="button" id="confirm-modal-ok" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-red-600/30 transition-all">
                    Yes, delete it
                </button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('confirm-modal');
            const messageEl = document.getElementById('confirm-modal-message');
            const okBtn = document.getElementById('confirm-modal-ok');
            let pendingForm = null;

            function openModal(form) {
                pendingForm = form;
                messageEl.textContent = form.dataset.confirm || 'Are you sure you want to proceed?';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                okBtn.focus();
            }

            function closeModal() {
                pendingForm = null;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Any form with data-confirm="message" shows this modal before submitting
            document.addEventListener('submit', function (e) {
                const form = e.target;
                if (form.matches('form[data-confirm]') && form.dataset.confirmed !== 'true') {
                    e.preventDefault();
                    openModal(form);
                }
            });

            okBtn.addEventListener('click', function () {
                if (!pendingForm) return;
                const form = pendingForm;
                form.dataset.confirmed = 'true';
                closeModal();
                form.requestSubmit();
            });

            modal.querySelectorAll('[data-confirm-cancel]').forEach(el => el.addEventListener('click', closeModal));

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });
        })();
    </script>
    <script>
        // Shows "Updating, please wait…" as soon as a save starts and stops double submits.
        // Runs after the confirm-modal handler, so a delete only counts once it has been confirmed.
        (function () {
            const toast = document.getElementById('progress-toast');
            const text = document.getElementById('progress-toast-text');

            function label(form) {
                if (form.dataset.progress) return form.dataset.progress;
                const method = form.querySelector('input[name="_method"]');
                return method && method.value.toUpperCase() === 'DELETE' ? 'Deleting, please wait…' : 'Updating, please wait…';
            }

            document.addEventListener('submit', function (e) {
                const form = e.target;
                if (e.defaultPrevented || (form.getAttribute('method') || 'get').toLowerCase() !== 'post' || form.hasAttribute('data-no-progress')) return;
                if (form.dataset.busy === 'true') { e.preventDefault(); return; }
                form.dataset.busy = 'true';

                const success = document.getElementById('success-toast');
                if (success) success.remove();
                text.textContent = label(form);
                toast.classList.remove('hidden');
                toast.classList.add('flex');

                // Disable after the browser has collected the form data, so nothing is left out of the request.
                setTimeout(function () {
                    form.querySelectorAll('button[type="submit"], button:not([type]), input[type="submit"]').forEach(function (btn) {
                        btn.disabled = true;
                        btn.classList.add('opacity-60', 'cursor-wait');
                    });
                }, 0);
            });

            // Coming back with the browser's Back button restores the page as it was; clear the busy state.
            window.addEventListener('pageshow', function (e) {
                if (!e.persisted) return;
                toast.classList.add('hidden');
                toast.classList.remove('flex');
                document.querySelectorAll('form[data-busy="true"]').forEach(function (form) {
                    delete form.dataset.busy;
                    delete form.dataset.confirmed;
                    form.querySelectorAll('button, input[type="submit"]').forEach(function (btn) {
                        btn.disabled = false;
                        btn.classList.remove('opacity-60', 'cursor-wait');
                    });
                });
            });
        })();
    </script>
</body>
</html>
