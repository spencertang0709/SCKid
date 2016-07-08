<?php

namespace App\Repository;

use App\User;


//This class is for dependency injection using a service container
class KidRepository
{
    /**
     * Get all of the kids for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->kids()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}