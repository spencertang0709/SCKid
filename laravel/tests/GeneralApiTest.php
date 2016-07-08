<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneralApiTest extends TestCase
{
    //Use database migrations for testing
//    use DatabaseMigrations;
    
//    public function testGeneralApiResponses()
//    {
//        //Disable JWT
//        $this->withoutMiddleware();
//
//        //seeJsonEquals exact json match
//
//        $this->json('GET', '/api/v1/apps', ['name' => 'Sally'])
//            ->seeJson([
//
//                //Will pass as long as we see created
//                'apps' => true,
//            ]);
//    }

//https://laravel.com/api/5.2/Illuminate/Foundation/Testing/ApplicationTrait.html
    public function testJsonStructures()
    {
        $this->withoutMiddleware();
        
        $this->get('/api/v1/apps')
            ->seeJsonStructure([
                'error',
                'status',
                'apps'
            ]);
    }
}
