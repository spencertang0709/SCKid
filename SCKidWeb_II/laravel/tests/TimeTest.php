<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TimeTest extends TestCase
{

    //Wrap everything in a transaction then rollback
    use DatabaseTransactions;

    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTimeRestrictions()
    {
        $this->withoutMiddleware();

        $this->visit('/time')
            ->select('10:00','Monday1')
            ->select('10:00','Tuesday1')
            ->select('10:00','Wednesday1')
            ->select('10:00','Thursday1')
            ->select('10:00','Friday1')
            ->select('10:00','Saturday1')
            ->select('10:00','Sunday1')
            ->press('save')
            ->seePageIs('/time');
    }
}
