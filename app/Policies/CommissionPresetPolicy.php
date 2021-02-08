<?php

namespace App\Policies;

use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CommissionPresetPolicy
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
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommissionPreset  $commissionPreset
     * @return mixed
     */
    public function view(User $user, CommissionPreset $commissionPreset)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommissionPreset  $commissionPreset
     * @return mixed
     */
    public function update(User $user, CommissionPreset $commissionPreset)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommissionPreset  $commissionPreset
     * @return mixed
     */
    public function delete(User $user, CommissionPreset $commissionPreset)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommissionPreset  $commissionPreset
     * @return mixed
     */
    public function restore(User $user, CommissionPreset $commissionPreset)
    {
        return Gate::allows('manage-content');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CommissionPreset  $commissionPreset
     * @return mixed
     */
    public function forceDelete(User $user, CommissionPreset $commissionPreset)
    {
        return Gate::allows('manage-content');
    }
}
