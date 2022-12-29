<?php

namespace App\Providers;

use App\Models\Ability;
use App\Models\Commission;
use App\Models\Team;
use App\Models\User;
use App\Nova\Role;
use App\Policies\AbilityPolicy;
use App\Policies\CommissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::before(function (User $user, $ability) {
            if ($user->suspended()) {
                return false;
            }
            if ($user->hasAbility($ability)) {
                return true;
            }
        });
        $this->registerPolicies();
    }
}
