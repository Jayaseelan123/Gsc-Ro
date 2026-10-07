@extends('layouts.frontend')
@section('title', $category->name . ' Products')
@section('content')
@include('frontend.partials.page-hero', [
    'eyebrow' => 'Category',
    'title' => $category->name,
    'subtitle' => $category->description,
    'breadcrumbs' => [['Home', route('home')], ['Products', route('products')], [$category->name, null]],
])

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @foreach($products as $product)
            @include('frontend.partials.product-card', ['product' => $product, 'showCategory' => false])
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
        {{ $products->links() }}
    </div>
    @else
    <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
        <h2 class="text-2xl font-bold text-slate-700 mb-2">No Products Found</h2>
        <p class="text-slate-500">We are currently updating our inventory for this category.</p>
    </div>
    @endif
</div>
@endsection