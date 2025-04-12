<?php

namespace Modules\Website\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Website\app\Models\OrderItem;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Stores;
use Modules\Website\app\Models\Category;
use Modules\Website\app\Models\Wishlist;
use Modules\Website\app\Models\Cart;

class OrderController extends Controller

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
        $taxRate = 0.10;  
        $taxes = $subtotal * $taxRate;  
        $total = $subtotal - $discount + $taxes;  
    
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'taxes' => $taxes,
            'total' => $total
        ];
    }
    
    
    
    

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
    
        $cartData = $this->getCartData($cart);
    
        if (!is_array($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Invalid cart data.');
        }
    
        return view('website::order.checkout', compact('cart', 'cartData'));
    }
    


public function store(Request $request)
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty!');
    }

    DB::beginTransaction();
    try {
        $cartData = $this->getCartData($cart);  

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $cartData['total'],  
            'status' => 'pending',
            'tracking_number' => strtoupper(uniqid('TRK')),
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'], 
                'price' => $item['price'], 
            ]);
        }

        DB::commit();
        session()->forget('cart'); 

        return redirect()->route('order.complete', ['id' => $order->id]);
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'An error occurred, please try again.');
    }
}




    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('website::order.list', compact('orders'));
    }
    
    public function details()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('items.product') 
                       ->latest()
                       ->get();
        
        return view('website::order.details', compact('orders'));
    }
    

    public function complete($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('website::order.complete', compact('order'));
    }
    
    public function track($trackingNumber)
    {
        $order = Order::where('tracking_number', $trackingNumber)->firstOrFail();
        return view('website::order.track', compact('order'));
    }
}
