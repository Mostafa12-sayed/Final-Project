<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Dashboard\app\Http\Requests\AdminRegister;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\Mail\ResetPasswordLink;
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

                return back()->withErrors(['login' => 'Your account is not active. Please contact support.'])->withInput();
            }

            //            return redirect()->intended('/admin/dashboard');
            return to_route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid credentials.'])->withInput();

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
        try {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => 'user',
                'username' => $request->name,
            ]);
            // dd($admin);
            $store = $admin->store()->create([
                'name' => $request->store_name,
                'description' => $request->description,
                'slug' => Str::slug($request->store_name),
                'admin_id' => $admin->id,


            ]);
            $admin->username = 'seller'.$admin->id.$store->id;
            $admin->store_id = $store->id;
            $admin->save();
            DB::commit();

            return redirect()->route('admin.login')->with('success', 'Your Data Send Successfully and after review data we will send email accept or reject store Thanck You !.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admin Registration Error: '.$e->getMessage());

            // dd($e);
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        // Auth::guard('admin')->login($admin);

    }

    public function passwordReset(){
        return view('dashboard::auth.reset-password');
    }
    public function passwordResetLink(Request $request){
        $email = $request->email;
        $admin = Admin::where('email', $email)->first();

        if($admin){
            $token = Str::random(60);
            $admin->update(['verification_token' => $token]);
            \Mail::to($admin->email)->send(new ResetPasswordLink($admin));
            return redirect()->back()->with('success', 'Reset Password Link Send to your Email.');
        }else{
            return redirect()->back()->with('error', 'Email Not Found.')->withInput();
        }
    }
    public function passwordChange(Request $request){
        $token=$request->get('token');
        return view('dashboard::auth.reset-change-password', compact('token'));
    }
    public function passwordChangeStore(Request $request){

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'exists:admins,email', 'max:255'],
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if($admin){
            if($admin->verification_token == $request->token){
                $admin->update(['password' => Hash::make($request->password),'verification_token' => null]);
                return redirect()->route('admin.login')->with('success', 'Password Reset Successfully.');
            }
            else{
                return redirect()->back()->with('error', 'Invalid Token.')->withInput();
            }
        }else{
            return redirect()->back()->with('error', 'Invalid Token.')->withInput();
        }
    }
}
