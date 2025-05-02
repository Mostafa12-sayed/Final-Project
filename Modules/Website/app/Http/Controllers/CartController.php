<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\app\Models\Coupon;
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

        $discount = 0;
        $couponCode = session('coupon');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && $coupon->is_active && $coupon->expiry_date >= now()) {
                $discount = $coupon->discount; // Assuming discount is a fixed amount
            } else {
                session()->forget('coupon'); // Remove invalid coupon
            }
        }

        $taxRate = 0.10; // 10% tax rate
        $taxes = $subtotal * $taxRate;
        $total = max(0, $subtotal - $discount) + $taxes; // Ensure total doesn’t go negative

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'taxes' => $taxes,
            'total' => $total,
        ];
    }

    public function add(Request $request, Product $product)
    {
        // Existing add method remains unchanged
        $quantity = (int) $request->input('quantity', 1);
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

    public function add_ajax(Request $request, Product $product)
    {
        // Existing add method remains unchanged
        $quantity = (int) $request->input('quantity', 1);
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

        return response()->json([
            'success' => true,
            'cart_count' => count(session('cart', [])), // This is crucial
        ]);
    }

    public function index()
    {
        // Existing index method remains unchanged
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

        $cartItems = collect($cartItems);
        $cartData = $this->getCartData($cart);
        $subtotal = $cartData['subtotal'];
        $discount = $cartData['discount'];
        $taxes = $cartData['taxes'];
        $total = $cartData['total'];

        return view('website::product.cart', compact('cartItems', 'subtotal', 'discount', 'taxes', 'total'));
    }

    public function update(Request $request, $productId): JsonResponse
    {
        // Existing update method, updated to include cartData
        $quantity = (int) $request->input('quantity');
        $cart = session()->get('cart', []);

        $product = Product::find($productId);
        if (! $product || ! isset($cart[$productId])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart'], 404);
        }

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
        // Existing remove method, updated to include cartData
        $cart = session()->get('cart', []);

        if (! isset($cart[$productId])) {
            return response()->json(['success' => false, 'message' => 'Product not found in cart'], 404);
        }

        unset($cart[$productId]);
        session()->put('cart', $cart);
        $cartData = $this->getCartData($cart);

        return response()->json(['success' => true, 'cartData' => $cartData]);
    }

    public function applyCoupon(Request $request)
    {
        if (! Auth::check()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please log in to apply a coupon.'], 401);
            }
            return redirect()->back()->with('error', 'Please log in to apply a coupon.');
        }

        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();

        if (! $coupon) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Invalid coupon code.'], 404);
            }
            return redirect()->back()->with('error', 'Invalid coupon code.');
        }

        if (! $coupon->is_active) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Coupon is not active.'], 400);
            }
            return redirect()->back()->with('error', 'Coupon is not active.');
        }

        if ($coupon->expiry_date < now()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Coupon has expired.'], 400);
            }
            return redirect()->back()->with('error', 'Coupon has expired.');
        }

        $user = Auth::user();
        if ($coupon->users()->where('user_id', $user->id)->exists()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'You have already used this coupon.'], 400);
            }
            return redirect()->back()->with('error', 'You have already used this coupon.');
        }

        $totalUses = $coupon->users()->count();
        if ($totalUses >= $coupon->limit) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Coupon usage limit reached.'], 400);
            }
            return redirect()->back()->with('error', 'Coupon usage limit reached.');
        }

        session()->put('coupon', $coupon->code);

        $cart = session()->get('cart', []);
        $cartData = $this->getCartData($cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully.',
                'cartData' => $cartData
            ]);
        }

        return redirect()->back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('coupon');

        $cart = session()->get('cart', []);
        $cartData = $this->getCartData($cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Coupon removed successfully.',
                'cartData' => $cartData
            ]);
        }

        return redirect()->back()->with('success', 'Coupon removed.');
    }
}
