<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Auth\Impersonatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;
    use Actionable;
    use Impersonatable;
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
        return $this->hasMany(Commission::class, 'creator_id')
            ->whereIn('status', Commission::statusesCommissions());
    }

    public function incentives()
    {
        return $this->hasMany(Incentive::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function incentive()
    {
        return $this->incentives->sum('amount') - $this->bonuses->sum('amount');
    }
    public function getIncentiveAttribute()
    {
        return $this->incentive();
    }

    public function suspensions()
    {
        return $this->hasMany(Suspension::class);
    }
    public function suspended()
    {
        return $this->suspensions()->where('expires_at', '>', now())->count() > 0;
    }
    public function getSuspendedAttribute()
    {
        return $this->suspended();
    }

    public function suspend(int $days = 7, string $reason = 'No reason provided.')
    {
        Suspension::create([
            'user_id' => $this->id,
            'reason' => $reason,
            'expires_at' => $days > 0 ? now()->addDays($days) : null,
        ]);

        //TODO: send out emails, notifications, and restrict access
    }

    public function strikes()
    {
        return $this->hasMany(Strike::class)->where('created_at', '>', now()->addDays(-7));
    }

    public function addStrike($reason = 'No reason provided.')
    {
        Strike::create(['user_id' => $this->id]);
        //TODO: send out emails, notifications
        //TODO: check for three, then suspend
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function ratings()
    {
        return $this->hasManyThrough(Review::class, Commission::class, 'creator_id', 'commission_id');
    }

    public function rating()
    {
        $ratings = $this->ratings;
        if ($ratings->count() == 0) {
            return null;
        }
        return number_format(floatval($ratings->sum('positive')) / floatval($ratings->count()), 2);
    }
    public function getRatingAttribute()
    {
        return $this->rating();
    }
    public function stars()
    {
        return number_format(($this->rating * 5), 1);
    }
    public function getStarsAttribute()
    {
        return $this->stars();
    }

    public function orders()
    {
        return $this->hasMany(Commission::class, 'buyer_id');
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notification::class);
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

    public function creator()
    {
        return $this->hasOne(Creator::class);
    }
    public function isValidCreator()
    {
        return $this->creator != null;
    }
    public function attachments()
    {
        return $this->hasManyThrough(Attachment::class, Commission::class, 'creator_id', 'user_id');
    }
    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function bytesUsed()
    {
        return $this->attachments->sum('size') + $this->gallery->sum('size');
    }

    public function canAcceptPayments()
    {
        if (config('app.env') == 'testing') {
            return true;
        }
        $account = $this->fetchStripeAccount();
        return (count($account->requirements->currently_due) == 0);
    }

    public function canBeCommissioned(): bool
    {
        return $this->canAcceptPayments()
            && !$this->suspended()
            && $this->creator->open
            && ($this->creator->allows_custom_commissions || $this->creator->user->commissionPresets->count() > 0);
    }

    public function isOnboarded()
    {
        $account = $this->fetchStripeAccount();
        return $account->details_submitted;
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
            $account = \Stripe\Account::retrieve($this->stripe_account_id);
            if (!$account) {
                $account = \Stripe\Account::create([
                        'country' => 'US',
                        'type' => 'express',
                    ]);
            }
            $this->stripe_account_id = $account->id;
            $this->save();
        }
        return $account;
    }

    protected static function boot()
    {
        self::created(function ($user) {
            Creator::create([
                'user_id' => $user->id,
                'open' => false,
                'allows_custom_commissions' => false
            ]);
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

    public function getRecentEarnings(): int
    {
        return $this->getEarlierEarnings();
    }

    public function getEarlierEarnings(int $start = 0, int $end = 30): int
    {
        return Cache::remember(
            'userEarnings_'.$this->id.'_'.$start.'-'.$end,
            now()->diffInSeconds(now()->addDay()),
            function () use ($start, $end) {
                return (
                    (
                        $this->commissions
                            ->where('status', 'Archived')
                            ->where('completed_at', '<', now()->subDays($start))
                            ->where('completed_at', '>', now()->subDays($end))
                            ->sum('price') * 100
                    )
                    +
                    $this->bonuses
                        ->where('created_at', '<', now()->subDays($start))
                        ->where('created_at', '>', now()->subDays($end))
                        ->sum('amount')
                );
            }
        );
    }

    public function earningDifference(): int
    {
        return $this->getRecentEarnings() - $this->getEarlierEarnings(30, 60);
    }

    public function earningIncrease(): bool
    {
        return $this->earningDifference() > 0;
    }

    public function earningChangePercentage(): int
    {
        return Cache::remember(
            'userEarningChangePercentage_'.$this->id,
            now()->diffInSeconds(now()->addDay()),
            function () {
                if ($this->getEarlierEarnings(30, 60) == 0) {
                    return $this->earningIncrease() ? 100 : 0;
                }
                return number_format(abs(($this->earningDifference() / $this->getEarlierEarnings(30, 60)) * 100), 0);
            }
        );
    }
}
