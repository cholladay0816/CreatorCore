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

        $findemailuser = User::where('email', $user->email)->first();

        if($finduser) {
            Auth::login($finduser);
        } elseif($findemailuser) {
            $findemailuser->forceFill([
                'google_id' => $user->id
            ])->save();
            Auth::login($findemailuser);
        } else {
            $referral = Affiliate::where('code', Session::get('affiliate_code'))->first();
            if(User::where('name', $user->name)->exists()) {
                $randomName = $user->name . '-' . random_int(10000, 99999);
            }
            $newUser = User::create([
                'name' => $randomName ?? $user->name,
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
