<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Dashboard\app\Http\Requests\CouponRequest;
use Modules\Dashboard\app\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::where('user_id', auth()->guard('admin')->id())->paginate(10);

        return view('dashboard::coupons.coupons', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon;

        return view('dashboard::coupons.form', compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $data = $request->all();

        // Check if admin is authenticated
        if (!auth()->guard('admin')->check()) {
            return back()->with('error', 'You must be logged in as an admin to create coupons.');
        }

        $adminId = auth()->guard('admin')->id();
        if (!$adminId) {
            return back()->with('error', 'Could not determine admin ID.');
        }

        $data['user_id'] = $adminId;

        // Set default limit if not provided
        if (!isset($data['limit'])) {
            $data['limit'] = 1; // Default limit
        }

        // Convert is_active to boolean if it's a string
        if (isset($data['is_active']) && is_string($data['is_active'])) {
            $data['is_active'] = ($data['is_active'] === '1' || $data['is_active'] === 'true');
        }

        try {
            $coupon = Coupon::create($data);
            if (!$coupon) {
                return back()->with('error', 'Failed to create coupon for unknown reason.');
            }
            return back()->with('success', 'Coupon created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating coupon: ' . $e->getMessage());
        }
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
        return view('dashboard::coupons.form', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $data = $request->all();

        // Set default limit if not provided
        if (!isset($data['limit'])) {
            $data['limit'] = 1; // Default limit
        }

        // Convert is_active to boolean if it's a string
        if (isset($data['is_active']) && is_string($data['is_active'])) {
            $data['is_active'] = ($data['is_active'] === '1' || $data['is_active'] === 'true');
        }

        try {
            $result = $coupon->update($data);
            if (!$result) {
                return back()->with('error', 'Failed to update coupon for unknown reason.');
            }
            return back()->with('success', 'Coupon updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating coupon: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success', 'Coupon deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $coupon = Coupon::find($request->id);
        $coupon->is_active = $request->status;
        $coupon->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }
}
