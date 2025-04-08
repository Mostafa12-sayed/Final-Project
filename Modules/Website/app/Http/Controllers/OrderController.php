<?php

namespace Modules\Website\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller

{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('website::order.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'empty cart');
        }

        DB::beginTransaction();
        try {
            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
                'tracking_number' => strtoupper(uniqid('TRK')),
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

            return redirect()->route('order.list')->with('success', 'done');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', ' error occurred');
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
    


    public function track($trackingNumber)
    {
        $order = Order::where('tracking_number', $trackingNumber)->firstOrFail();
        return view('website::order.track', compact('order'));
    }
}
