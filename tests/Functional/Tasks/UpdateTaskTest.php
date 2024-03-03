<?php

namespace Tests\Functional\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function testUpdateSuccess(): void
    {
        $title = 'diff tittle';
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => TaskStatus::OPEN
        ]);
        $response = $this->put(route('tasks.update', $task->id), [
            'title' => $title,
            'description' => null,
            'action' => 'start'
        ]);
        $response->assertStatus(204);
        $task->refresh();
        $this->assertEquals($title, $task->title);
        $this->assertNull($task->description);
        $this->assertEquals(TaskStatus::IN_PROGRESS, $task->status);
    }

    public function testUpdateSuccessWhenUserNotFound(): void
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => TaskStatus::OPEN
        ]);
        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'diff tittle',
            'description' => null,
            'action' => 'start',
            'user_id' => 123123,
        ]);
        $response->assertStatus(404);
        $response->assertExactJson([
            'message' => 'User not found',
            'code' => 404
        ]);
    }

    public function testUpdateSuccessWhenTaskNotFound(): void
    {
        $response = $this->put(route('tasks.update', 123), [
            'title' => 'diff tittle',
            'description' => null,
            'action' => 'start',
            'user_id' => 123123,
        ]);
        $response->assertStatus(404);
        $response->assertExactJson([
            'message' => 'Task could not be found',
            'code' => 404
        ]);
    }

    public function testUpdateSuccessWhenActionCannotBeAppliedForTask(): void
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => TaskStatus::DONE
        ]);
        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'diff tittle',
            'action' => 'start',
        ]);
        $response->assertStatus(409);
        $response->assertExactJson([
            'message' => 'Given action can\'t be performed on that task!',
            'code' => 409
        ]);
    }

    public function testUpdateSuccessWhenPolicyForbidUpdate(): void
    {
        $task = Task::factory()->create([
            'status' => TaskStatus::OPEN
        ]);
        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'diff tittle',
            'action' => 'start',
        ]);
        $response->assertStatus(403);
    }
}
