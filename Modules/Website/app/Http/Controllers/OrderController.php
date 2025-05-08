<?php

namespace Modules\Website\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Website\app\Models\Order;
use Modules\Website\app\Models\Orderitem;
use Modules\Website\app\Models\Product;
use Modules\Website\app\Models\Stores;
use Modules\Website\app\Models\OrderAddress;
use Modules\Dashboard\app\Models\Coupon;
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

    return view('website::order.checkout', [
        'cart' => $cart,
        'subtotal' => $cartData['subtotal'],
        'discount' => $cartData['discount'],
        'taxes' => $cartData['taxes'],
        'total' => $cartData['total'],
        'coupon_code' => $cartData['coupon_code'] ?? null
    ]);
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
                'subtotal' => $cartData['subtotal'], 
                'total' => $cartData['total'],
                'status' => 'pending',
                'payment_status' => $request->payment_method == 'cod' ? 'pending' : 'pending',
                'number' => 'ORD-' . strtoupper(uniqid()),
                'payment_method' => $request->payment_method,
                'shipping' => 0, 
                'taxes' => $cartData['taxes'],
                'discount' => $cartData['discount']
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
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
    
            $items = [];
            $itemTotal = 0;
            
            foreach ($order->items as $item) {
                $itemValue = round($item->price * $item->quantity, 2);
                $itemTotal += $itemValue;
                
                $items[] = [
                    "name" => substr($item->product_name, 0, 127),
                    "description" => substr($item->product_name, 0, 127),
                    "unit_amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($item->price, 2, '.', '')
                    ],
                    "quantity" => (string)$item->quantity,
                    "category" => "PHYSICAL_GOODS",
                    "sku" => "prod_".$item->product_id 
                ];
            }
    

            $shipping = round($order->shipping, 2);
            $discount = round($order->discount, 2);
            $itemTotal = round($itemTotal, 2);
            $taxableAmount = max(0, $itemTotal - $discount);
            $tax = round($taxableAmount * 0.10, 2);
            $total = round($taxableAmount + $tax + $shipping, 2);
    
            // Compliance requirements
            $orderData = [
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success', $order),
                    "cancel_url" => route('paypal.cancel', $order),
                    "brand_name" => env('APP_NAME', 'My Store'),
                    "user_action" => "PAY_NOW",
                    "shipping_preference" => "SET_PROVIDED_ADDRESS",
                    "landing_page" => "BILLING",
                    "locale" => "en-US",
                    "payment_method" => [
                        "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"
                    ]
                ],
                "purchase_units" => [
                    [
                        "reference_id" => $order->number,
                        "description" => "Purchase from ".env('APP_NAME', 'My Store'),
                        "custom_id" => "ORDER_".$order->id,
                        "invoice_id" => "INV_".$order->number,
                        "soft_descriptor" => substr(env('APP_NAME', 'MyStore'), 0, 22),
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($total, 2, '.', ''),
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => "USD",
                                    "value" => number_format($itemTotal, 2, '.', '')
                                ],
                                "shipping" => [
                                    "currency_code" => "USD",
                                    "value" => number_format($shipping, 2, '.', '')
                                ],
                                "tax_total" => [
                                    "currency_code" => "USD",
                                    "value" => number_format($tax, 2, '.', '')
                                ],
                                "discount" => [
                                    "currency_code" => "USD",
                                    "value" => number_format($discount, 2, '.', '')
                                ]
                            ]
                        ],
                        "items" => $items,
                        "shipping" => [
                            "name" => [
                                "full_name" => $order->address->first_name.' '.$order->address->last_name
                            ],
                            "address" => [
                                "address_line_1" => $order->address->street_address,
                                "admin_area_2" => $order->address->city,
                                "admin_area_1" => $order->address->state,
                                "postal_code" => $order->address->postal_code,
                                "country_code" => $order->address->country
                            ]
                        ]
                    ]
                ]
            ];
    
            Log::debug('PayPal Order Request', $orderData);
    
            $response = $provider->createOrder($orderData);
            
            if (!isset($response['id'])) {
                throw new \Exception("PayPal response error: ".json_encode($response));
            }
    
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
    
            throw new \Exception("No approval link in PayPal response");
    
        } catch (\Exception $e) {
            Log::error("PAYPAL ERROR: ".$e->getMessage());
            Log::error("Stack trace: ".$e->getTraceAsString());
            
            return back()
                ->with('error', 'Payment processing failed. Please try again or contact support.')
                ->withInput();
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
                "category" => "PHYSICAL_GOODS" 
            ];
        }
        return $items;
    }

    public function paypalSuccess(Request $request, Order $order)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        
        try {
            // 1. Get access token
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
            
            // 2. Capture the approved payment
            $response = $provider->capturePaymentOrder($request->token);
            Log::debug('PayPal Capture Response', $response);
    
            // 3. Verify capture was successful
            if (!isset($response['status']) || $response['status'] !== 'COMPLETED') {
                throw new \Exception("PayPal capture failed: ".json_encode($response));
            }
    
            // 4. Handle different status cases
            switch ($response['status']) {
                case 'COMPLETED':
                    // Verify amounts strictly
                    $capturedAmount = (float)($response['purchase_units'][0]['payments']['captures'][0]['amount']['value'] ?? 0);
                    if (abs($capturedAmount - $order->total) > 0.01) {
                        throw new \Exception(sprintf(
                            "Amount mismatch! Captured: %.2f vs Order: %.2f",
                            $capturedAmount,
                            $order->total
                        ));
                    }
                    
                    // Update order status
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                        'transaction_id' => $response['id'],
                        'payer_id' => $response['payer']['payer_id'] ?? null,
                        'payment_source' => $response['payment_source']['paypal']['email_address'] ?? null,
                        'paid_at' => now(),
                        'paypal_response' => json_encode($response)
                    ]);
                    
                    session()->forget('cart');
                    return redirect()->route('order.complete', $order)
                           ->with('success', 'Payment completed successfully!');
                    
                case 'PENDING':
                    $order->update([
                        'payment_status' => 'pending',
                        'transaction_id' => $response['id']
                    ]);
                    return redirect()->route('order.complete', $order)
                           ->with('warning', 'Payment is pending approval');
                    
                default:
                    throw new \Exception("Unexpected payment status: ".$response['status']);
            }
    
        } catch (\Exception $e) {
            Log::error("PayPal Capture Error: " . $e->getMessage());
            Log::error("Full Response: " . json_encode($response ?? []));
            
            $order->update([
                'payment_status' => 'failed',
                'failure_reason' => substr($e->getMessage(), 0, 255)
            ]);
            
            return redirect()->route('order.checkout')
                   ->with('error', 'Payment failed: '.$e->getMessage());
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
        $subtotal = round($subtotal, 2);
    
        // Handle coupon discount
        $discount = 0;
        $couponCode = session('coupon');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && $coupon->is_active && $coupon->expiry_date >= now()) {
                $discount = min($coupon->discount, $subtotal);
            } else {
                session()->forget('coupon');
            }
        }
        $discount = round($discount, 2);
    
        // Calculate taxes properly (10% of taxable amount)
        $taxableAmount = max(0, $subtotal - $discount);
        $taxes = round($taxableAmount * 0.10, 2);
        
        // Calculate final total
        $total = round($taxableAmount + $taxes, 2);
    
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'taxes' => $taxes,
            'total' => $total,
            'coupon_code' => $couponCode
        ];
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
}