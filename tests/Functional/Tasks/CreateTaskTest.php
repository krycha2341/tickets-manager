<?php

namespace Tests\Functional\Tasks;

use App\Enums\TaskStatus;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testCreateWhenSuccess(): void
    {
        $user = User::factory()->create();
        $response = $this->post(route('tasks.create'), [
            'title' => 'test',
            'description' => 'test',
            'user_id' => $user->id,
            'status' => 'open',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'user_id',
            'status',
            'created_at',
            'updated_at'
        ]);
    }

    public function testCreateWhenUserIdNotSpecified(): void
    {
        // should create for logged-in user
        $response = $this->post(route('tasks.create'), [
            'title' => 'test',
            'description' => 'test',
            'status' => 'open',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'user_id',
            'status',
            'created_at',
            'updated_at'
        ]);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertEquals($this->user->id, $arrayResponse['user_id']);
    }

    public function testCreateWhenStatusNotSpecified(): void
    {
        // should create with status open
        $response = $this->post(route('tasks.create'), [
            'title' => 'test',
            'description' => 'test',
        ]);
        $response->assertStatus(200);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertEquals(TaskStatus::OPEN->value, $arrayResponse['status']);
    }

    public function testCreateWhenTitleNotProvided(): void
    {
        $response = $this->post(route('tasks.create'), [
            'description' => 'test',
        ]);
        $response->assertStatus(422);
    }

    public function testCreateWhenUserIdNotFilled(): void
    {
        $response = $this->post(route('tasks.create'), [
            'title' => 'title',
            'description' => 'test',
            'user_id' => '',
        ]);
        $response->assertStatus(422);
    }

    public function testCreateWhenStatusNotFilled(): void
    {
        $response = $this->post(route('tasks.create'), [
            'title' => 'title',
            'description' => 'test',
            'status' => '',
        ]);
        $response->assertStatus(422);
    }

    public function testCreateWhenStatusNotInAvailableValues(): void
    {
        $response = $this->post(route('tasks.create'), [
            'title' => 'title',
            'description' => 'test',
            'status' => 'different_status_not_handled',
        ]);
        $response->assertStatus(422);
    }
}
