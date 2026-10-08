@extends('layouts.admin')
@section('header', 'View Category')
@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}"
            class="text-slate-500 hover:text-teal-600 transition-colors flex items-center gap-2 font-medium w-fit">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Categories
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-3xl">
        <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
            <h2 class="text-xl font-extrabold text-slate-900">Category Details</h2>
            <span
                class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg {{ $category->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $category->status ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="p-6 space-y-4"> 
            <div>
                <span class=" text-sm font-extrabold text-black">Name</span>
                <div class="text-lg font-normal text-slate-700 break-words">{{ $category->name }}</div>
            </div>
            <div>
                <span class=" text-sm font-extrabold text-black mb-1">Slug</span>
                <div class="text-slate-600 font-normal">/{{ $category->slug }}</div>
            </div>
            <div>
                <span class=" text-sm font-extrabold text-black mb-1">Short Description</span>
                @if(filled($category->description))
                    <p class="text-slate-600 font-normal leading-relaxed whitespace-pre-line break-words">
                        {{ trim($category->description) }}</p>
                @else
                    <p class="text-slate-400 font-normal italic text-sm">No short description added yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection