<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'category' => 'nullable|string',
        'stock' => 'nullable|integer'
    ]);

    
    Product::create($request->except('_token'));

    return redirect()->route(route: 'products.index');
}

    // Show Edit Form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update Product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category' => 'nullable|string',
            'stock' => 'nullable|integer'
        ]);

        $product->update($request->except('_token', '_method'));

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete Product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
    public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

    return view('products.index', compact('products'));
}
public function show($id)
{
    $product = Product::find($id);

    if (!$product) {
        // Show a clean error page or message
        abort(404, 'Product not found.');
    }

    return view('products.show', compact('product'));
}

}
    