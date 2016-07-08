<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

//These needed to be added to fix auth issues
use App\Kid;
use App\Policies\KidPolicy;


class AuthServiceProvider extends ServiceProvider
{


    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',

        //Adding in new policy to protect other users from deleting any data that arent' their own
        'App\Kid' => 'App\Policies\KidPolicy',
		'App\Beacon' => 'App\Policies\BeaconSettingPolicy',
		
        /*
		 * Alternatively: 
		 * (ModelName)::class => (PolicyName)::class
		 */
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
