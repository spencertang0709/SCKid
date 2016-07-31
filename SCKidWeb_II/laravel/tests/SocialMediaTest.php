<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialMediaTest extends TestCase
{
    public function testFacebook()
    {
        $this->visit('/facebook')
            ->press('Add')
            ->seePageIs('/facebook')
            ->seeInDatabase('socialmedia','user');
    }

    public function testTwitter()
    {
        $this->visit('/twitter')
            ->press('Add')
            ->seePageIs('/twitter')
            ->seeInDatabase('socialmedia','user');
    }

    public function testInstagram()
    {
        $this->visit('/instagram')
            ->press('Add')
            ->seePageIs('/instagram')
            ->seeInDatabase('socialmedia','user');
    }
}
