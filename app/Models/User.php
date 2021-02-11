<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Nova\Actions\Actionable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;
    use Actionable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function commissionPresets()
    {
        return $this->hasMany(CommissionPreset::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'creator_id');
    }
    public function orders()
    {
        return $this->hasMany(Commission::class, 'buyer_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function abilities()
    {
        return $this->roles->map->abilities->flatten();
    }
    public function getAbilitiesAttribute()
    {
        return $this->abilities();
    }

    public function hasAbility($slug)
    {
        return $this->abilities->where('slug', $slug)->count() > 0;
    }

    public function fetchStripeAccount()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));
        if (!$this->stripe_account_id) {
            $account = \Stripe\Account::create([
                'country' => 'US',
                'type' => 'express',
            ]);
            $this->stripe_account_id = $account->id;
            $this->save();
        } else {
            try {
                $account = \Stripe\Account::retrieve($this->stripe_account_id);
            } catch (\Exception $exception) {
                $account = \Stripe\Account::create([
                    'country' => 'US',
                    'type' => 'express',
                ]);
                $this->stripe_account_id = $account->id;
                $this->save();
            }
            return $account;
        }
    }

    protected static function boot()
    {
        self::created(function ($user) {
            // $user->createOrGetStripeCustomer();
        });

        self::deleting(function ($user) {
            $stripe = new \Stripe\StripeClient(
                config('stripe.secret')
            );
            if ($user->stripe_id) {
                $stripe->customers->delete($user->stripe_id);
            }
        });


        parent::boot();
    }
}
