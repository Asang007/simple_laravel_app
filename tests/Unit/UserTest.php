<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $user = User::factory()->make();
        $this->assertEquals('Unit Testing', $user->name);
    }

}
