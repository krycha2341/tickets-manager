<?php

namespace Tests\Functional\Tasks;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListTasksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testListTasksSuccess(): void
    {
        Task::factory()->count(3)->create();
        $response = $this->get(route('tasks.list'));
        $response->assertStatus(200);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $arrayResponse);
        $this->assertCount(3, $arrayResponse['data']);
    }

    public function testListTasksWhenZeroTaskExists(): void
    {
        $response = $this->get(route('tasks.list'));
        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => []
        ]);
    }

    public function testListTasksWhenLimitApplied(): void
    {
        $limit = 3;
        Task::factory()->count(10)->create();
        $response = $this->get(route('tasks.list', ['limit' => $limit]));
        $response->assertStatus(200);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $arrayResponse);
        $this->assertCount($limit, $arrayResponse['data']);
    }

    public function testListTasksWhenOffsetApplied(): void
    {
        $offset = 3;
        $tasksNumber = 10;
        Task::factory()->count($tasksNumber)->create();
        $response = $this->get(route('tasks.list', ['offset' => $offset]));
        $response->assertStatus(200);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $arrayResponse);
        $this->assertCount($tasksNumber - $offset, $arrayResponse['data']);
    }

    public function testListTasksWhenUserIdSpecified(): void
    {
        $user = User::factory()->create();
        Task::factory()->count(3)->create();
        Task::factory()->count(5)->create(['user_id' => $user->id]);
        $response = $this->get(route('tasks.list', ['user_id' => $user->id]));
        $response->assertStatus(200);
        $arrayResponse = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $arrayResponse);
        $this->assertCount(5, $arrayResponse['data']);
    }
}
