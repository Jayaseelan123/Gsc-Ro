<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $categories = $query->orderBy('display_order')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug((string) $request->name)]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string|max:500',
            'status' => 'boolean',
        ], $this->messages());

        $data['status'] = $request->has('status');
        $data['display_order'] = 0;

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        // Load the related products for this category to display them
        $category->load('products');
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->merge(['slug' => Str::slug((string) $request->name)]);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string|max:500',
            'status' => 'boolean',
        ], $this->messages());

        $data['status'] = $request->has('status');
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $productCount = $category->products()->count();
        if ($productCount > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error_title', 'This category can\'t be deleted yet')
                ->with('error', '"' . $category->name . '" still has ' . $productCount . ' ' . Str::plural('product', $productCount) . '. Move ' . ($productCount === 1 ? 'it' : 'them') . ' to another category or delete ' . ($productCount === 1 ? 'it' : 'them') . ' first, then delete the category.')
                ->with('error_action', [
                    'url' => route('admin.products.index', ['search' => $category->name]),
                    'label' => 'View ' . ($productCount === 1 ? 'this product' : 'these ' . $productCount . ' products'),
                ]);
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function messages(): array
    {
        return [
            'slug.required' => 'The category name must contain letters or numbers.',
            'slug.unique' => 'A category with this name already exists.',
            'image.mimes' => 'The image must be a JPG, PNG or WEBP file.',
            'image.max' => 'The image must not be larger than 2MB.',
            'display_order.min' => 'Display order cannot be negative.',
        ];
    }
}
