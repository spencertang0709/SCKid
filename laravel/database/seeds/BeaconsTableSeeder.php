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
        factory(App\Beacon::class, 20)->create()
        	->each(function($beacon) {
        		$beacon->kids()->attach(App\Kid::all()->random(1));
        	});		
    }
}
