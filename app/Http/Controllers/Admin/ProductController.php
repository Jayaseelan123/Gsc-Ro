<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public const GALLERY_LIMIT = 8;

    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('category', fn ($c) => $c->where('name', 'like', '%' . $search . '%'));
            });
        }

        $products = $query->orderBy('display_order')->paginate(10)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug((string) $request->name)]);

        $data = $request->validate($this->rules(), $this->messages());

        $data['featured'] = $request->boolean('is_featured');
        $data['display_order'] = 0;
        $data['main_image'] = $request->file('image')->store('products', 'public');
        if ($request->hasFile('spec_sheet')) {
            $data['spec_sheet'] = $request->file('spec_sheet')->store('products/specs', 'public');
        }

        $product = Product::create(Arr::except($data, ['image', 'gallery', 'remove_gallery', 'remove_spec_sheet']));
        $this->addGalleryImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category', 'images');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Keep the product's own category in the list even if it has since been made inactive.
        $categories = Category::where('status', true)->orWhere('id', $product->category_id)->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->merge(['slug' => Str::slug((string) $request->name)]);

        $data = $request->validate($this->rules($product), $this->messages());

        $data['featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $data['main_image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('spec_sheet') || $request->boolean('remove_spec_sheet')) {
            if ($product->spec_sheet) {
                Storage::disk('public')->delete($product->spec_sheet);
            }
            $data['spec_sheet'] = $request->hasFile('spec_sheet')
                ? $request->file('spec_sheet')->store('products/specs', 'public')
                : null;
        }

        $product->update(Arr::except($data, ['image', 'gallery', 'remove_gallery', 'remove_spec_sheet']));

        foreach ($product->images()->whereIn('id', $request->input('remove_gallery', []))->get() as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
        $this->addGalleryImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $files = array_merge([$product->main_image, $product->spec_sheet], $product->images()->pluck('image')->all());
        Storage::disk('public')->delete(array_filter($files));

        $product->images()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function addGalleryImages(Request $request, Product $product): void
    {
        $order = (int) $product->images()->max('display_order');

        foreach ($request->file('gallery', []) as $file) {
            $product->images()->create([
                'image' => $file->store('products/gallery', 'public'),
                'display_order' => ++$order,
            ]);
        }
    }

    private function rules(?Product $product = null): array
    {
        $galleryLimit = self::GALLERY_LIMIT - ($product ? $product->images()->count() : 0);

        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug' . ($product ? ',' . $product->id : ''),
            'short_description' => 'nullable|string|max:300',
            'specifications' => 'nullable|string|max:5000',
            'image' => ($product ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery' => 'nullable|array|max:' . max(0, $galleryLimit + count(request()->input('remove_gallery', []))),
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'integer',
            'spec_sheet' => 'nullable|file|mimes:pdf|max:5120',
            'remove_spec_sheet' => 'nullable|boolean',
            'status' => 'required|boolean',
        ];
    }

    private function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category.',
            'slug.required' => 'The product name must contain letters or numbers.',
            'slug.unique' => 'A product with this name already exists.',
            'image.required' => 'Please upload a product image.',
            'image.mimes' => 'The image must be a JPG, PNG or WEBP file.',
            'image.max' => 'The image must not be larger than 2MB.',
            'gallery.max' => 'A product can have at most ' . self::GALLERY_LIMIT . ' extra gallery images.',
            'gallery.*.image' => 'Each gallery file must be an image.',
            'gallery.*.mimes' => 'Gallery images must be JPG, PNG or WEBP files.',
            'gallery.*.max' => 'Each gallery image must not be larger than 2MB.',
            'spec_sheet.mimes' => 'The spec sheet must be a PDF file.',
            'spec_sheet.max' => 'The spec sheet must not be larger than 5MB.',
        ];
    }
}
