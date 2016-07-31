<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    public function testNewUserRegistration()
    {
        $this->visit('/register')
            ->type('Taylor', 'name')
            ->type('taylor@gmail.com', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->check('agreeterm')
            ->press('Register')
            ->seePageIs('/home');

        $this->seeInDatabase('users', ['email' => 'taylor@gmail.com']);
        $this->seeInDatabase('users', ['name' => 'Taylor']);
    }

    public function testNewUserLogin()
    {
        $this->visit('/login')
            ->type('taylor@gmail.com', 'email')
            ->type('123456', 'password')
            ->press('Login')
            ->seePageIs('/home');
    }

    /**
     * @group dashboard
     * run this using phpunit --group dashboard
    */
    public function testDashboardPages()
    {
        $this->withoutMiddleware();

        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->withSession(['current_kid' => '1'])
            ->visit('/home')
            ->see($user->name);

        //We may also pass the guard used by authentication
//        $this->actingAs($user,'backend');


        //Left Sidebar

        //Overview
        $this->visit('/home')
            ->seePageIs('/home');
        $this->visit('/kids')
            ->seePageIs('/kids');
        $this->visit('/devices')
            ->seePageIs('/devices');
        $this->visit('/smart_filter')
            ->seePageIs('/smart_filter');
        $this->visit('/stats')
            ->seePageIs('/stats');
        $this->visit('/panics')
            ->seePageIs('/panics');

        //Mobile Control
        $this->visit('/apps')
            ->seePageIs('/apps');
        $this->visit('/calls')
            ->seePageIs('/calls');
        $this->visit('/sms')
            ->seePageIs('/sms');
        $this->visit('/locations')
            ->seePageIs('/locations');
        $this->visit('/time')
            ->seePageIs('/time');

        //Social Media
        $this->visit('/social')
            ->seePageIs('/social');
        $this->visit('/facebook')
            ->seePageIs('/facebook');
        $this->visit('/instagram')
            ->seePageIs('/instagram');
        $this->visit('/twitter')
            ->seePageIs('/twitter');
        $this->visit('/tumblr')
            ->seePageIs('/tumblr');
        
        //Top right dropdown
        $this->visit('/account')
            ->seePageIs('/account');
        $this->visit('/settings')
            ->seePageIs('/settings');
        $this->visit('/messages')
            ->seePageIs('/messages');

    }
}
