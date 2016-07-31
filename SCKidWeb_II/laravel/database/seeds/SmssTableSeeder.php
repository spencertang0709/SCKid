<?php

use Illuminate\Database\Seeder;

class SmssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Make 20 messages then associate these with kids
        factory(App\Sms::class, 20)->make()
                ->each(function($sms){

                    //Associate an sms with a single random kid picked from the kid table
                    //Then save it
                    $sms->kid()->associate(App\Kid::all()->random(1))
                        ->save();
        });
    }
}
