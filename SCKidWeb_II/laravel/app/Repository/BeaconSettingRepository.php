<?php

namespace App\Repository;

use App\User;


//This class is for dependency injection using a service container
class BeaconSettingRepository
{
    /**
     * Get all of the beacon settings for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->beacon_settings()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}