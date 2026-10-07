@extends('layouts.admin')
@section('header', 'Add Product')
@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm" aria-label="Back to products">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create New Product</h2>
            <p class="text-slate-500 font-medium mt-1">Fields marked <span class="text-red-500">*</span> are required.</p>
        </div>
    </div>

    @if($categories->isEmpty())
        <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-medium">
            You need at least one active category before adding a product.
            <a href="{{ route('admin.categories.create') }}" class="font-bold underline">Create a category</a>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left: Product details -->
            <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-10 space-y-8">
                <h3 class="text-lg font-extrabold text-slate-900">Product Details</h3>

                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Product Name <span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus maxlength="255" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium text-lg @error('name') border-red-500 @enderror @error('slug') border-red-500 @enderror" placeholder="e.g. Premium Safety Helmet">
                    @error('name') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    @error('slug') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="category_id" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Category <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="category_id" name="category_id" required class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 pl-5 pr-12 text-slate-900 font-medium appearance-none bg-none cursor-pointer @error('category_id') border-red-500 @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                            <input id="price" type="number" name="price" value="{{ old('price') }}" min="0" max="99999999.99" step="0.01" inputmode="decimal" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 pl-10 pr-5 text-slate-900 font-medium @error('price') border-red-500 @enderror" placeholder="e.g. 199.99">
                        </div>
                        <p class="text-xs font-medium text-slate-500 mt-2">Leave empty to show "POA" (price on request).</p>
                        @error('price') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="short_description" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Short Description</label>
                    <textarea id="short_description" name="short_description" rows="2" maxlength="300" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium resize-none @error('short_description') border-red-500 @enderror" placeholder="One or two lines shown on product cards.">{{ old('short_description') }}</textarea>
                    <p class="text-xs font-medium text-slate-500 mt-2">Shown on product cards and at the top of the product page. Max 300 characters.</p>
                    @error('short_description') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="specifications" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Specifications</label>
                    <textarea id="specifications" name="specifications" rows="6" maxlength="5000" class="w-full rounded-2xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 hover:bg-white transition-all duration-300 py-4 px-5 text-slate-900 font-medium resize-y @error('specifications') border-red-500 @enderror" placeholder="Capacity: 500 LPH&#10;Material: SS 304&#10;Power: 230V, 50Hz">{{ old('specifications') }}</textarea>
                    <p class="text-xs font-medium text-slate-500 mt-2">One specification per line. Each line becomes a bullet point on the product page.</p>
                    @error('specifications') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Right: Image & visibility -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
                    <span class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Product Image <span class="text-red-500">*</span></span>

                    <label for="file-upload" class="block cursor-pointer rounded-2xl border border-dashed border-slate-300 bg-slate-50 hover:bg-teal-50 hover:border-teal-400 transition-all group overflow-hidden @error('image') border-red-500 @enderror">
                        <img id="image-preview" src="" alt="Selected image preview" class="hidden w-full h-56 object-contain bg-white">
                        <div id="image-placeholder" class="px-6 py-10 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-4 text-sm font-semibold text-teal-600">Click to choose an image</p>
                            <p class="text-xs leading-5 text-slate-500">JPG, PNG or WEBP, up to 2MB</p>
                        </div>
                    </label>
                    <input id="file-upload" name="image" type="file" class="sr-only" accept=".jpg,.jpeg,.png,.webp">
                    <p id="image-name" class="hidden text-xs font-medium text-slate-600 mt-2 truncate"></p>
                    <p id="image-error" class="hidden text-red-500 text-xs font-bold mt-2"></p>
                    @error('image') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 space-y-6">
                    <div>
                        <label for="gallery" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">More Images</label>
                        <input id="gallery" name="gallery[]" type="file" multiple accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 file:cursor-pointer cursor-pointer">
                        <div id="gallery-preview" class="grid grid-cols-4 gap-2 mt-3 empty:hidden"></div>
                        <p class="text-xs font-medium text-slate-500 mt-2">Optional. Up to {{ \App\Http\Controllers\Admin\ProductController::GALLERY_LIMIT }} extra images shown as thumbnails under the main image.</p>
                        @error('gallery') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                        @foreach($errors->get('gallery.*') as $messages)
                            <p class="text-red-500 text-xs font-bold mt-2">{{ $messages[0] }}</p>
                        @endforeach
                    </div>

                    <div>
                        <label for="spec_sheet" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Spec Sheet (PDF)</label>
                        <input id="spec_sheet" name="spec_sheet" type="file" accept=".pdf,application/pdf" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 file:cursor-pointer cursor-pointer">
                        <p class="text-xs font-medium text-slate-500 mt-2">Optional, up to 5MB. Used by the "Download Specs" button.</p>
                        @error('spec_sheet') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 space-y-6">
                    <div>
                        <label for="status" class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider">Visibility</label>
                        <div class="relative">
                            <select id="status" name="status" class="w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-slate-50 py-3 pl-4 pr-10 text-slate-900 font-medium appearance-none bg-none cursor-pointer">
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active - Visible on site</option>
                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive - Hidden from site</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('status') <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-teal-400 transition-colors group">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="mt-0.5 w-5 h-5 rounded border-slate-300 text-teal-600 focus:ring-teal-500 cursor-pointer">
                        <span>
                            <span class="block text-sm font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Featured Product</span>
                            <span class="block text-xs font-medium text-slate-500">Show this product on the homepage</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-[2rem] shadow-sm border border-slate-100 px-6 sm:px-10 py-6 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-600 text-center hover:bg-slate-100 transition-colors">Cancel</a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-teal-600/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Publish Product
            </button>
        </div>
    </form>
</div>

<script>
    (function () {
        const input = document.getElementById('file-upload');
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        const nameLabel = document.getElementById('image-name');
        const errorLabel = document.getElementById('image-error');
        const allowed = ['image/jpeg', 'image/png', 'image/webp'];

        function reset(message) {
            input.value = '';
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            nameLabel.classList.add('hidden');
            errorLabel.textContent = message || '';
            errorLabel.classList.toggle('hidden', !message);
        }

        input.addEventListener('change', function () {
            const file = input.files[0];
            if (!file) return reset();
            if (!allowed.includes(file.type)) return reset('Please choose a JPG, PNG or WEBP image.');
            if (file.size > 2 * 1024 * 1024) return reset('Image is larger than 2MB. Please choose a smaller file.');

            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            nameLabel.textContent = file.name + ' (click image to change)';
            nameLabel.classList.remove('hidden');
            errorLabel.classList.add('hidden');
        });

        const gallery = document.getElementById('gallery');
        const galleryPreview = document.getElementById('gallery-preview');
        gallery.addEventListener('change', function () {
            galleryPreview.innerHTML = '';
            Array.from(gallery.files).forEach(function (file) {
                if (!file.type.startsWith('image/')) return;
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;
                img.className = 'w-full aspect-square object-cover rounded-lg border border-slate-200';
                galleryPreview.appendChild(img);
            });
        });
    })();
</script>
@endsection
