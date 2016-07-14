<?php

use Illuminate\Database\Seeder;

class BeaconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //We can use model factories or standard db calls
        factory(App\Beacon::class, 5)
            ->create()
            ->each(function($beacon) {
		          $beacon->users()->attach(factory(App\User::class,3)
                  ->create());
        	});
    }
}
