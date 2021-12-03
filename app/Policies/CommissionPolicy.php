<?php

namespace App\Policies;

use App\Models\Commission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CommissionPolicy
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
     * @param  \App\Models\Commission  $commission
     * @return mixed
     */
    public function view(User $user, Commission $commission)
    {
        return $user->id == $commission->buyer_id || $user->id == $commission->creator_id
            || Gate::allows('manage-orders');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return mixed
     */
    public function update(User $user, Commission $commission)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return mixed
     */
    public function delete(User $user, Commission $commission)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return mixed
     */
    public function restore(User $user, Commission $commission)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return mixed
     */
    public function forceDelete(User $user, Commission $commission)
    {
        return Gate::allows('manage-content');
    }
}
