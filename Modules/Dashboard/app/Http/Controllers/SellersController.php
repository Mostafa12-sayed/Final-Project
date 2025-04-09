<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Models\Store;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Store::with('admin')
        ->paginate(1);
     
        return view('dashboard::sellers.sellers-list' ,compact('sellers'));
    }


    public function sellersOrders()
    {
        $sellers = Admin::with(['stores:id,admin_id,name,description'])
        ->select('id', 'name')
        ->where('status', 'pending')
        ->paginate(1);
  
    return view('dashboard::sellers.sellers-orders' , compact('sellers'));
    

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
    public function store(Request $request): RedirectResponse
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


    public function accept($id)
    {
        
    
        $seller = Admin::find($id);
        if ($seller) {
            $seller->status = 'active';
            $seller->save();
            flash()->success('Seller accepted successfully.');
            return back();
        }
        flash()->error('Seller not found.');

        return back();
    }
    public function reject(Request $request)
    {
        $sellerId = $request->input('id');
        $seller = Admin::find($sellerId);
        if ($seller) {
            $seller->status = 'inactive';
            $seller->save();
            return redirect()->back()->with('success', 'Seller rejected successfully.');
        }
        return redirect()->back()->with('error', 'Seller not found.');
    }
}
