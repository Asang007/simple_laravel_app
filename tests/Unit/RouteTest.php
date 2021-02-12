<?php
namespace Tests\Unit;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testRootURL()
    {
        $this->get('/')->assertStatus(200);
    }

    public function testSignOut()
    {
        $this->get('/signout')->assertStatus(302);
    }

}
