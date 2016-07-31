<?php

use Illuminate\Database\Seeder;

class PanicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Panic::class, 20)->make()
            ->each(function($panic){

                //Associate an sms with a single random kid picked from the kid table
                //Then save it
                $panic->kid()->associate(App\Kid::all()->random(1))
                    ->save();
            });
    }
}
