<?php
namespace Tests\Passport;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Passport\PassportTestCase;

class ExamplePassportTest extends PassportTestCase
{   
    // protected $scopes = ['restricted-scope'];
    
    public function testRestrictedRoute()
    {
        $this->get('/api/v1/getUser')->assertStatus(200);
    }
    
    // public function testUnrestrictedRoute()
    // {
    //     $this->get('/api/restricted')->assertResponseStatus(401);
    // }
}