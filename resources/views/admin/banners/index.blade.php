@extends('layouts.admin')
@section('header', 'Banners')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manage Banners</h2>
    <a href="{{ route('admin.banners.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-md flex items-center gap-2 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Banner
    </a>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
    <!-- Table -->
    <div class="overflow-x-auto">
        @if($banners->count() > 0)
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Banner</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100">Status</th>
                        <th class="px-4 xl:px-5 2xl:px-8 py-5 text-sm font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($banners as $banner)
                    @php
                        $imgSrc = $banner->image ? (str_starts_with($banner->image, 'http') ? $banner->image : asset('storage/' . $banner->image)) : null;
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors group" x-data="{ showViewModal: false }">
                        <td class="px-4 xl:px-5 2xl:px-8 py-4">
                            <div class="flex items-center gap-4 min-w-[240px]">
                                <div class="w-24 h-14 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                                    @if($imgSrc)
                                        <img src="{{ $imgSrc }}" alt="{{ $banner->title }}" loading="lazy" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="font-medium text-slate-900 text-lg break-words">{{ $banner->title ?: 'Untitled Banner' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap">
                            <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg {{ $banner->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $banner->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 xl:px-5 2xl:px-8 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-3">
                                <button type="button" @click="showViewModal = true" class="w-10 h-10 shrink-0 rounded-xl text-blue-600 flex items-center justify-center hover:text-blue-800 transition-colors" title="View Banner" aria-label="View Banner">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>

                                <!-- View Modal -->
                                <div x-show="showViewModal" class="fixed inset-0 z-[100] overflow-y-auto whitespace-normal text-left" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                                    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                                        <div x-show="showViewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/40 transition-opacity backdrop-blur-sm" @click="showViewModal = false" aria-hidden="true"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div x-show="showViewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
                                            <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                                                <h2 class="text-2xl font-extrabold text-slate-900">Banner Details</h2>
                                                <button type="button" @click="showViewModal = false" class="text-slate-400 hover:text-slate-600 transition-colors p-2 bg-white rounded-full shadow-sm border border-slate-100">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                            <div class="p-6 md:p-8 space-y-6">
                                                @if($imgSrc)
                                                    <div class="rounded-xl overflow-hidden bg-slate-100 border border-slate-200 aspect-[16/6]">
                                                        <img src="{{ $imgSrc }}" alt="{{ $banner->title }}" loading="lazy" class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                                <div class="flex flex-col sm:flex-row gap-6">
                                                    <div class="flex-1">
                                                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Title</span>
                                                        <div class="text-xl font-bold text-slate-900">{{ $banner->title ?: 'Untitled Banner' }}</div>
                                                    </div>
                                                    <div class="sm:text-right">
                                                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-2 sm:mb-1">Status</span>
                                                        <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg {{ $banner->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                            {{ $banner->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @if($banner->button_text || $banner->button_url)
                                                <div class="flex flex-col sm:flex-row gap-6">
                                                    <div class="sm:w-1/3">
                                                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Button Text</span>
                                                        <div class="text-slate-700 font-medium">{{ $banner->button_text ?: '—' }}</div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Button URL</span>
                                                        <div class="text-slate-700 font-medium font-mono bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200 break-all">{{ $banner->button_url ?: '—' }}</div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End View Modal -->

                                <a href="{{ route('admin.banners.edit', $banner) }}" class="w-10 h-10 shrink-0 rounded-xl text-teal-600 flex items-center justify-center hover:text-teal-800 transition-colors" title="Edit Banner" aria-label="Edit Banner">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline" data-confirm="Are you sure you want to delete this banner?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 shrink-0 rounded-xl text-red-600 flex items-center justify-center hover:text-red-800 transition-colors" title="Delete" aria-label="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-16 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2">No Banners Found</h3>
                <p class="text-slate-500 font-medium max-w-md mx-auto">You haven't added any banners to the homepage slider yet.</p>
                <a href="{{ route('admin.banners.create') }}" class="inline-flex mt-6 bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-teal-600/30">
                    Add Your First Banner
                </a>
            </div>
        @endif
    </div>

    @if($banners->hasPages())
        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection
