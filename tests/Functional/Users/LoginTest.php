<?php

namespace Tests\Functional\Users;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testLoginFailure(): void
    {
        $response = $this->post(route('users.login'), [
            'email' => 'email@email.com',
            'password' => 'test',
        ]);

        $response->assertStatus(401);
        $response->assertExactJson([
            'message' => 'Unauthorized',
            'code' => 401
        ]);
    }

    public function testLoginSuccess(): void
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => $password,
        ]);

        $response = $this->post(route('users.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
    }
}
