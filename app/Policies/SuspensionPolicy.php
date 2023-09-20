<?php

namespace App\Policies;

use App\Models\Ability;
use App\Models\Suspension;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class SuspensionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suspension  $suspension
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Suspension $suspension)
    {
        return $user->id == $suspension->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        Gate::allows(Ability::$MANAGE_USERS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suspension  $suspension
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Suspension $suspension)
    {
        Gate::allows(Ability::$MANAGE_USERS);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suspension  $suspension
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Suspension $suspension)
    {
        Gate::allows(Ability::$MANAGE_USERS);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suspension  $suspension
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Suspension $suspension)
    {
        Gate::allows(Ability::$MANAGE_USERS);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Suspension  $suspension
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Suspension $suspension)
    {
        Gate::allows(Ability::$MANAGE_USERS);
    }
}
