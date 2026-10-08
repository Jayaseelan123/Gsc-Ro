@extends('layouts.admin')
@section('header', 'Website Settings')
@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Website Settings</h2>
        <p class="text-slate-500 font-medium mt-1">Manage your website logo, favicon, contact information, and social links.
        </p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden max-w-5xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Logo Section -->
            <div class="p-8 lg:p-12 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Website Logo
                </h3>

                @php
                    $currentFavicon = !empty($settings['favicon']) ? asset('storage/' . $settings['favicon']) : asset('favicon.ico');
                @endphp
                <!-- Logo + favicon in one box -->
                <div
                    class="bg-white rounded-2xl border border-slate-200 grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                    <!-- Main logo -->
                    <div class="p-6 min-w-0">
                        <label class="block text-sm font-bold text-slate-700 mb-1 uppercase tracking-wider">Upload Main
                            Logo</label>
                        <p class="text-sm text-slate-500 font-medium mb-4">Shown in the website header and footer. PNG with
                            a transparent background works best. PNG, JPG or WEBP, max 2 MB.</p>
                        <div
                            class="w-48 h-24 bg-slate-100 rounded-xl overflow-hidden mb-5 shadow-inner border border-slate-200 flex items-center justify-center p-4">
                            <img id="logo-preview" @if(!empty($settings['logo']))
                            src="{{ asset('storage/' . $settings['logo']) }}" @endif
                                class="max-w-full max-h-full object-contain {{ !empty($settings['logo']) ? '' : 'hidden' }}"
                                alt="Current Logo">
                            <span id="logo-placeholder"
                                class="flex flex-col items-center text-slate-400 {{ !empty($settings['logo']) ? 'hidden' : '' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="mt-1 text-xs font-bold uppercase tracking-wider">No logo</span>
                            </span>
                        </div>
                        <label for="logo"
                            class="inline-flex cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-6 py-3 text-sm font-bold text-slate-700 hover:text-teal-600 hover:border-teal-400 transition-all shadow-sm">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span id="logo-action">Choose New Logo</span>
                            <input id="logo" name="logo" type="file" class="sr-only"
                                accept=".png,.jpg,.jpeg,.webp,image/png,image/jpeg,image/webp" data-preview="logo-preview"
                                data-preview-placeholder="logo-placeholder" data-preview-name="logo-name"
                                data-preview-action="logo-action">
                        </label>
                        <p id="logo-name" class="text-sm font-medium text-slate-500 mt-3 truncate empty:hidden"></p>
                        @error('logo')
                            <p class="text-sm font-medium text-red-600 mt-3">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Favicon -->
                    <div class="p-6 min-w-0" x-data="{ preview: @js($currentFavicon), fileName: '' }">
                        <label class="block text-sm font-bold text-slate-700 mb-1 uppercase tracking-wider">Upload
                            Favicon</label>
                        <p class="text-sm text-slate-500 font-medium mb-4">Shown in the browser tab. Use a square image
                            (32×32 or 64×64 px). ICO, PNG, JPG or WEBP, max 1 MB.</p>
                        <div
                            class="w-24 h-24 bg-slate-100 rounded-xl overflow-hidden mb-5 shadow-inner border border-slate-200 flex items-center justify-center p-4">
                            <img :src="preview" src="{{ $currentFavicon }}" class="max-w-full max-h-full object-contain"
                                alt="Current Favicon">
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <label for="favicon"
                                class="inline-flex cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-6 py-3 text-sm font-bold text-slate-700 hover:text-teal-600 hover:border-teal-400 transition-all shadow-sm">
                                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Choose New Favicon
                                <input id="favicon" name="favicon" type="file" class="sr-only"
                                    accept=".ico,.png,.jpg,.jpeg,.webp,image/x-icon,image/png,image/jpeg,image/webp"
                                    @change="const f = $event.target.files[0]; if (f) { fileName = f.name; preview = URL.createObjectURL(f); }">
                            </label>
                        </div>
                        <p x-show="fileName" x-text="'New favicon selected: ' + fileName" style="display: none;"
                            class="text-sm font-medium text-slate-500 mt-3 truncate"></p>
                        @error('favicon')
                            <p class="text-sm font-medium text-red-600 mt-3">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="p-8 lg:p-12 border-b border-slate-100">
                <h3 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    Contact Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div class="min-w-0">
                        <label for="email"
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Email
                            Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium">
                    </div>
                    <div class="min-w-0">
                        <label for="phone"
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Phone
                            Number</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium">
                    </div>
                    <div class="min-w-0">
                        <label for="whatsapp"
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">WhatsApp
                            Number</label>
                        <input id="whatsapp" type="text" name="whatsapp"
                            value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium"
                            placeholder="e.g. +1234567890">
                    </div>

                    <div class="min-w-0">
                        <label for="address"
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Office
                            Address</label>
                        <textarea id="address" name="address" rows="5"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium">{{ old('address', $settings['address'] ?? '') }}</textarea>
                        <p class="mt-2 text-xs font-medium text-slate-500">Press Enter to start a new line. The Contact page
                            shows the address line by line.</p>
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="p-8 lg:p-12 bg-slate-50/50">
                <h3 class="text-lg font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                        </path>
                    </svg>
                    Social Media Links (Sidebar)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Facebook</label>
                        <input type="url" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white hover:bg-slate-50 transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium"
                            placeholder="https://facebook.com/...">
                    </div>
                    <div>
                        <label
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Instagram</label>
                        <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white hover:bg-slate-50 transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium"
                            placeholder="https://instagram.com/...">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">LinkedIn</label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $settings['linkedin'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white hover:bg-slate-50 transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium"
                            placeholder="https://linkedin.com/...">
                    </div>
                    <div>
                        <label for="google_reviews"
                            class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Google
                            Reviews</label>
                        <input id="google_reviews" type="url" name="google_reviews"
                            value="{{ old('google_reviews', $settings['google_reviews'] ?? '') }}"
                            class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white hover:bg-slate-50 transition-all duration-300 py-3.5 px-5 text-slate-900 font-medium"
                            placeholder="https://g.page/r/...">
                        <p class="mt-2 text-xs font-medium text-slate-500">Google Business Profile &rarr; Ask for reviews
                            &rarr; copy the link.</p>
                    </div>
                </div>
            </div>

            <div class="px-8 lg:px-12 py-8 bg-slate-50 border-t border-slate-200 flex items-center justify-end">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-10 py-3.5 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Save Settings
                </button>
            </div>
        </form>
    </div>
    @include('partials.image-preview-script')
@endsection