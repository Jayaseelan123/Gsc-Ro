@extends('layouts.admin')
@section('header', 'Gallery')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manage Gallery</h2>
    <a href="{{ route('admin.gallery.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-md flex items-center gap-2 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Image or Video
    </a>
</div>

<!-- Search Section outside the card -->
<div class="mb-6 bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
    <form action="{{ route('admin.gallery.index') }}" method="GET" role="search" class="flex items-center gap-3 w-full">
        <label for="gallery-search" class="sr-only">Search gallery</label>
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input id="gallery-search" type="text" name="search" placeholder="Search gallery..." value="{{ request('search') }}" maxlength="100" autocomplete="off" class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 transition-all font-medium text-slate-900 bg-white">
        </div>

        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-300 shrink-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Search
        </button>

        <a href="{{ route('admin.gallery.index') }}" class="text-slate-500 hover:text-slate-800 font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition-all duration-300 shrink-0" title="Reset Search & Filters">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Reset
        </a>
    </form>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col">
    @if($galleries->count() > 0)
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galleries as $image)
                @php
                    $imgSrc = $image->thumbnailUrl();
                    $isVideo = $image->isVideo();
                    $videoFile = $isVideo ? $image->videoFileUrl() : null;
                    $embedUrl = $isVideo ? $image->youtubeEmbedUrl(true) : null;
                @endphp
                <div x-data="{ showViewModal: false }" class="flex">
                    <!-- Image Card -->
                    <div class="w-full bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col group">
                        <button type="button" @click="showViewModal = true" class="relative block w-full aspect-[4/3] bg-slate-100 overflow-hidden focus:outline-none focus-visible:ring-4 focus-visible:ring-teal-100" aria-label="View {{ $image->title ?: ($isVideo ? 'video' : 'image') }}">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $image->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @elseif($videoFile)
                                <video src="{{ $videoFile }}#t=0.1" muted playsinline preload="metadata" class="w-full h-full object-cover pointer-events-none" aria-hidden="true"></video>
                            @else
                                <span class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="mt-2 text-xs font-bold uppercase tracking-wider">No Image</span>
                                </span>
                            @endif
                            <span class="absolute top-3 left-3 px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm {{ $image->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $image->status ? 'Active' : 'Inactive' }}
                            </span>
                            @if($isVideo)
                                <span class="absolute top-3 right-3 px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm bg-slate-900/80 text-white">{{ $embedUrl ? 'YouTube' : 'Video' }}</span>
                                <span class="absolute inset-0 flex items-center justify-center" aria-hidden="true">
                                    <span class="w-14 h-14 rounded-full bg-white/90 text-slate-900 shadow-lg flex items-center justify-center transition-transform group-hover:scale-110">
                                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </span>
                            @endif
                        </button>

                        <div class="px-5 py-4 flex-1 min-w-0">
                            <div class="font-medium text-slate-900 text-lg truncate" title="{{ $image->title ?: 'Untitled' }}">{{ $image->title ?: 'Untitled' }}</div>
                        </div>

                        <div class="px-5 py-2 border-t border-slate-100 flex items-center justify-center gap-3">
                            <a href="{{ route('admin.gallery.edit', $image) }}" class="w-10 h-10 shrink-0 rounded-xl text-teal-600 flex items-center justify-center hover:text-teal-800 transition-colors" title="Edit" aria-label="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="inline" data-confirm="Are you sure you want to delete this {{ $isVideo ? 'video' : 'image' }}?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 shrink-0 rounded-xl text-red-600 flex items-center justify-center hover:text-red-800 transition-colors" title="Delete" aria-label="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- View Modal -->
                    <div x-show="showViewModal" @keydown.escape.window="showViewModal = false" class="fixed inset-0 z-[100] overflow-y-auto whitespace-normal text-left" role="dialog" aria-modal="true" style="display: none;">
                        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                            <div x-show="showViewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/40 transition-opacity backdrop-blur-sm" @click="showViewModal = false" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div x-show="showViewModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
                                <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                                    <h2 class="text-2xl font-extrabold text-slate-900">{{ $isVideo ? 'Video Details' : 'Image Details' }}</h2>
                                    <button type="button" @click="showViewModal = false" class="text-slate-400 hover:text-slate-600 transition-colors p-2 bg-white rounded-full shadow-sm border border-slate-100" aria-label="Close">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                <div class="p-6 md:p-8 space-y-6">
                                    @if($isVideo && ($embedUrl || $videoFile))
                                        {{-- The player only exists while the pop-up is open, so closing it stops the video. --}}
                                        <div class="h-56 sm:h-64 rounded-xl overflow-hidden bg-black border border-slate-200">
                                            <template x-if="showViewModal">
                                                @if($embedUrl)
                                                    <iframe src="{{ $embedUrl }}" title="{{ $image->title ?: 'Gallery video' }}" class="w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                @else
                                                    <video src="{{ $videoFile }}" @if($imgSrc) poster="{{ $imgSrc }}" @endif class="w-full h-full object-contain" controls playsinline preload="metadata"></video>
                                                @endif
                                            </template>
                                        </div>
                                    @elseif($imgSrc)
                                        <div class="h-56 sm:h-64 p-3 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center">
                                            <img src="{{ $imgSrc }}" alt="{{ $image->title }}" loading="lazy" class="max-w-full max-h-full object-contain">
                                        </div>
                                    @endif
                                    <div class="flex flex-col sm:flex-row gap-6">
                                        <div class="flex-1 min-w-0">
                                            <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Title</span>
                                            <div class="text-xl font-bold text-slate-900 break-words">{{ $image->title ?: 'Untitled' }}</div>
                                        </div>
                                        <div class="sm:text-right">
                                            <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-2 sm:mb-1">Status</span>
                                            <span class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg {{ $image->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $image->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-slate-400 uppercase tracking-wider mb-1">Added On</span>
                                        <div class="text-slate-700 font-medium">{{ optional($image->created_at)->format('M d, Y') ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="px-6 md:px-8 py-5 border-t border-slate-100 bg-slate-50 flex justify-end">
                                    <a href="{{ route('admin.gallery.edit', $image) }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-md flex items-center gap-2 transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        {{ $isVideo ? 'Edit Video' : 'Edit Image' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End View Modal -->
                </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="p-16 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Nothing in the Gallery Yet</h3>
            <p class="text-slate-500 font-medium max-w-md mx-auto">You haven't added any images or videos yet, or nothing matches your search criteria.</p>
            <a href="{{ route('admin.gallery.create') }}" class="inline-flex mt-6 bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-teal-600/30">
                Add Your First Image or Video
            </a>
        </div>
    @endif

    @if($galleries->hasPages())
        <div class="p-6 border-t border-slate-100 bg-slate-50/50">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection
