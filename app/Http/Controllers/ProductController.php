<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class ProductController extends Controller
{
     use AuthorizesRequests;
    public function index(Request $request)
    {
        $products = Product::with(['user', 'primaryImage'])
            ->active()
            ->when($request->search, function ($query, $search) {
                $query->search($search);
            })
            ->latest()
            ->paginate(12);

        return Inertia::render('Products/Index', [
            'products' => $products,
            'filters' => $request->only(['search']),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['user', 'images']);

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'delivery_mode' => 'required|in:delivery,pickup,both',
            'delivery_fee' => 'nullable|numeric|min:0',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = $request->user()->products()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'delivery_mode' => $validated['delivery_mode'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
        ]);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'is_primary' => $index === 0,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('seller.products')->with('success', 'Produit créé avec succès !');
    }

    // public function edit(Product $product)
    // {
    //     $this->authorize('update', $product);

    //     $product->load('images');

    //     return Inertia::render('Products/Edit', [
    //         'product' => $product,
    //     ]);
    // }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'delivery_mode' => 'required|in:delivery,pickup,both',
            'delivery_fee' => 'nullable|numeric|min:0',
            'new_images' => 'nullable|array|max:5',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:product_images,id',
        ]);

        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'delivery_mode' => $validated['delivery_mode'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
        ]);

        // Remove images
        if (!empty($validated['remove_images'])) {
            ProductImage::whereIn('id', $validated['remove_images'])->delete();
        }

        // Add new images
        if ($request->hasFile('new_images')) {
            $currentCount = $product->images()->count();
            foreach ($request->file('new_images') as $index => $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    'is_primary' => $currentCount === 0 && $index === 0,
                    'order' => $currentCount + $index,
                ]);
            }
        }

        return redirect()->route('seller.products')->with('success', 'Produit mis à jour !');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Produit supprimé !');
    }
}