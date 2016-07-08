<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Message::class, 100)->make()
            ->each(function($message){
                
                $message->user()->associate(App\User::all()->random(1))
                    ->save();
            });
    }
}
