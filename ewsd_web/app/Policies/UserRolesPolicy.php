<?php

namespace App\Policies;

use App\User;
use App\UserRoles;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserRoles  $userRoles
     * @return mixed
     */
    public function view(User $user, UserRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserRoles  $userRoles
     * @return mixed
     */
    public function update(User $user, UserRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserRoles  $userRoles
     * @return mixed
     */
    public function delete(User $user, UserRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserRoles  $userRoles
     * @return mixed
     */
    public function restore(User $user, UserRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\UserRoles  $userRoles
     * @return mixed
     */
    public function forceDelete(User $user, UserRoles $userRoles)
    {
        //
    }
}
