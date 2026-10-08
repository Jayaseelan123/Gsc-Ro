@extends('layouts.frontend')
@section('title', 'Submit Requirement')
@section('content')

    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Custom Orders',
        'title' => 'Submit Your Requirement',
        'subtitle' => 'Let us know exactly what you need. Our technical sales team will review your specifications and provide a custom quote within 24 hours.',
    ])



    <section class="pt-10 lg:pt-14 pb-14 lg:pb-16 bg-page relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 overflow-hidden">

                <!-- Form Panel -->
                <div class="p-8 sm:p-12 max-w-4xl mx-auto">

                    <div class="mb-10">
                        <h2 class="text-center text-3xl md:text-4xl font-bold text-brand-800 tracking-tight mb-8 lg:mb-10">
                            Submit Your Requirement</h2>
                        <p class="text-slate-600 font-medium">Fill out the below form for us to understand your requirement
                            & cater to your need</p>
                    </div>

                    @if (session('success'))
                        <div data-success-message
                            class="mb-8 bg-green-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-sm">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                            <p class="flex-1 font-bold text-green-900">{{ session('success') }}</p>
                        </div>
                        <script>
                            // A success message belongs to the page load right after the action. If the browser brings this page
                            // back from its history (Back/Forward), drop the message so it is not shown a second time.
                            (function () {
                                function dropSuccess() {
                                    document.querySelectorAll('[data-success-message]').forEach(function (el) { el.remove(); });
                                }
                                const nav = performance.getEntriesByType && performance.getEntriesByType('navigation')[0];
                                if (nav && nav.type === 'back_forward') dropSuccess();
                                window.addEventListener('pageshow', function (e) { if (e.persisted) dropSuccess(); });
                            })();
                        </script>
                    @endif

                    <form action="{{ route('requirement.submit') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6" x-data="{ sending: false }"
                        @submit="if (sending) { $event.preventDefault(); } else { sending = true; }">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Full Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium @error('name') border-red-500 @enderror">
                                @error('name')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Contact Number <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required minlength="10"
                                    maxlength="10" pattern="[0-9]{10}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium @error('phone') border-red-500 @enderror"
                                    placeholder="Enter 10-digit Indian number">
                                @error('phone')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Contact Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Project Type <span
                                        class="text-red-500">*</span></label>
                                <select name="project_type" required
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium cursor-pointer @error('project_type') border-red-500 @enderror">
                                    <option value="">Select</option>
                                    <option value="Commercial" {{ old('project_type') == 'Commercial' ? 'selected' : '' }}>
                                        Commercial</option>
                                    <option value="Industrial" {{ old('project_type') == 'Industrial' ? 'selected' : '' }}>
                                        Industrial</option>
                                    <option value="Residential" {{ old('project_type') == 'Residential' ? 'selected' : '' }}>
                                        Residential</option>
                                    <option value="Institution" {{ old('project_type') == 'Institution' ? 'selected' : '' }}>
                                        Institution</option>
                                    <option value="Other" {{ old('project_type') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('project_type')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Select Your Usage Facility <span
                                        class="text-red-500">*</span></label>
                                <select name="usage_facility" required
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium cursor-pointer @error('usage_facility') border-red-500 @enderror">
                                    <option value="">Select</option>
                                    <option value="Hospital" {{ old('usage_facility') == 'Hospital' ? 'selected' : '' }}>
                                        Hospital</option>
                                    <option value="School / College" {{ old('usage_facility') == 'School / College' ? 'selected' : '' }}>School / College</option>
                                    <option value="Office Building" {{ old('usage_facility') == 'Office Building' ? 'selected' : '' }}>Office Building</option>
                                    <option value="Factory" {{ old('usage_facility') == 'Factory' ? 'selected' : '' }}>Factory
                                    </option>
                                    <option value="Restaurant / Hotel" {{ old('usage_facility') == 'Restaurant / Hotel' ? 'selected' : '' }}>Restaurant / Hotel</option>
                                    <option value="Other" {{ old('usage_facility') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('usage_facility')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Required Capacity (L/hr or L/day)
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="capacity" value="{{ old('capacity') }}" required
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium @error('capacity') border-red-500 @enderror">
                                @error('capacity')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Number of People Using Daily
                                    <span class="text-red-500">*</span></label>
                                <input type="number" name="people_daily" value="{{ old('people_daily') }}" required
                                    class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium @error('people_daily') border-red-500 @enderror">
                                @error('people_daily')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-3">Water Source <span
                                    class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <label
                                    class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                    <input type="radio" name="water_source" value="Borewell" required {{ old('water_source') == 'Borewell' ? 'checked' : '' }}
                                        class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-slate-300">
                                    <span class="text-sm font-bold text-slate-900">Borewell</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                    <input type="radio" name="water_source" value="Municipality" {{ old('water_source') == 'Municipality' ? 'checked' : '' }}
                                        class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-slate-300">
                                    <span class="text-sm font-bold text-slate-900">Municipality</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                    <input type="radio" name="water_source" value="Tanker" {{ old('water_source') == 'Tanker' ? 'checked' : '' }}
                                        class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-slate-300">
                                    <span class="text-sm font-bold text-slate-900">Tanker</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                    <input type="radio" name="water_source" value="Other" {{ old('water_source') == 'Other' ? 'checked' : '' }}
                                        class="w-4 h-4 text-brand-600 focus:ring-brand-500 border-slate-300">
                                    <span class="text-sm font-bold text-slate-900">Other</span>
                                </label>
                            </div>
                            @error('water_source')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Message / Description</label>
                            <textarea name="message" rows="3"
                                class="w-full rounded-xl border-slate-100 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 bg-slate-50 transition-all py-3 px-4 font-medium resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <label class="block text-sm font-bold text-slate-900 mb-2">Upload Water Report
                                (PDF/Image)</label>
                            <input type="file" name="water_report" accept=".pdf,image/*"
                                class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer transition-all">
                            @error('water_report')
                                <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="flex items-center gap-3 cursor-pointer p-4 bg-brand-50/50 rounded-2xl border border-brand-100 hover:bg-brand-50 transition-colors">
                                <input type="checkbox" name="want_visit" value="1" {{ old('want_visit') ? 'checked' : '' }}
                                    class="w-5 h-5 rounded text-brand-600 focus:ring-brand-500 border-brand-300 bg-white">
                                <span class="font-bold text-brand-900">I want GSC-RO to visit & test my water</span>
                            </label>
                            @error('want_visit')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit" :aria-disabled="sending.toString()"
                                :class="sending ? 'opacity-70 cursor-wait hover:translate-y-0' : ''"
                                class="w-full bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-lg px-8 py-4 rounded-xl shadow-lg shadow-brand-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2 uppercase tracking-wide">
                                <span x-show="!sending" class="flex items-center gap-2">
                                    Submit Requirement
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                                <span x-show="sending" style="display: none;"
                                    class="flex items-center gap-2 normal-case tracking-normal">
                                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                    Submitting, please wait…
                                </span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection