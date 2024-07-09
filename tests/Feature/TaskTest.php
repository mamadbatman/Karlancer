<?php


namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase; // Use RefreshDatabase trait to reset database after each test

    protected function setUp(): void
    {
        parent::setUp();

        // Prevent the RefreshDatabase trait from deleting data
    }

    /** @test */
    public function can_create_task()
    {
        // Create a user for testing purposes
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Define data for the task
        $data = [
            'title' => 'New Task',
            'description' => 'Description of the new task',
            'user_id' => $user->id,  // Assign the user_id
            'start_date' => '2024-07-10',
            'end_date' => '2024-07-15',
            'expiration_date' => '2024-07-20',
        ];

        // Send POST request to create task
        $response = $this->postJson('/api/tasks', $data);

        // Assert HTTP response status code and JSON data
        $response->assertStatus(201)
            ->assertJson($data);

        // Assert the task exists in the database
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Description of the new task',
            'user_id' => $user->id,
            'start_date' => '2024-07-10',
            'end_date' => '2024-07-15',
            'expiration_date' => '2024-07-20',
        ]);
    }
}
