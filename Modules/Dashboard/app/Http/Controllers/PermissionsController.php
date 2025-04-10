<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\app\Http\Requests\PermissionRequest;
use Modules\Dashboard\app\Models\Permission;


class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);

        return view('dashboard::permissions.permissions', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard::permissions.form', ['permission' => new Permission()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());
        flash()->success('Permission created successfully!');
        return back();
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
    public function edit(Permission $permission)
    {
        return view('dashboard::permissions.form', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        flash()->success('Permission updated successfully!');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        flash()->success('Permission deleted successfully!');
        return back();

    }
}
