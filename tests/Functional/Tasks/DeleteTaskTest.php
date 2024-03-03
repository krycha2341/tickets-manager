<?php

namespace Tests\Functional\Tasks;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testDeleteSuccess(): void
    {
        $task = Task::factory()->count(3)->create(['user_id' => $this->user->id])->first;
        $response = $this->delete(route('tasks.delete', $task->id));
        $response->assertStatus(204);
        $response->assertContent('');
    }

    public function testDeleteWhenTaskBelongsToAnotherUser(): void
    {
        $anotherUser = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $anotherUser->id]);
        $response = $this->delete(route('tasks.delete', $task->id));
        $response->assertStatus(403);
    }

    public function testDeleteWhenTaskNotExist(): void
    {
        $response = $this->delete(route('tasks.delete', 1));
        $response->assertStatus(404);
        $response->assertExactJson([
            'message' => 'Task could not be found',
            'code' => 404
        ]);
    }
}
