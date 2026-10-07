@extends('layouts.admin')
@section('header', 'My Profile')
@section('content')
@php
    $input = 'w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium';
    $label = 'block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider';
    $card = 'bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8';
@endphp

<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Profile</h2>
        <p class="text-slate-500 font-medium mt-1">Manage your admin account details and password.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-start">
        <!-- Account overview -->
        <div class="{{ $card }} text-center lg:sticky lg:top-28">
            <div class="w-20 h-20 mx-auto rounded-3xl bg-teal-100 text-teal-700 font-extrabold text-3xl flex items-center justify-center border-4 border-white shadow">
                {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
            <h3 class="mt-4 text-xl font-extrabold text-slate-900 break-words">{{ $user->name }}</h3>
            <p class="text-sm font-medium text-slate-500 break-all">{{ $user->email }}</p>
            <span class="inline-block mt-3 px-3 py-1 rounded-lg bg-teal-50 text-teal-700 text-xs font-bold uppercase tracking-wider">Administrator</span>

            <dl class="mt-6 pt-6 border-t border-slate-100 space-y-3 text-left text-sm">
                <div class="flex justify-between gap-3">
                    <dt class="text-slate-500 font-medium">Member since</dt>
                    <dd class="font-bold text-slate-800">{{ $user->created_at?->copy()->timezone(config('app.display_timezone'))->format('d M Y') ?? '—' }}</dd>
                </div>
                <div class="flex justify-between gap-3">
                    <dt class="text-slate-500 font-medium">Last updated</dt>
                    <dd class="font-bold text-slate-800">{{ $user->updated_at?->diffForHumans() ?? '—' }}</dd>
                </div>
            </dl>

            <form method="POST" action="{{ route('logout') }}" class="mt-6" data-progress="Signing out…">
                @csrf
                <button type="submit" class="w-full py-3 rounded-xl border-2 border-slate-200 hover:border-red-200 hover:bg-red-50 text-slate-700 hover:text-red-600 font-bold transition-colors">Log Out</button>
            </form>
        </div>

        <div class="lg:col-span-2 space-y-6 lg:space-y-8">
            <!-- Profile information -->
            <div class="{{ $card }}">
                <h3 class="text-lg font-extrabold text-slate-900">Profile Information</h3>
                <p class="text-sm text-slate-500 mt-1 mb-6">Your name is shown in the admin panel. Your email is used to log in.</p>

                <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="name" class="{{ $label }}">Name <span class="text-red-500">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name" class="{{ $input }} @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="{{ $label }}">Email Address <span class="text-red-500">*</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="username" class="{{ $input }} @error('email') border-red-500 @enderror">
                        <p class="text-xs font-medium text-slate-500 mt-2">If you change this, use the new email the next time you log in.</p>
                        @error('email') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-colors">Save Details</button>
                    </div>
                </form>
            </div>

            <!-- Change password -->
            <div class="{{ $card }}">
                <h3 class="text-lg font-extrabold text-slate-900">Change Password</h3>
                <p class="text-sm text-slate-500 mt-1 mb-6">Use at least 8 characters. A mix of letters, numbers and symbols is safest.</p>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    @foreach([
                        ['current_password', 'Current Password', 'current-password'],
                        ['password', 'New Password', 'new-password'],
                        ['password_confirmation', 'Confirm New Password', 'new-password'],
                    ] as [$field, $text, $auto])
                        <div>
                            <label for="{{ $field }}" class="{{ $label }}">{{ $text }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input id="{{ $field }}" name="{{ $field }}" type="password" required autocomplete="{{ $auto }}" @if($field !== 'current_password') minlength="8" @endif class="{{ $input }} pr-20 @if($errors->updatePassword->has($field)) border-red-500 @endif">
                                <button type="button" data-toggle="{{ $field }}" class="pw-toggle absolute inset-y-0 right-0 px-4 text-xs font-bold text-slate-500 hover:text-teal-600" aria-label="Show {{ strtolower($text) }}">Show</button>
                            </div>
                            @if($errors->updatePassword->has($field))
                                <p class="text-red-500 text-xs font-bold mt-2">{{ $errors->updatePassword->first($field) }}</p>
                            @endif
                        </div>
                    @endforeach
                    <p id="pw-match" class="hidden text-xs font-bold"></p>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-colors">Change Password</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.pw-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = document.getElementById(btn.dataset.toggle);
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.textContent = show ? 'Hide' : 'Show';
        });
    });

    (function () {
        const pw = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const note = document.getElementById('pw-match');
        function check() {
            if (!confirm.value) { note.classList.add('hidden'); return; }
            const ok = pw.value === confirm.value;
            note.textContent = ok ? 'Passwords match.' : 'Passwords do not match yet.';
            note.className = 'text-xs font-bold ' + (ok ? 'text-green-600' : 'text-amber-600');
        }
        pw.addEventListener('input', check);
        confirm.addEventListener('input', check);
    })();
</script>
@endsection
