@extends('layouts.admin')

@section('header', 'Admin Dashboard')

@section('content')
    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        <!-- Products -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Total Products</p>
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $totalProducts }}</h3>
            </div>
            <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Total Categories</p>
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $totalCategories }}</h3>
            </div>
            <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
        </div>

        <!-- Enquiries -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Total Enquiries</p>
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $totalEnquiries }}</h3>
            </div>
            <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <!-- New Enquiries -->
        <div class="bg-gradient-to-br from-teal-600 to-indigo-700 rounded-[2rem] p-8 shadow-lg shadow-teal-600/20 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300 text-white relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-teal-100 font-bold uppercase tracking-widest text-xs mb-2">New Unread Enquiries</p>
                <h3 class="text-4xl font-extrabold">{{ $newEnquiries }}</h3>
            </div>
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm relative z-10">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
        </div>

        <!-- Gallery Images -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Gallery Images</p>
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $galleryImages }}</h3>
            </div>
            <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <!-- Active Banners -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 flex items-center justify-between group hover:-translate-y-1 transition-all duration-300">
            <div>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-xs mb-2">Active Banners</p>
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $activeBanners }}</h3>
            </div>
            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        
        <!-- Recent Enquiries -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-xl font-extrabold text-slate-900">Recent Enquiries</h3>
                <a href="{{ route('admin.enquiries.index') }}" class="text-sm font-bold text-teal-600 hover:text-teal-800 bg-teal-50 px-4 py-2 rounded-xl transition-colors">View All</a>
            </div>
            <div class="p-0 overflow-x-auto flex-1">
                @if($recentEnquiries->count() > 0)
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100 w-16">S.No</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Customer Name</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Status</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Date Received</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentEnquiries as $enquiry)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 whitespace-nowrap text-slate-600 font-bold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="font-bold text-slate-900">{{ $enquiry->name }}</div>
                                    <div class="text-sm text-slate-500">{{ $enquiry->email }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg {{ $enquiry->statusClass() }}">
                                        {{ $enquiry->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium text-slate-500">
                                    {{ $enquiry->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium">No recent enquiries found.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-xl font-extrabold text-slate-900">Recently Added Products</h3>
                <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-teal-600 hover:text-teal-800 bg-teal-50 px-4 py-2 rounded-xl transition-colors">Manage Products</a>
            </div>
            <div class="p-0 overflow-x-auto flex-1">
                @if($recentProducts->count() > 0)
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100 w-16">S.No</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Product Name</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Category</th>
                                <th class="px-8 py-5 text-xs font-extrabold text-slate-500 uppercase tracking-widest border-b border-slate-100">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentProducts as $product)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5 whitespace-nowrap text-slate-600 font-bold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                            @if($product->main_image)
                                                <img src="{{ str_starts_with($product->main_image, 'http') ? $product->main_image : asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="font-bold text-slate-900">{{ $product->name }}</div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium text-slate-500">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg {{ $product->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium">No products added yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
