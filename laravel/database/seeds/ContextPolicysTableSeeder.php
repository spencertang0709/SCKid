d<?php

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
                $contextPolicy->beacon()->associate(App\Beacon::all()->random(1));
				$contextPolicy->kid()->associate(App\Kid::all()->random(1));
                $contextPolicy->save();
            });
    }
}
