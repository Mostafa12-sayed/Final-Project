<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

class Socialite extends Controller
{
    //

    public function google_redirect(){
        return FacadesSocialite::driver('google')->redirect();
    }

    public function google_callback(){
        $user = FacadesSocialite::driver('google')->user();
        // dd($user->user['given_name']);
        $olduser=user::where('google_id',$user->id)->first();
        if($olduser){
            Auth::login($olduser);
            return redirect()->route('home');
        }else{
            $newuser=User::updateOrCreate([
                'google_id'=>$user->id,
            ],[
                'name'=>$user->user['given_name'],
                'last_name'=>$user->user['family_name'],
                'google_id'=>$user->id,
                'email'=>$user->email,
                'password'=>null,
                'user_type'=>'customer',
                'email_verified_at'=>now(),
                'image_url'=>$user->avater
            ]);
        }


        Auth::login($newuser);
        return redirect()->route('home');
    }







    public function facebook_redirect(){
        return FacadesSocialite::driver('facebook')->redirect();
    }
    public function facebook_callback(){
        $user = FacadesSocialite::driver('facebook')->user();
        dd($user);
        return redirect()->route('home');
    }





    
    public function twitter_redirect(){
        return FacadesSocialite::driver('twitter')->redirect();
    }
    public function twitter_callback(){
        $user = FacadesSocialite::driver('twitter')->user();
        // dd($user);
        $user->token;
        return redirect()->route('home');
    }
}
