<?php

use Illuminate\Database\Seeder;

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
    }
}
