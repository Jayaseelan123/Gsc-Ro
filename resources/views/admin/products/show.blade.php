@extends('layouts.admin')
@section('header', 'View Product')
@section('content')
    @php
        $src = fn($path) => str_starts_with((string) $path, 'http') ? $path : asset('storage/' . $path);
        $imgSrc = filled($product->main_image) ? $src($product->main_image) : null;
        $gallery = $product->images->filter(fn($extra) => filled($extra->image));

        // "Label: value" lines become table rows; any other line spans the full row.
        $specRows = collect($product->specList())->map(function ($line) {
            return preg_match('/^([^:]{1,60}):\s*(.+)$/u', $line, $m)
                ? ['label' => trim($m[1]), 'value' => trim($m[2])]
                : ['label' => null, 'value' => $line];
        });

        // Read-only boxes share the look of the inputs on the Create Product page.
        $label = 'block text-sm font-extrabold text-black mb-3 uppercase tracking-wider';
        $field = 'w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-5 text-slate-900 font-semibold break-words';
        $empty = 'text-slate-400 italic font-normal';
    @endphp
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}"
                class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm"
                aria-label="Back to products">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div class="min-w-0">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">View Product</h2>
                <!-- <p class="text-slate-500 font-medium mt-1 truncate">{{ $product->name }}</p> -->
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left: Product details -->
            <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-10 space-y-8">

                <div>
                    <span class="{{ $label }}">Product Name</span>
                    <div class="{{ $field }} text-lg">{{ $product->name }}</div>
                </div>

                <div>
                    <div>
                        <span class="{{ $label }}">Category</span>
                        <div class="{{ $field }}">{{ $product->category->name ?? 'Uncategorized' }}</div>
                    </div>
                </div>

                <div>
                    <span class="{{ $label }}">Short Description</span>
                    <div class="{{ $field }} whitespace-pre-line leading-relaxed">@if(filled($product->short_description)){{ trim($product->short_description) }}@else<span class="{{ $empty }}">No short description added.</span>@endif</div>
                </div>

                @if(filled($product->description))
                    <div>
                        <span class="{{ $label }}">Description</span>
                        <div class="{{ $field }} whitespace-pre-line leading-relaxed">{{ trim($product->description) }}</div>
                    </div>
                @endif

                <div>
                    <span class="{{ $label }}">Specifications</span>

                    @if($specRows->isNotEmpty())
                        <div class="mt-2 space-y-2">
                            @foreach($specRows as $row)
                                <div class="text-sm break-words">
                                    @if($row['label'])
                                        <span class="font-semibold text-slate-700">{{ $row['label'] }}:</span>
                                        <span class="font-semibold text-slate-900">{{ $row['value'] }}</span>
                                    @else
                                        <span class="font-semibold text-slate-900">{{ $row['value'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="{{ $field }}">
                            <span class="{{ $empty }}">No specifications added.</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Image & visibility -->
            <div class="space-y-8">
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6">
                    <span class="{{ $label }}">Product Image</span>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden">
                        @if($imgSrc)
                            <a href="{{ $imgSrc }}" target="_blank" rel="noopener" title="Open full size">
                                <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="w-full h-56 object-contain bg-white">
                            </a>
                        @else
                            <div class="px-6 py-10 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-4 text-xs font-bold uppercase tracking-wider text-slate-400">No image</p>
                            </div>
                        @endif
                    </div>
                    @if($imgSrc)
                        <p class="text-xs font-medium text-slate-500 mt-2">Click the image to open it full size.</p>
                    @endif
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 space-y-6">
                    <div>
                        <span class="{{ $label }}">More Images</span>
                        @if($gallery->isNotEmpty())
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($gallery as $extra)
                                    <a href="{{ $src($extra->image) }}" target="_blank" rel="noopener" title="Open full size">
                                        <img src="{{ $src($extra->image) }}" alt="Gallery image {{ $loop->iteration }}"
                                            loading="lazy"
                                            class="w-full aspect-square object-cover rounded-lg border border-slate-200 bg-white">
                                    </a>
                                @endforeach
                            </div>
                            <p class="text-xs font-medium text-slate-500 mt-2">{{ $gallery->count() }} extra
                                {{ \Illuminate\Support\Str::plural('image', $gallery->count()) }}. Click one to open it full
                                size.</p>
                        @else
                            <p class="text-sm {{ $empty }}">No extra images added.</p>
                        @endif
                    </div>

                    <div>
                        <span class="{{ $label }}">Spec Sheet (PDF)</span>
                        @if($product->spec_sheet)
                            <a href="{{ asset('storage/' . $product->spec_sheet) }}" target="_blank" rel="noopener"
                                class="flex items-center gap-2 p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-teal-600 hover:underline">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                View current PDF
                            </a>
                        @else
                            <p class="text-sm {{ $empty }}">No spec sheet uploaded.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 space-y-6">
                    <div>
                        <span class="{{ $label }}">Visibility</span>
                        <div
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 px-4 font-semibold {{ $product->status ? 'text-green-700' : 'text-red-700' }}">
                            {{ $product->status ? 'Active - Visible on site' : 'Inactive - Hidden from site' }}
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                        <input type="checkbox" disabled {{ $product->featured ? 'checked' : '' }}
                            class="mt-0.5 w-5 h-5 rounded border-slate-300 text-teal-600" aria-label="Featured product">
                        <span>
                            <span class="block text-sm font-semibold text-slate-800">Featured Product</span>
                            <span
                                class="block text-xs font-medium text-slate-500">{{ $product->featured ? 'Shown on the homepage' : 'Not shown on the homepage' }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection