<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WelcomeTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->visit('/')
            ->click('Log In')
            ->seePageIs('/login');

        $this->visit('/')
            ->click('Sign Up')
            ->seePageIs('/register');
    }


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testKnowledgeBase()
    {
        $this->visit('/knowledge/categories')
            ->click('Log In')
            ->seePageIs('/login');

        $this->visit('/')
            ->click('Sign Up')
            ->seePageIs('/register');
    }


}
