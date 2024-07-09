<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');
    }

    /** @test */
    public function it_should_list_all_tasks()
    {
        Task::factory()->count(5)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /** @test */
    public function it_should_show_a_single_task()
    {
        $task = Task::factory()->create();
        $response = $this->getJson('/api/tasks/' . $task->id);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $task->id,
                'title' => $task->title,
                // Include other fields you need to assert
            ]);
    }

    /** @test */
    public function it_should_create_a_task()
    {
        $taskData = Task::factory()->make()->toArray();
        $response = $this->postJson('/api/tasks', $taskData);
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'task registered successfully.',
                'task' => [
                    'title' => $taskData['title'],
                    // Include other fields you need to assert
                ]
            ]);
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_should_update_a_task()
    {
        $task = Task::factory()->create();
        $updatedTaskData = Task::factory()->make()->toArray();
        $response = $this->putJson('/api/tasks/' . $task->id, $updatedTaskData);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'task updated successfully.',
                'task' => [
                    'id' => $task->id,
                    'title' => $updatedTaskData['title'],
                    // Include other fields you need to assert
                ]
            ]);
        $this->assertDatabaseHas('tasks', $updatedTaskData);
    }

    /** @test */
    public function it_should_delete_a_task()
    {
        $task = Task::factory()->create();
        $response = $this->deleteJson('/api/tasks/' . $task->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
