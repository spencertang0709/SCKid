<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class,6)
        ->create()
        ->each(function($category){
        $category->titles()->saveMany(factory(App\Title::class,3)->create());
      });
    }
}
