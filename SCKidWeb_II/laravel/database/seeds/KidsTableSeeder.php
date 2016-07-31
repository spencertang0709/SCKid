<?php

use Illuminate\Database\Seeder;

class KidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //We can use model factories or standard db calls
        factory(App\Kid::class, 20)->create();
        
    }
}
