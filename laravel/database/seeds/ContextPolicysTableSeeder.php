<?php

use Illuminate\Database\Seeder;

class ContextPolicysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ContextPolicy::class, 20)->make()
            ->each(function($contextPolicy){

                //Associate an sms with a single random kid picked from the kid table
                //Then save it
                $contextPolicy->beacon()->associate(App\Beacon::all()->random(1))
                    ->save();
            });
    }
}
