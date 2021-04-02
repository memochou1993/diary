<?php

namespace App\Policies;

use App\Models\Statement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatementPolicy
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
     * @param  \App\Models\Statement  $statement
     * @return mixed
     */
    public function view(User $user, Statement $statement)
    {
        return $user->id === $statement->user_id;
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
     * @param  \App\Models\Statement  $statement
     * @return mixed
     */
    public function update(User $user, Statement $statement)
    {
        return $user->id === $statement->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Statement  $statement
     * @return mixed
     */
    public function delete(User $user, Statement $statement)
    {
        return $user->id === $statement->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Statement  $statement
     * @return mixed
     */
    public function restore(User $user, Statement $statement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Statement  $statement
     * @return mixed
     */
    public function forceDelete(User $user, Statement $statement)
    {
        //
    }
}
