<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Website\app\Models\Product;

class CartController extends Controller
{
    private function getCartData($cart)
    {
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();
        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $finalPrice = $product->price - ($product->discount ?? 0);
            $subtotal += $finalPrice * $quantity;
        }

        $discount = 0; // Placeholder for future discount logic
        $taxRate = 0.10; // 10% tax rate
        $taxes = $subtotal * $taxRate;
        $total = $subtotal - $discount + $taxes;

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'taxes' => $taxes,
            'total' => $total
        ];
    }

    public function add(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1); // Ensure quantity is an integer
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id] + $quantity;
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }
            $cart[$product->id] = $newQuantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        $cartItems = [];
        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $finalPrice = $product->price - ($product->discount ?? 0);
            $itemTotal = $finalPrice * $quantity;
            $subtotal += $itemTotal;
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'finalPrice' => $finalPrice,
                'itemTotal' => $itemTotal,
            ];
        }

        $cartItems = collect($cartItems); // Convert to collection for Blade
        $discount = 0; // Placeholder for future discount logic
        $taxRate = 0.10; // 10% tax rate
        $taxes = $subtotal * $taxRate;
        $total = $subtotal - $discount + $taxes;

        return view('website::product.cart', compact('cartItems', 'subtotal', 'discount', 'taxes', 'total'));
    }

    public function update(Request $request, $productId): JsonResponse
    {
        $quantity = (int) $request->input('quantity'); // Ensure quantity is an integer
        $cart = session()->get('cart', []);

        // Check if the product exists and is in the cart
        $product = Product::find($productId);
        if (!$product || !isset($cart[$productId])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart'], 404);
        }

        // Validate stock
        if ($quantity > $product->stock) {
            return response()->json(['success' => false, 'message' => 'Not enough stock available'], 400);
        }

        if ($quantity > 0) {
            $cart[$productId] = $quantity;
        } else {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);
        $cartData = $this->getCartData($cart);
        return response()->json(['success' => true, 'cartData' => $cartData]);
    }

    public function remove($productId): JsonResponse
    {
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (!isset($cart[$productId])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart'], 404);
        }

        unset($cart[$productId]);
        session()->put('cart', $cart);
        $cartData = $this->getCartData($cart);
        return response()->json(['success' => true, 'cartData' => $cartData]);
    }
}
