<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Modules\Dashboard\app\Http\Requests\AdminRequest;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Models\Role;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:read-admins', ['only' => ['index']]);
        $this->middleware('permission:create-admins', ['only' => ['create','store']]);
        $this->middleware('permission:update-admins', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-admins', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins =Admin::where('store_id' , null)->where('id' , '!=' , Auth::guard('admin')->user()->id)
            ->where('type' , 'admin')->paginate(10);
        return view('dashboard::admins.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin= new Admin();
        $roles =Role::select('id', 'name')->get();
        return view('dashboard::admins.create',compact('admin', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make('password');
        $data['type']="admin";
        $data['created_by']= Auth::guard('admin')->user()->name;
        $admin = Admin::create($data);
        return back()->with('success', 'Admin Created Successfully');

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
    public function edit(Admin $admin)
    {
        $roles =Role::select('id', 'name')->get();
        return view('dashboard::admins.create',compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $data = $request->all();
        $data['updated_by']= Auth::guard('admin')->user()->name;
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $admin->update($data);
        return back()->with('success', 'Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return back()->with('success', 'Admin Deleted Successfully');
    }

    public function updateStatus(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->status = $request->status;
        $admin->save();
        return response()->json(['success' => 'Status updated successfully.']);
    }
}
