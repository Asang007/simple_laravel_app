<?php
namespace Tests\Unit;
use Tests\TestCase;
use App\Models\UserRole;

class UserRoleTest extends TestCase
{
    public function testCreateUserRole()
    {
        $user = UserRole::factory()->make();
        $this->assertEquals('Unit Testing', $user->position);
    }

}
