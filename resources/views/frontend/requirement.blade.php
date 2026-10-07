@extends('layouts.frontend')
@section('title', 'Submit Requirement')
@section('content')

@include('frontend.partials.page-hero', [
    'eyebrow' => 'Custom Orders',
    'title' => 'Submit Your Requirement',
    'subtitle' => 'Let us know exactly what you need. Our technical sales team will review your specifications and provide a custom quote within 24 hours.',
    'breadcrumbs' => [['Home', route('home')], ['Submit Requirement', null]],
])

<section class="py-14 lg:py-16 bg-slate-50 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 -mt-24">
        
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            
            <!-- Form Panel -->
            <div class="p-6 sm:p-10 lg:p-10 max-w-4xl mx-auto">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Requirements</h2>
                    <p class="text-slate-600 font-medium">Fill out the below form for us to understand your requirement & cater to your need</p>
                </div>

                @if (session('success'))
                    <div class="mb-8 bg-green-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-sm">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-green-900">Success!</p>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requirement.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6"
                      x-data="{ sending: false }" @submit="if (sending) { $event.preventDefault(); } else { sending = true; }">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium" placeholder="Enter 10-digit Indian number">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Contact Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Project Type <span class="text-red-500">*</span></label>
                            <select name="project_type" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium cursor-pointer">
                                <option value="">Select</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Industrial">Industrial</option>
                                <option value="Residential">Residential</option>
                                <option value="Institution">Institution</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Select Your Usage Facility <span class="text-red-500">*</span></label>
                            <select name="usage_facility" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium cursor-pointer">
                                <option value="">Select</option>
                                <option value="Hospital">Hospital</option>
                                <option value="School / College">School / College</option>
                                <option value="Office Building">Office Building</option>
                                <option value="Factory">Factory</option>
                                <option value="Restaurant / Hotel">Restaurant / Hotel</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Required Capacity (L/hr or L/day) <span class="text-red-500">*</span></label>
                            <input type="text" name="capacity" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Number of People Using Daily <span class="text-red-500">*</span></label>
                            <input type="number" name="people_daily" required class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Water Source <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                <input type="radio" name="water_source" value="Borewell" required class="w-4 h-4 text-teal-600 focus:ring-teal-500 border-slate-300">
                                <span class="text-sm font-bold text-slate-700">Borewell</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                <input type="radio" name="water_source" value="Municipality" class="w-4 h-4 text-teal-600 focus:ring-teal-500 border-slate-300">
                                <span class="text-sm font-bold text-slate-700">Municipality</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                <input type="radio" name="water_source" value="Tanker" class="w-4 h-4 text-teal-600 focus:ring-teal-500 border-slate-300">
                                <span class="text-sm font-bold text-slate-700">Tanker</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 hover:bg-slate-100 transition-colors">
                                <input type="radio" name="water_source" value="Other" class="w-4 h-4 text-teal-600 focus:ring-teal-500 border-slate-300">
                                <span class="text-sm font-bold text-slate-700">Other</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Message / Description</label>
                        <textarea name="message" rows="3" class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 transition-all py-3 px-4 font-medium resize-none"></textarea>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Upload Water Report (PDF/Image)</label>
                        <input type="file" name="water_report" accept=".pdf,image/*" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 cursor-pointer transition-all">
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-teal-50/50 rounded-2xl border border-teal-100 hover:bg-teal-50 transition-colors">
                            <input type="checkbox" name="want_visit" value="1" class="w-5 h-5 rounded text-teal-600 focus:ring-teal-500 border-teal-300 bg-white">
                            <span class="font-bold text-teal-900">I want GSC-RO to visit & test my water</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" :aria-disabled="sending.toString()" :class="sending ? 'opacity-70 cursor-wait hover:translate-y-0' : ''" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-lg px-8 py-4 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2 uppercase tracking-wide">
                            <span x-show="!sending" class="flex items-center gap-2">
                                Submit Requirement
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                            <span x-show="sending" style="display: none;" class="flex items-center gap-2 normal-case tracking-normal">
                                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
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
