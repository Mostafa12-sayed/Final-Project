<?php

namespace Modules\Website\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Website\app\Models\Order;
use Modules\Website\app\Models\OrderAddress;
use Modules\Website\app\Models\Orderitem;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Stores;
use Modules\Website\app\Models\OrderAddress;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


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
            'payment_method' => 'required|in:cod,paypal',
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

                'payment_status' => $request->payment_method == 'cod' ? 'pending' : 'pending', // Changed 'unpaid' to 'pending'
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

            
            // Handle different payment methods
            if ($request->payment_method == 'cod') {
                session()->forget('cart');
                return redirect()->route('order.complete', $order->id)
                       ->with('success', 'Order placed successfully!');
            } else {
                return $this->processPaypalPayment($order);
            }


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order failed: '.$e->getMessage());

            return back()->withInput()->with('error', 'Order failed: '.$e->getMessage());
        }
    }

    protected function processPaypalPayment(Order $order)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        
        try {
            // Get and set access token
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
    
            // Prepare order data
            $orderData = [
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success', $order),
                    "cancel_url" => route('paypal.cancel', $order),
                    "brand_name" => env('APP_NAME', 'Laravel Store'),
                    "user_action" => "PAY_NOW",
                    "shipping_preference" => "NO_SHIPPING"
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                            "value" => number_format($order->total, 2, '.', ''),
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                                    "value" => number_format($order->total - $order->tax - $order->shipping, 2, '.', '')
                                ],
                                "shipping" => [
                                    "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                                    "value" => number_format($order->shipping, 2, '.', '')
                                ],
                                "tax_total" => [
                                    "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                                    "value" => number_format($order->tax, 2, '.', '')
                                ]
                            ]
                        ],
                        "reference_id" => $order->number,
                        "description" => "Order #".$order->number,
                        "items" => $this->getPaypalOrderItems($order)
                    ]
                ]
            ];
    
            Log::debug('PayPal Order Request:', $orderData);
            $response = $provider->createOrder($orderData);
            Log::debug('PayPal Order Response:', $response);
    
            if (isset($response['id']) && $response['status'] === 'CREATED') {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }
    
            throw new \Exception("No approval link found. Response: ".json_encode($response));
    
        } catch (\Exception $e) {
            Log::error("PayPal Error: ".$e->getMessage()."\n".$e->getTraceAsString());
            return back()->with('error', 'Payment initialization failed: '.$e->getMessage());
        }
    }
    
    private function getPaypalOrderItems(Order $order)
    {
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                "name" => $item->product_name,
                "description" => $item->product_name,
                "sku" => $item->product_id,
                "unit_amount" => [
                    "currency_code" => env('PAYPAL_CURRENCY', 'USD'),
                    "value" => number_format($item->price, 2, '.', '')
                ],
                "quantity" => $item->quantity,
                "category" => "PHYSICAL_GOODS" // or "DIGITAL_GOODS" if applicable
            ];
        }
        return $items;
    }

    public function paypalSuccess(Request $request, Order $order)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        
        try {
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
    
            $response = $provider->capturePaymentOrder($request->token);
            Log::debug('PayPal Capture Response:', $response);
    
            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing',
                    'paid_at' => now()
                ]);
                
                session()->forget('cart');
                return redirect()->route('order.complete', $order)
                       ->with('success', 'Payment completed successfully!');
            }
    
            throw new \Exception("Payment not completed. Status: ".($response['status'] ?? 'unknown'));
    
        } catch (\Exception $e) {
            Log::error("PayPal Capture Error: ".$e->getMessage());
            $order->update(['payment_status' => 'failed']);
            return redirect()->route('order.checkout')
                   ->with('error', 'Payment verification failed: '.$e->getMessage());
        }
    }

    public function paypalCancel(Request $request, Order $order)
    {
        $order->update(['payment_status' => 'failed']);
        return redirect()->route('order.checkout')
            ->with('error', 'You cancelled the PayPal payment.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('website::order.list', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::with([
            'items.product',
        ])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('website::order.details', compact('order'));
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        return view('website::order.complete', compact('order'));
    }

    public function track(Request $request)
    {
        $order = null;

        if ($request->has('order_number')) {
            $order = Order::where('number', $request->order_number)
                ->where('user_id', auth()->id())
                ->first();
        }

        return view('website::order.track', compact('order'));
    }

    public function trackOrder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('website::order.track', compact('order'));
    }

    public function getShippingMethodAttribute()
    {
        return $this->shipping_method ?? 'Standard Shipping';
    }

    public function getExpectedDeliveryDateAttribute()
    {
        if ($this->status === 'completed' && $this->delivered_at) {
            return $this->delivered_at;
        }

        return $this->created_at->addDays(
            $this->shipping_method === 'express' ? 3 : 7
        );
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
            'total' => $total,
        ];
    }
}
