<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->id)->first();

        if($finduser) {
            Auth::login($finduser);
        }
        else {
            $referral = Affiliate::where('code', Session::get('affiliate_code'))->first();
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => '',
                'affiliate_id' => $referral?->id
            ]);

            Auth::login($newUser);
        }
        return redirect()->intended(route('dashboard'));
    }
}
