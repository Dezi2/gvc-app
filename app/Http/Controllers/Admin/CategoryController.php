<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // READ (list all)
    public function index()
    {
        // withCount('products') adds a products_count attribute to each category
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // Show the CREATE form
    public function create()
    {
        return view('admin.categories.create');
    }

    // CREATE (save new)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // Auto-generate slug from name (e.g., "Ground Egusi" → "ground-egusi")
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Show the UPDATE form
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE (save changes)
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            // unique check ignores the current category's own row
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // DELETE
    public function destroy(Category $category)
    {
        // Note: products in this category will also be deleted
        // because of the onDelete('cascade') on the foreign key.
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}