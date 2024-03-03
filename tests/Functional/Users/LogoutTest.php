<?php

namespace Tests\Functional\Users;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function testLogoutSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->post(route('users.logout'));
        $response->assertStatus(204);
    }

    public function testLogoutWhenTokenMissing(): void
    {
        $response = $this->post(route('users.logout'));
        $response->assertStatus(401);
        $response->assertExactJson([
            'message' => 'Unauthorized',
            'code' => 401
        ]);
    }

    public function testLogoutWhenInvalidToken(): void
    {
        $response = $this->post(route('users.logout'), headers: ['Authorization' => 'invalidtoken']);
        $response->assertStatus(401);
        $response->assertExactJson([
            'message' => 'Unauthorized',
            'code' => 401
        ]);
    }
}
