<?php

use Illuminate\Database\Seeder;

class CallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Make 20 calls then associate these with random kids
        factory(App\Call::class, 20)->make()
            ->each(function($call){

                //Associate an sms with a single random kid picked from the kid table
                //Then save it
                $call->kid()->associate(App\Kid::all()->random(1))
                    ->save();
            });
    }
}
