<?php

namespace App\Policies;

use App\Models\Bonus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class BonusPolicy
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
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bonus $bonus)
    {
        return $user->id == $bonus->user_id || Gate::allows('manage-financials');
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
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bonus $bonus)
    {
        return Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bonus $bonus)
    {
        return Gate::allows('manage-financials');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bonus $bonus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bonus $bonus)
    {
        //
    }
}
