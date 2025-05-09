<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Website\app\Models\Order;

class OrdersController extends Controller
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = $this->order->with('items.product', 'user', 'address');
        if ($status) {
            $query->where('admin_status', $status);
        }
        if (auth('admin')->user()->type != 'admin') {
            $query->where('store_id', auth('admin')->user()->store_id);
        }

        $orders = $query->paginate(10);
        return view('dashboard::order.orders-list', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::create');
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
        $order = $this->order->with('items.product', 'store', 'user', 'address')->findOrFail($id);
        //        dd($order);
        if (auth('admin')->user()->store_id == $order->store_id || auth('admin')->user()->type == 'admin') {
            return view('dashboard::order.order-detail', compact('order'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
        $order = $this->order->find($id);
        $order->delete();
        flash()->success('Order deleted successfully.');

        return back();
    }

    public function accept($id): RedirectResponse
    {
        $order = $this->order->find($id);
        $order->status = 'accepted';
        $order->save();

        return redirect()->back()->with('success', 'Order accepted successfully');
    }

    public function editStatus(Request $request)
    {

        $order = $this->order->find($request->order);
        $order->status = $request->status;
        $order->save();
        flash()->success('Order updated successfully.');

        return back();
    }

    public function editStatusAdmin($id, $status)
    {
        $order = $this->order->find($id);
        $order->admin_status = $status;
        $order->save();
        flash()->success('Order updated successfully.');

        return back();
    }

    public function editStatusSeller($id, $status)
    {
        $order = $this->order->find($id);
        $order->admin_status = $status;
        $order->save();
        flash()->success('Order updated successfully.');

        return back();
    }

    public function updatePaymentStatus(Order $order)
    {
        $order->payment_status = request('payment_status');
        $order->save();
        flash()->success('Payment status updated successfully.');

        return back();
    }

    public function updateChangeShippingValue(Order $order)
    {
        $order->shipping = request('shipping_value');
        $order->save();
        flash()->success('Shipping value updated successfully.');

        return back();
    }

    public function invoice(Order $order)
    {
        return view('dashboard::order.invoice', compact('order'));
    }
}
