<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\app\Http\Requests\CouponRequest;
use Modules\Dashboard\app\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::where('user_id', auth()->id())->paginate(10);
        return view('dashboard::coupons.coupons' , ['coupons' =>  $coupons ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon();
        return view('dashboard::coupons.form' ,compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->guard('admin')->id();
        Coupon::create($data);
        return back()->with('success', 'Coupon created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard::coupons.form' ,compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $data = $request->all();
        $coupon->update($data);
        return back()->with('success', 'Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Coupon deleted successfully');
    }


    public function updateStatus(Request $request){
        $coupon = Coupon::find($request->id);
        $coupon->is_active = $request->status;
        $coupon->save();
        return response()->json(['success' => 'Status updated successfully.']);
    }
}
