<?php

namespace Modules\Dashboard\app\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Dashboard\app\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resource = Auth::guard('admin')->user();

        //        dd($resource);
        return view('dashboard::auth.profile', compact('resource'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::guard('admin')->user();
        $imagePathOld = $user->profile_picture ?? null;

        if ($request->hasFile('image')) {
            $imagePath = FileHelper::uploadImage($request->file('image'), 'admins');
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => (isset($request->phone)) ? $request->phone : $user->phone,
            'address' => (isset($request->address)) ? $request->address : $user->address,
            'profile_picture' => isset($imagePath) ? $imagePath : $user->profile_picture,
        ]);

        $user->save();
        if ($imagePathOld && $imagePathOld != $user->profile_picture) {
            FileHelper::deleteImage($imagePathOld);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        return view('dashboard::auth.change_password');

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);
        $user = Auth::guard('admin')->user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Password changed successfully.');
        } else {
            return response()->json([
                'message' => 'Current password is not correct.',
            ], 400);
        }

    }
}
