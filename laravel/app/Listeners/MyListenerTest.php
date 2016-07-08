<?php

namespace App\Listeners;

use App\Events\MyEventTest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyListenerTest
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MyEventTest  $event
     * @return void
     */
    public function handle(MyEventTest $event)
    {
        //
    }
}
