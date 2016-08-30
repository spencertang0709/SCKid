<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //We can use model factories or standard db calls
        factory(App\Location::class, 200)->make()
                ->each(function($location){

                    //Associate an sms with a single random kid picked from the kid table
                    //Then save it
                    $location->kid()->associate(App\Kid::all()->random(1))
                        ->save();
				});
    }
}
