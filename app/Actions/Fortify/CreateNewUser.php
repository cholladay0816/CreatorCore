<?php

namespace App\Actions\Fortify;

use App\Models\Affiliate;
use App\Models\Team;
use App\Models\User;
use App\Rules\LocationRule;
use App\Rules\ReCaptchaRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        # This is kinda janky, but we're setting this field so that it validates
        $input['location'] = 'LOCATION';

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'recaptcha' => ['required', new ReCaptchaRule()],
            'location' => ['required', new LocationRule()]
        ])->validate();

        return DB::transaction(function () use ($input) {
            $referral = Affiliate::where('code', Session::get('affiliate_code'))->first();
            if(User::where('name', $input['name'])->exists())
            {
                $randomName = $input['name'] . '-' . random_int(10000,99999);
            }
            return tap(User::create([
                'name' => $randomName ?? $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'affiliate_id' => $referral?->id
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
