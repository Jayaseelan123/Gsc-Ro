@extends('layouts.admin')
@section('header', 'Edit Product')
@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.products.index') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Product</h2>
        <p class="text-slate-500 font-medium mt-1">{{ $product->name }}</p>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Col: Main Details -->
            <div class="lg:col-span-2 space-y-8">
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium text-lg">
                    @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    @error('slug') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Category <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="category_id" required class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium appearance-none bg-none cursor-pointer">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-500">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('category_id') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label for="price" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Price (INR)</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-5 text-slate-500 font-bold">₹</span>
                            <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" min="0" max="99999999.99" step="0.01" inputmode="decimal" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 pl-10 pr-5 text-slate-900 font-medium" placeholder="e.g. 199.99">
                        </div>
                        <p class="text-xs font-medium text-slate-500 mt-2">Leave empty to show "POA" (price on request).</p>
                        @error('price') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="short_description" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Short Description</label>
                    <textarea id="short_description" name="short_description" rows="2" maxlength="300" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium resize-none" placeholder="One or two lines shown on product cards.">{{ old('short_description', $product->short_description) }}</textarea>
                    <p class="text-xs font-medium text-slate-500 mt-2">Shown on product cards and at the top of the product page. Max 300 characters.</p>
                    @error('short_description') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="specifications" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Specifications</label>
                    <textarea id="specifications" name="specifications" rows="6" maxlength="5000" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium resize-y" placeholder="Capacity: 500 LPH&#10;Material: SS 304&#10;Power: 230V, 50Hz">{{ old('specifications', $product->specifications) }}</textarea>
                    <p class="text-xs font-medium text-slate-500 mt-2">One specification per line. Each line becomes a bullet point on the product page.</p>
                    @error('specifications') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Right Col: Sidebar Settings -->
            <div class="space-y-8">
                
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Current Image</label>
                    <div class="w-full h-48 bg-white rounded-xl border border-slate-200 overflow-hidden mb-4 relative group">
                        @php
                            $imgSrc = $product->main_image ? (str_starts_with($product->main_image, 'http') ? $product->main_image : asset('storage/' . $product->main_image)) : null;
                        @endphp
                        <img id="current-image" @if($imgSrc) src="{{ $imgSrc }}" @endif alt="{{ $product->name }}" class="w-full h-full object-contain {{ $imgSrc ? '' : 'hidden' }}">
                        @if(!$imgSrc)
                            <div id="current-image-placeholder" class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-bold uppercase">No Image</span>
                            </div>
                        @endif
                    </div>
                    
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Upload New Image</label>
                    <div class="flex items-center gap-3">
                        <label for="file-upload" class="flex-1 cursor-pointer bg-white border border-slate-200 rounded-xl px-4 py-3 text-center text-sm font-bold text-slate-600 hover:text-teal-600 hover:border-teal-400 transition-all">
                            <span id="current-image-action">Choose File</span>
                            <input id="file-upload" name="image" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.webp"
                                   data-preview="current-image" data-preview-placeholder="current-image-placeholder" data-preview-name="image-name" data-preview-action="current-image-action">
                        </label>
                    </div>
                    <p id="image-name" class="text-xs font-medium text-slate-500 mt-2">Leave empty to keep current image.</p>
                    @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-6">
                    <div>
                        <span class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">More Images</span>
                        @if($product->images->isNotEmpty())
                            <div class="grid grid-cols-3 gap-2 mb-2">
                                @foreach($product->images as $galleryImage)
                                    <label class="relative block cursor-pointer" title="Tick to remove this image">
                                        <img src="{{ str_starts_with($galleryImage->image, 'http') ? $galleryImage->image : asset('storage/' . $galleryImage->image) }}" alt="Gallery image" class="w-full aspect-square object-cover rounded-lg border border-slate-200 bg-white">
                                        <span class="absolute top-1 right-1 flex items-center gap-1 bg-white/90 rounded-md px-1.5 py-0.5 text-[10px] font-bold text-red-600 shadow-sm">
                                            <input type="checkbox" name="remove_gallery[]" value="{{ $galleryImage->id }}" class="w-3 h-3 rounded border-slate-300 text-red-600 focus:ring-red-500">
                                            Remove
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="text-xs font-medium text-slate-500 mb-3">Tick "Remove" on any image you want to delete.</p>
                        @endif
                        <label for="gallery" class="block text-xs font-bold text-slate-600 mb-2">Add images</label>
                        <input id="gallery" name="gallery[]" type="file" multiple accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 file:cursor-pointer cursor-pointer">
                        <p class="text-xs font-medium text-slate-500 mt-2">Up to {{ \App\Http\Controllers\Admin\ProductController::GALLERY_LIMIT }} extra images in total.</p>
                        @error('gallery') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                        @foreach($errors->get('gallery.*') as $messages)
                            <p class="text-red-500 text-xs font-bold mt-2">{{ $messages[0] }}</p>
                        @endforeach
                    </div>

                    <div>
                        <span class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Spec Sheet (PDF)</span>
                        @if($product->spec_sheet)
                            <div class="flex items-center justify-between gap-3 p-3 bg-white border border-slate-200 rounded-xl mb-3">
                                <a href="{{ asset('storage/' . $product->spec_sheet) }}" target="_blank" class="text-sm font-bold text-teal-600 hover:underline truncate">View current PDF</a>
                                <label class="flex items-center gap-1.5 text-xs font-bold text-red-600 cursor-pointer shrink-0">
                                    <input type="checkbox" name="remove_spec_sheet" value="1" class="w-4 h-4 rounded border-slate-300 text-red-600 focus:ring-red-500">
                                    Remove
                                </label>
                            </div>
                        @endif
                        <input id="spec_sheet" name="spec_sheet" type="file" accept=".pdf,application/pdf" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 file:cursor-pointer cursor-pointer">
                        <p class="text-xs font-medium text-slate-500 mt-2">{{ $product->spec_sheet ? 'Choose a file to replace the current PDF.' : 'Optional, up to 5MB.' }}</p>
                        @error('spec_sheet') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Visibility Status</label>
                        <div class="relative">
                            <select name="status" class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white py-3 px-4 text-slate-900 font-medium appearance-none bg-none cursor-pointer">
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active - Visible on site</option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive - Hidden from site</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:border-teal-400 transition-colors group">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->featured) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500 cursor-pointer">
                            <div>
                                <span class="block text-sm font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Featured Product</span>
                                <span class="block text-xs font-medium text-slate-500">Show this product on the homepage</span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-100 transition-colors">Cancel</a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Update Product
            </button>
        </div>
    </form>
</div>

@include('partials.image-preview-script')
@endsection
