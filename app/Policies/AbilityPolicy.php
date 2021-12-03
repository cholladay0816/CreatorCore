<?php

namespace App\Policies;

use App\Models\Ability;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class AbilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * @return mixed
     */
    public function view(User $user, Ability $ability)
    {
        return Gate::allows('manage-admins');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Gate::allows('manage-admins');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * @return mixed
     */
    public function update(User $user, Ability $ability)
    {
        return Gate::allows('manage-admins');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * @return mixed
     */
    public function delete(User $user, Ability $ability)
    {
        return Gate::allows('manage-admins');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * @return mixed
     */
    public function restore(User $user, Ability $ability)
    {
        return Gate::allows('manage-admins');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ability  $ability
     * @return mixed
     */
    public function forceDelete(User $user, Ability $ability)
    {
        return Gate::allows('manage-admins');
    }
}
