<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Http\Requests\AdminRegister;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('dashboard::auth.login');
    }

    public function showRegisterForm()
    {

        return view('dashboard::auth.register');
    }


    public function login(Request $request)
    {
        // dd(Admin::all());
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $admin = Auth::guard('admin')->user();
            if ($admin->status === 'pending' || $admin->status === 'inactive') {
                Auth::guard('admin')->logout();
                return back()->withErrors(['login' => 'Your account is not active. Please contact support.']);
            }

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);

    }

    public function logout()
    {
        // dd('logout');
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function register()
    {
        return view('dashboard::auth.register');
    }
    public function store(AdminRegister $request)
    {
        DB::beginTransaction();
      try{
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        // dd($admin);
          $store =$admin->stores()->create([
            'name' => $request->store_name,
            'description' => $request->description,
            'slug' => Str::slug($request->store_name),

        ]);
          $admin->username = 'seller' . $admin->id . $store->id;
          $admin->save();
          DB::commit();

        return redirect()->route('admin.login')->with('success', 'Your Data Send Successfully and after review data we will send email accept or reject store Thanck You !.');
        }catch(\Exception $e){
            DB::rollBack();
            \Log::error('Admin Registration Error: ' . $e->getMessage());
            // dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }


        // Auth::guard('admin')->login($admin);


    }
}
