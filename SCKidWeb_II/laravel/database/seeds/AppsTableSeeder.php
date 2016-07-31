<?php

use Illuminate\Database\Seeder;

class AppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //We can use model factories or standard db calls
        factory(App\App::class, 100)->create();
		
		/*
		factory(App\App::class, 10)->create()
        	->each(function($app) {
        		$app->kids()->attach(App\Kid::all()->random(1));
        	});
		*/	
    }
}
