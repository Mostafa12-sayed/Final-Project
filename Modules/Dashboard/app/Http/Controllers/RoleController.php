<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\app\Models\Role;
use Modules\Dashboard\app\Models\Permission;
use Modules\Dashboard\app\Http\Requests\StoreRoleRequest;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
        $this->middleware('auth:admin');
         $this->middleware('permission:read-roles')->only('index');
         $this->middleware('permission:create-roles')->only(['create', 'store']);
         $this->middleware('permission:update-roles')->only(['edit', 'update']);
         $this->middleware('permission:delete-roles')->only('destroy');
    }

    public function index()
    {
        // $this->setSessionDelete();
        return view('dashboard::roles.role-list', [
            'data' => $this->model->paginate(20),
        ]);
    }


    public function create()
    {
        return view('dashboard::roles.role-add', [
            'resource' => $this->model,
            'permissions' => Permission::get()->groupBy('path'),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $inputs = $request->validated();
        // dd($inputs['role_status']);


        try {
            DB::beginTransaction();
            $resource = Role::create([
                'name'          =>  $inputs['name'],
                'display_name'  => $inputs['display_name'],
                'description'   => $inputs['description'],
                'role_status'   => $inputs['role_status']
            ]);
            // dd($resource);
            $resource->syncPermissions($inputs['permissions']);
            DB::commit();

            flash()->success('Role Created Successfully');

            return redirect()->back();
        } catch (\Exception $th) {
            // toast(__('admin.stored'),'success','top-right')->hideCloseButton();
            // alert()->error('', $th->getMessage());
            flash()->error( "thiserr".$th->getMessage());

            return back();
        }
    }

    public function edit($id)
    {
        $resource = $this->model->findOrFail($id);
        return view('dashboard::roles.role-add', [
            'permissions' => Permission::get()->groupBy('path'),
            'resource' => $resource,
            'rolePermissions' => $resource->permissions->pluck('id')->all(),
        ]);
    }

    public function update(StoreRoleRequest $request, $id)
    {
        $inputs = $request->validated();

        try {
            $resource = $this->model->findOrFail($id);
            $resource->update([
                'name'  => $inputs['name'],
                'display_name'  => $inputs['display_name'],
                'description'  => $inputs['description'],
                'role_status' =>$inputs['role_status'],
            ]);
            $resource->syncPermissions($inputs['permissions']);
            flash()->success('Role Updated Successfully');

            return redirect()->back();
        } catch (\Exception $th) {
            flash()->error('error'.$th->getMessage());

            return back();
        }
    }


    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        flash()->success('Role Deleted Successfully');

        return back();
    }


    public function updateStatus(Request $request)
    {
            $role = Role::findOrFail($request->id);
            $role->role_status = $request->status;
            $role->save();

        return response()->json(['success' => true]);
    }
}
