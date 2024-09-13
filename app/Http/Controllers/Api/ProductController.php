<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if($request->filled('title')) {
            $query->where('title', 'like', '%'. $request->input('title'). '%');
        }

        if($request->filled('brand')) {
            $query->where('brand', 'like', '%'. $request->input('brand'). '%');
        }

        if($request->filled('price')) {
            $query->where('price', $request->input('price'));
        }

        $products = $query->get();
        return response()->json($products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'details' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product = new Product($request->all());

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'string|max:255',
            'brand' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'details' => 'string',
            'price' => 'numeric',
        ]);

        $product->update($request->all());

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return response()->json(['message' => 'Product updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}
