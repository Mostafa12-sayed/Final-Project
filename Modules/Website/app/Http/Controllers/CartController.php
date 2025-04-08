<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website::index');
    }
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is in stock
        if ($product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.'
            ]);
        }

        // Get or create cart session
        $cartItems = Session::get('cart', []);

        // Check if product already in cart
        if (isset($cartItems[$request->product_id])) {
            // Update quantity
            $cartItems[$request->product_id]['quantity'] += $request->quantity;
        } else {
            // Add new item
            $cartItems[$request->product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount ? $product->price - $product->discount : $product->price,
                'quantity' => $request->quantity,
                'image' => !empty($product->gallery) ? $product->gallery[0] : 'assets/img/product/01.png'
            ];
        }

        // Save cart to session
        Session::put('cart', $cartItems);

        // Calculate cart count
        $cartCount = 0;
        foreach ($cartItems as $item) {
            $cartCount += $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
