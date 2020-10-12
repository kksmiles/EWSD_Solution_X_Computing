<?php

namespace App\Policies;

use App\MagazineIssue;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MagazineIssuesPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\MagazineIssue  $magazineIssue
     * @return mixed
     */
    public function view(User $user,MagazineIssue $magazineIssue)
    {   
        return $user->id == $magazineIssue->staff_id;
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
     * @param  \App\MagazineIssue  $magazineIssue
     * @return mixed
     */
    public function update(User $user, MagazineIssue $magazineIssue)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\MagazineIssue  $magazineIssue
     * @return mixed
     */
    public function delete(User $user, MagazineIssue $magazineIssue)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\MagazineIssue  $magazineIssue
     * @return mixed
     */
    public function restore(User $user, MagazineIssue $magazineIssue)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\MagazineIssue  $magazineIssue
     * @return mixed
     */
    public function forceDelete(User $user, MagazineIssue $magazineIssue)
    {
        //
    }
    public function viewStaffIssues($user_id, $magazine_issue_id) {
        return $user_id == $magazine_issue_id;
    }
}
