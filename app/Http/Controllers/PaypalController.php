<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;


class PaypalController extends Controller
{
    public function checkout()
{
    $cart = session()->get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return view('paypal.checkout', compact('total'));
}



    public function success(Request $request)
{
    $cart = session()->get('cart', []);
    $customerEmail = session()->get('customer_email', null);

    if (empty($cart)) {
        return redirect()->route('products.index')->with('error', 'Cart is empty.');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = Order::create([
        'customer_email' => $customerEmail,
        'total' => $total,
    ]);

    foreach ($cart as $productId => $item) {
        // 1. Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'],
            'product_price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);
    
        // 2. Update product stock
        $product = \App\Models\Product::find($productId);
        if ($product) {
            $product->stock = max(0, $product->stock - $item['quantity']);
            $product->save();
        }
    }
    

    // Send confirmation
    if ($customerEmail) {
        Mail::to($customerEmail)->send(new OrderConfirmation($order));
    }

    // Clear cart & email session
    session()->forget('cart');
    session()->forget('customer_email');

    return view('paypal.success');
}

    public function cancel()
    {
        return view('paypal.cancel');
    }

    public function getEmail()
{
    return view('paypal.email');
}

    public function captureEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    session(['customer_email' => $request->email]);

    return redirect()->route('paypal.checkout');
}

}

