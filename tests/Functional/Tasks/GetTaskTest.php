<?php

namespace Tests\Functional\Tasks;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetTaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testGetSuccess(): void
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.get', $task->id));
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

    public function testGetWhenTaskNotFound(): void
    {
        $response = $this->get(route('tasks.get', 1));
        $response->assertStatus(404);
        $response->assertExactJson([
            'message' => 'Task could not be found',
            'code' => 404
        ]);
    }
}
