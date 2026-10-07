@extends('layouts.admin')
@section('header', 'Add Category')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.categories.index') }}" class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm" aria-label="Back to categories">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create New Category</h2>
            <p class="text-slate-500 font-medium mt-1">Categories group your products on the Home and Products pages.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="p-6 sm:p-10 space-y-8">
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Category Name <span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus maxlength="255" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium text-lg @error('name') border-red-500 @enderror @error('slug') border-red-500 @enderror" placeholder="e.g. Electrical Supplies">
                    @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    @error('slug') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Short Description</label>
                    <textarea id="description" name="description" rows="4" maxlength="500" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium resize-none @error('description') border-red-500 @enderror" placeholder="1–2 sentences about what customers will find in this category.">{{ old('description') }}</textarea>
                    <p class="text-xs font-medium text-slate-500 mt-2">Shown under the category name on the website. Max 500 characters.</p>
                    @error('description') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-colors">
                        <input type="checkbox" name="status" value="1" checked class="w-6 h-6 text-teal-600 border-slate-300 rounded focus:ring-teal-500 focus:ring-2">
                        <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Active Status</span>
                    </label>
                    <p class="text-xs font-medium text-slate-500 mt-2 ml-1">If unchecked, this category and its products will be hidden from the website.</p>
                </div>
            </div>

            <div class="px-6 sm:px-10 py-6 bg-slate-50 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 text-center hover:bg-slate-200 transition-colors">Cancel</a>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
