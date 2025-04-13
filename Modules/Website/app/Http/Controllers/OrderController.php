<?php

namespace Modules\Website\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Website\app\Models\Order;
use Modules\Website\app\Models\OrderItem;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Stores;
use Modules\Website\app\Models\OrderAddress;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
    
        $cartData = $this->getCartData($cart);
        return view('website::order.checkout', compact('cart', 'cartData'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'country' => 'required|string|max:2',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,credit_card,paypal',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $cartData = $this->getCartData($cart);
            
            $store = Stores::first();
        if (!$store) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $store = Stores::create([
                'name' => 'Default Store',
                'slug' => 'default-store',
                'status' => 'active',
                'admin_id' => 1
            ]);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'store_id' => $store->id,
                'total' => $cartData['total'],
                'status' => 'pending',
                'payment_status' => $request->payment_method == 'cod' ? 'pending' : 'paid',
                'number' => 'ORD-' . strtoupper(uniqid()),
                'payment_method' => $request->payment_method,
                'shipping' => 0,
                'tax' => $cartData['taxes'],
                'discount' => $cartData['discount'],
            ]);

            // Add order items
            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $quantity = is_array($item) ? $item['quantity'] : $item;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $product->name,
                    'price' => $product->price - ($product->discount ?? 0),
                    'quantity' => $quantity,
                ]);
            }

            // Add address
            OrderAddress::create([
                'order_id' => $order->id,
                'type' => 'shipping',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'street_addresses' => $request->street_address,
                'country' => $request->country,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'state' => $request->state ?? null,
            ]);

            DB::commit();
            session()->forget('cart');
            
            return redirect()->route('order.complete', $order->id)
                   ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Order failed: ' . $e->getMessage());
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
           $order = Order::findOrFail($id);
           
           if ($order->user_id != Auth::id()) {
               return redirect()->route('home')->with('error', 'Unauthorized access.');
           }
   
           return view('website::order.complete', compact('order'));
       }

        public function show($id)
         {
              $order = Order::findOrFail($id);
              return view('website::order.show', compact('order'));
         }
   
        public function track($trackingNumber)
       {
           $order = Order::where('number', $trackingNumber)->firstOrFail();
           return view('website::order.track', compact('order'));
       }


    private function getCartData($cart)
    {
        $productIds = array_keys($cart); 
        $products = Product::whereIn('id', $productIds)->get(); 
        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = is_array($cart[$product->id]) ? $cart[$product->id]['quantity'] : $cart[$product->id];
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
}