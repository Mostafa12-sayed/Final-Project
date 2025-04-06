<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Dashboard\app\Models\Admin;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
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
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:admins',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $admin = Admin::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);

    //     Auth::guard('admin')->login($admin);

    //     return redirect()->route('admin.dashboard');
    // }
}