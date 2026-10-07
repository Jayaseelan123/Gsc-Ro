<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Email Address</label>
            <input id="email" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium @error('email') border-red-500 ring-4 ring-red-100 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@csrgo.com" />
            @error('email') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Password</label>
            <input id="password" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium @error('password') border-red-500 ring-4 ring-red-100 @enderror" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            @error('password') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                <span class="ms-2 text-sm text-slate-600 group-hover:text-teal-600 transition-colors font-medium">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-lg rounded-2xl transition-all duration-300 shadow-xl hover:shadow-teal-600/40 flex items-center justify-center gap-2 hover:-translate-y-1">
                Secure Login
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</x-guest-layout>
