<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Website\app\Models\Order;

class OrdersController extends Controller
{
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    public function index()
    {
        if (auth('admin')->user()->type == 'admin') {
            $orders = $this->order->paginate(10);
            return view('dashboard::order.orders-list' , compact('orders'));
        }
        $orders = $this->order->where('store_id', auth('admin')->user()->store_id)->paginate(10);
        return view('dashboard::order.orders-list' , compact('orders'));
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
        $order = $this->order->with('items' ,'store', 'user', 'address')->findOrFail($id);

        if(auth('admin')->user()->store_id == $order->store_id || auth('admin')->user()->type == 'admin'){
            return view('dashboard::order.order-detail' , compact('order'));
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
        //
    }


    public function accept($id): RedirectResponse
    {
        $order = $this->order->find($id);
        $order->status = 'accepted';
        $order->save();
        return redirect()->back()->with('success', 'Order accepted successfully');
    }

    public function editStatus($id , $status){
        $order = $this->order->find($id);
        $order->status = $status;
        $order->save();
        return back()->with('success' , 'Status updated successfully');
    }
}
