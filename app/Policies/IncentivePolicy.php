<?php

namespace App\Policies;

use App\Models\Incentive;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class IncentivePolicy
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
        return !$user->incentives->empty() || Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Incentive $incentive)
    {
        return $user->id == $incentive->user_id || Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Incentive $incentive)
    {
        return Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Incentive $incentive)
    {
        return Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Incentive $incentive)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incentive  $incentive
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Incentive $incentive)
    {
        //
    }
}
