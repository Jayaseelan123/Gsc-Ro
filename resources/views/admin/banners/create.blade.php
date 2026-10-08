@extends('layouts.admin')
@section('header', 'Add Banner')
@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.banners.index') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create New Banner</h2>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12">
        @csrf
        
        <div class="max-w-3xl mx-auto space-y-8">
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <label class="block text-sm font-extrabold text-black mb-3 uppercase tracking-wider">Banner Image <span class="text-red-500">*</span></label>
                <div class="mt-2 flex justify-center rounded-2xl border border-dashed border-slate-300 px-6 py-10 bg-white hover:bg-teal-50 hover:border-teal-400 transition-all group">
                    <div class="text-center w-full">
                        <img id="banner-image-preview" alt="Selected banner preview" class="hidden block mx-auto w-full max-h-48 object-contain rounded-xl">
                        <svg id="banner-image-placeholder" class="mx-auto h-12 w-12 text-slate-300 group-hover:text-teal-500 transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm leading-6 text-slate-600 justify-center">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-teal-600 hover:text-teal-500">
                                <span id="banner-image-action">Upload a file</span>
                                <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" required
                                       data-preview="banner-image-preview" data-preview-placeholder="banner-image-placeholder" data-preview-name="banner-image-name" data-preview-action="banner-image-action">
                            </label>
                        </div>
                        <p id="banner-image-name" class="text-xs font-medium text-slate-600 mt-1 truncate empty:hidden"></p>
                        <p class="text-xs leading-5 text-slate-500 mt-1">Recommended size: 1920x800</p>
                    </div>
                </div>
                @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <label class="block text-sm font-extrabold text-black mb-3 uppercase tracking-wider">Status</label>
                <div class="relative">
                    <select name="status" class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white py-3 px-4 text-slate-900 font-medium appearance-none bg-none cursor-pointer">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active - Visible</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive - Hidden</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.banners.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-100 transition-colors">Cancel</a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Save Banner
            </button>
        </div>
    </form>
</div>
@include('partials.image-preview-script')
@endsection
