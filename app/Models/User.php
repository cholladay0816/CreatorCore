<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
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
        'name', 'email', 'password', 'affiliate_id', 'email_verified_at', 'google_id'
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
        'google_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'onboarded_at' => 'datetime'
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

    public static function getExploreCreatorQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return User::with('creator')
                ->join('user_statistics', 'user_id', '=', 'users.id')
                ->where('user_statistics.last_login_at', '>', now()->subMonth())
                ->whereHas('creator', function ($creator) {
                    $creator->where('open', 1)
                        ->whereHas('commissionPresets');
                })
                ->orderBy('user_statistics.last_commission_at', 'ASC')
                ->orderBy('user_statistics.rating', 'DESC')
        ;
    }

    public function commissionPresets(): HasMany
    {
        return $this->hasMany(CommissionPreset::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class, 'creator_id')
            ->whereIn('status', Commission::statusesCommissions());
    }

    public function incentives(): HasMany
    {
        return $this->hasMany(Incentive::class);
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function activeAffiliate(): HasOne|Affiliate
    {
        return $this->hasOne(Affiliate::class)
            ->where('expires_at', '>', now())
            ->where('uses', '>', 0);
    }

    public function getBadges(): array|Collection
    {
        $badges = collect();
        if($this->activeAffiliate()->count()) {
            $badges->push('badges.affiliate');
        }
        return $badges;
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    public function incentive(): int
    {
        return $this->incentives()->sum('amount') - $this->bonuses()->sum('amount');
    }
    public function getIncentiveAttribute(): int
    {
        return $this->incentive();
    }

    public function suspensions(): HasMany
    {
        return $this->hasMany(Suspension::class);
    }
    public function suspended(): bool
    {
        return $this->suspensions()->where('expires_at', '>', now())->count() > 0;
    }
    public function getSuspendedAttribute(): bool
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
        Strike::create(['user_id' => $this->id, 'reason' => $reason]);
        //TODO: send out emails, notifications
        //TODO: check for three, then suspend
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function ratings(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Commission::class, 'creator_id', 'commission_id');
    }

    public function rating(): string|null
    {
        $ratings = $this->ratings();
        if ($ratings->count() == 0) {
            return null;
        }
        return number_format(floatval($ratings->sum('positive')) / floatval($ratings->count()), 2);
    }
    public function getRatingAttribute(): string|null
    {
        return $this->rating();
    }
    public function stars(): string|null
    {
        if(is_null($this->rating())) {
            return null;
        }
        return number_format(($this->rating * 5), 1);
    }
    public function getStarsAttribute(): string|null
    {
        return $this->stars();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Commission::class, 'buyer_id');
    }
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
    public function getLastUnreadNotification(): HasMany|Notification|null
    {
        return $this->notifications()->whereNull('read_at')->orderByDesc('created_at')->first();
    }
    public function abilities()
    {
        return $this->roles->map->abilities->flatten();
    }
    public function getAbilitiesAttribute()
    {
        return $this->abilities();
    }

    public function hasAbility($slug): bool
    {
        return $this->abilities->where('slug', $slug)->count() > 0;
    }

    public function creator(): HasOne
    {
        return $this->hasOne(Creator::class);
    }
    public function isValidCreator(): bool
    {
        return $this->creator != null;
    }
    public function attachments(): HasManyThrough
    {
        return $this->hasManyThrough(Attachment::class, Commission::class, 'creator_id', 'user_id');
    }
    public function banner(): HasOne
    {
        return $this->hasOne(Banner::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function bytesUsed(): int
    {
        return $this->attachments->sum('size') + $this->gallery->sum('size');
    }

    public function canAcceptPayments(): bool
    {
        if (config('app.env') == 'testing' || env('APP_ENV') == 'testing') {
            return true;
        }
        $account = $this->fetchStripeAccount();
        return (count($account->requirements->currently_due) == 0);
    }

    public function canBeCommissioned(bool $requireCommission = true): bool
    {
        return $this->canAcceptPayments()
            && !$this->suspended()
            && $this->creator->open
            && ($this->creator->allows_custom_commissions || (!$requireCommission || $this->creator->user->commissionPresets->count() > 0));
    }

    public function isOnboarded(): bool
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

    public function userStatistic(): HasOne
    {
        return $this->hasOne(UserStatistic::class);
    }

    protected static function boot()
    {
        self::created(function ($user) {
            Creator::create([
                'user_id' => $user->id,
                'open' => false,
                'allows_custom_commissions' => false
            ]);

            UserStatistic::firstOrCreate(['user_id' => $user->id], ['last_login_at' => now()]);
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

    public function passwordSet(): bool
    {
        return !(empty($this->password));
    }
}
