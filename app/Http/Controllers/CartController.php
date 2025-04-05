<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
{
    $cart = session()->get('cart', []);
    return view('cart.index', compact('cart'));
}

public function add(Request $request, $id)
{
    $productId = (int) $id;
    $quantity = (int) $request->input('quantity', 1);

    $cart = session()->get('cart', []);
    $product = \App\Models\Product::findOrFail($productId);

    // Vérifie stock disponible
    $existingQty = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;
    $newQty = $existingQty + $quantity;

    if ($newQty > $product->stock) {
        return response()->json(['error' => 'Not enough stock.'], 422);
    }

    $cart[$productId] = [
        "name" => $product->name,
        "price" => $product->price,
        "quantity" => $newQty
    ];

    session()->put('cart', $cart);

    return response()->json(['success' => 'Product added to cart!']);
}



    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);
    $quantity = (int) $request->input('quantity', 1);

    if (isset($cart[$id])) {
        $product = \App\Models\Product::findOrFail($id);

        if ($quantity > $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Quantity exceeds available stock.');
        }

        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Quantity updated.');
}



}
