<?php

use Illuminate\Database\Seeder;

class VerificationCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {       
         factory(App\User::class, 5)->create()->each(function($u) {
             $u->verificationCodes()->saveMany(factory(App\VerificationCode::class,2)->make());
         });
     }
}
