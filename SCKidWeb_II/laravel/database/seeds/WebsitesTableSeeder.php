<?php

use Illuminate\Database\Seeder;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //We can use model factories or standard db calls
        factory(App\Website::class, 20)->create();
		
		factory(App\Website::class, 10)->create()
        	->each(function($website) {
        		$website->kids()->attach(App\Kid::all()->random(1));
        	});	
		
    }
}
