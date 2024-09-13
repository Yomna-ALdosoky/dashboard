<?php

namespace App\Http\Controllers\dashboard;

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
            $query->where('price',  'like', '%'. $request->input('price'). '%');
        }

        $products= $query->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
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

        $product= new Product($request->all());

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect()->route('product.index', compact('product'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'details' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
        $product->file($request->all());

        if($request->hasFile('image')) {
            $imagePath =$request->file('image')->store('image', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('dalate', 'Product deleted successfully.');
    }
}
