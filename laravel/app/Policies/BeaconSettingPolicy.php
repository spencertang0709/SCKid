<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Beacon;

class BeaconSettingPolicy
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
     * Determine if the given user can delete the beacon.
     *
     * @param  User  $user
     * @param  Beacon $beacon_setting
     * @return bool
     */
    public function destroy(User $user, Beacon $beacon_setting)
    {
        return $user->id == $beacon_setting->user_id;
    }
}
