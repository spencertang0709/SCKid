<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //We can use model factories or standard db calls
        factory(App\Device::class, 20)->create();
		
		factory(App\Device::class, 10)->make()
            ->each(function($device){
                //Associate a device with a single random kid picked from the kid table
                //Then save it
                $device->kid()->associate(App\Kid::all()->random(1))
                    ->save();
            });
		
		factory(App\Device::class, 'device')->create()
			->each(function($device) {
				$kid = factory(App\Kid::class, 1)->create();
				$device->kid()->associate($kid)->save();
				
				for ($i = 1; $i <= 5; $i++) {
					$contextPolicy = factory(App\ContextPolicy::class, 1)->make();
					$contextPolicy->beacon()->associate(factory(App\Beacon::class, 1)->create());
					$contextPolicy->kid()->associate($kid)->save();	
				}
			});
    }
}
