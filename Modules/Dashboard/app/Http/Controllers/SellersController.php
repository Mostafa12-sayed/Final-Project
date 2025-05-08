<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Models\Role;
use Modules\Dashboard\app\Models\Store;
use Modules\Dashboard\Jobs\SendSellerAcceptedEmail;

class SellersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:read-sellers', ['only' => ['index']]);
        $this->middleware('permission:accept-sellers', ['only' => ['accept']]);
        $this->middleware('permission:reject-sellers', ['only' => ['reject']]);
        $this->middleware('permission:delete-sellers', ['only' => ['destroy']]);
        $this->middleware('permission:read-orders-sellers', ['only' => ['sellersOrders']]);

    }

    public function index()
    {
        $sellers = Store::with('admin')->orderBy('created_at', 'desc')
            ->paginate(10);
        $roles = Role::select('id', 'name')->get();

        //        dd($sellers);
        return view('dashboard::sellers.sellers-list', compact('sellers', 'roles'));
    }

    public function sellersOrders()
    {
        $sellers = Admin::with(['store:id,admin_id,name,description'])
            ->select('id', 'name')
            ->where('status', 'pending')
            ->paginate(10);
//        dd($sellers);
        return view('dashboard::sellers.sellers-orders', compact('sellers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::sellers.sellers-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function accept($id)
    {

        $seller = Admin::find($id);
        if ($seller) {
            $seller->status = 'active';
            $seller->store->status = 'active';
            $seller->store->save();
            $seller->save();
            dispatch(new SendSellerAcceptedEmail($seller, 'accepted'));

            flash()->success('Seller accepted successfully.');

            return back();
        }
        flash()->error('Seller not found.');

        return back();
    }

    public function reject($id)
    {

        $seller = Admin::find($id);
        if ($seller) {
            $seller->status = 'inactive';
            $seller->save();
            dispatch(new SendSellerAcceptedEmail($seller, 'rejected'));

            return redirect()->back()->with('success', 'Seller rejected successfully.');
        }

        return redirect()->back()->with('error', 'Seller not found.');
    }

    public function UpdateStatusRole(Request $request, $id)
    {
        $role=null;
        if($request->role_id !=='')
        {
            $role=$request->role_id;
        }

        $seller = Store::where('admin_id', $id)->first();
        $seller->status = $request->status;
        $seller->admin->role_id =$role ;
        $seller->admin->status = $request->status;
        $seller->admin->save();
        if($request->role_id !==''){

            $seller->admin->syncRoles([$request->role_id]);
        }
        $seller->save();

        return response()->json(['success' => 'Status updated successfully.']);

    }
}
