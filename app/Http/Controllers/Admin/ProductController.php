<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'admin.products',
            compact('products', 'categories')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'name' => 'required|string|max:255',

            'sku' => 'required|string|max:100|unique:products,sku',

            'cost_price' => 'required|numeric|min:0',

            'selling_price' => 'required|numeric|min:0|gte:cost_price',

            'stock' => 'required|integer|min:0',

            'low_stock_limit' => 'required|integer|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string',

            'status' => 'required|in:active,inactive',
        ]);


        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }


        Product::create([
            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' => $this->generateUniqueSlug(
                $validated['name']
            ),

            'sku' => $validated['sku'],

            'cost_price' => $validated['cost_price'],

            'selling_price' => $validated['selling_price'],

            'stock' => $validated['stock'],

            'low_stock_limit' => $validated['low_stock_limit'],

            'image' => $imagePath,

            'description' => $validated['description'] ?? null,

            'status' => $validated['status'],
        ]);


        return redirect()
            ->route('admin.products')
            ->with(
                'success',
                'Product added successfully.'
            );
    }


    public function update(
        Request $request,
        Product $product
    ) {

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'name' => 'required|string|max:255',

            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,

            'cost_price' => 'required|numeric|min:0',

            'selling_price' => 'required|numeric|min:0|gte:cost_price',

            'stock' => 'required|integer|min:0',

            'low_stock_limit' => 'required|integer|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable|string',

            'status' => 'required|in:active,inactive',
        ]);


        $imagePath = $product->image;


        if ($request->hasFile('image')) {

            if ($product->image) {

                Storage::disk('public')->delete(
                    $product->image
                );
            }


            $imagePath = $request->file('image')
                ->store('products', 'public');
        }


        $product->update([
            'category_id' => $validated['category_id'],

            'name' => $validated['name'],

            'slug' => $this->generateUniqueSlug(
                $validated['name'],
                $product->id
            ),

            'sku' => $validated['sku'],

            'cost_price' => $validated['cost_price'],

            'selling_price' => $validated['selling_price'],

            'stock' => $validated['stock'],

            'low_stock_limit' => $validated['low_stock_limit'],

            'image' => $imagePath,

            'description' => $validated['description'] ?? null,

            'status' => $validated['status'],
        ]);


        return redirect()
            ->route('admin.products')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }


    public function destroy(Product $product)
    {
        if ($product->image) {

            Storage::disk('public')->delete(
                $product->image
            );
        }


        $product->delete();


        return redirect()
            ->route('admin.products')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }


    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($name);

        $originalSlug = $slug;

        $counter = 1;


        while (
            Product::where('slug', $slug)
                ->when(
                    $ignoreId,
                    function ($query) use ($ignoreId) {

                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        );
                    }
                )
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        return $slug;
    }
}