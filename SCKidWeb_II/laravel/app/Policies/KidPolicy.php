<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Kid;

//This is the policy for managing children so only the user who is logged in can manage their own children
class KidPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if the given user can delete the given kid.
     * @param User $user
     * @param Kid $kid
     * @return bool
     */
    public function destroy(User $user, Kid $kid)
    {
        return $kid->users()->findOrFail($user->id);
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    //TODO authorisations
//    public function show(User $user, $object){
//        return $user->id == $object->id;
//    }
}
