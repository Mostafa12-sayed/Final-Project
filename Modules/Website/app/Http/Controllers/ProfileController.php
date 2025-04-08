<?php

namespace Modules\Website\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Website\app\Models\Addresses;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user());
        $user = user::find(Auth::id());
        $address=$user->addresses;
        // dd($address);
        return view('website::profile.profile',compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website::create');
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
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
    $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'last_name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($id)],
    'phone' => ['required', 'string', 'max:15'],
    'street' => ['required', 'string', 'max:255'],
    'city' => ['required', 'string', 'max:255'],
    'zip_code' => ['required', 'string', 'max:10'],
    ]);
    $user = User::find($id);
    $user->name = $request->name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();
    $address=Addresses::where('user_id',$user->id)->first();
    if (!$address) {
        $address = new Addresses();
        $address->user_id = $user->id;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->zip_code = $request->zip_code;
        $address->save();
    }else {
        $address = Addresses::where('user_id',$user->id)->first();
        $address->street = $request->street;
        $address->city = $request->city;
        $address->zip_code = $request->zip_code;
        $address->save();
    }

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
}
    public function update_password(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8', 'current_password'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_new_password' => ['required', 'string', 'same:new_password'],
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
    }
    public function update_image(Request $request, $id)
    {
        $request->validate([
        'profile_image' => ['image','mimes:png,jpg,jpeg','max:2048','nullable']
        ]);
        $user=user::find($id);

        $directory = public_path('assets/img/account/');
        $photoname='profile_'.time().'.'.$request->profile_image->extension();

        if ($user->profile_image && file_exists($directory.'/'.$user->profile_image)) {
            unlink($directory.'/'.$user->profile_image);
        }

        $request->profile_image->move($directory,$photoname);
        $user->profile_image=$photoname;
        $user->save();
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'photo_url' => asset('assets/img/account/'.$photoname),
                'message' => 'Profile image updated successfully.'
            ]);
        }
        
        return redirect()->route('profile.index')->with('success', 'Profile image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

}
