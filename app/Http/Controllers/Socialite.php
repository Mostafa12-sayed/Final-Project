<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

use function PHPUnit\Framework\isEmpty;

class Socialite extends Controller
{
    //

    public function google_redirect()
    {
        return FacadesSocialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $user = FacadesSocialite::driver('google')->user();
        // dd($user);
        $olduser = user::where('google_id', $user->id)->first();
        if (! isempty($olduser) && $olduser !== null) {
            Auth::login($olduser);

            return redirect()->route('home');
        } else {
            $newuser = User::updateOrCreate([
                'google_id' => $user->id,
            ], [
                'name' => $user->user['given_name'],
                'last_name' => $user->user['family_name'],
                'google_id' => $user->id,
                'email' => $user->email,
                'password' => null,
                'user_type' => 'customer',
                'email_verified_at' => now(),
            ]);
            if (! $olduser->profile_image) {
                $newuser->profile_image = $user->avatar;
                $newuser->save();
            }
        }

        Auth::login($newuser);

        return redirect()->route('home');
    }



    public function twitter_redirect()
    {
        return FacadesSocialite::driver('twitter')->redirect();
    }

    public function twitter_callback()
    {
        $user = FacadesSocialite::driver('twitter')->user();
        $olduser = user::where('twitter_id,$user->id');
        $first_name = explode(' ', $user->name)[0];
        $last_name = explode(' ', $user->name)[1];

        if (! isEmpty($olduser) && $olduser !== null) {
            Auth::login($olduser);

            return redirect()->route('home');
        } else {
            $newuser = user::updateOrCreate([
                'twitter_id' => $user->id,
            ], [
                'twitter_id' => $user->id,
                'name' => $first_name,
                'last_name' => $last_name,
                'email' => $user->email,
                'profile_image' => $user->avatar,
                'email_verified_at' => now(),
            ]);
        }
        Auth::login($newuser);

        return redirect()->route('home');
    }
}
