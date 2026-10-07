@extends('layouts.admin')
@section('header', 'Edit Gallery Item')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.gallery.index') }}" class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm" aria-label="Back to gallery">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div class="min-w-0">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $gallery->isVideo() ? 'Edit Gallery Video' : 'Edit Gallery Image' }}</h2>
            <p class="text-slate-500 font-medium mt-1 truncate">{{ $gallery->title ?: 'Untitled' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="display_order" value="{{ $gallery->display_order ?? 0 }}">

            <div class="p-6 sm:p-10 space-y-8">
                @include('admin.gallery._media-fields', ['gallery' => $gallery, 'landscape' => true])

                <div>
                    <label for="title" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $gallery->title) }}" maxlength="255" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium text-lg @error('title') border-red-500 @enderror" placeholder="e.g. Water Treatment Plant Installation">
                    <p class="text-xs font-medium text-slate-500 mt-2">Shown with the image or video on the Gallery page.</p>
                    @error('title') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Status</label>
                    <div class="relative">
                        <select id="status" name="status" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 pr-12 text-slate-900 font-medium appearance-none bg-none cursor-pointer @error('status') border-red-500 @enderror">
                            <option value="1" {{ (string) old('status', (int) $gallery->status) === '1' ? 'selected' : '' }}>Active - Visible</option>
                            <option value="0" {{ (string) old('status', (int) $gallery->status) === '0' ? 'selected' : '' }}>Inactive - Hidden</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-slate-500 mt-2">Inactive items are hidden from the website. Up to {{ \App\Http\Controllers\Admin\GalleryController::ACTIVE_LIMIT }} images and videos can be active.</p>
                    @error('status') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="px-6 sm:px-10 py-6 bg-slate-50 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                <a href="{{ route('admin.gallery.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 text-center hover:bg-slate-200 transition-colors">Cancel</a>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
