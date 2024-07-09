<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    private function checkEmailVerified()
    {
        $user = Auth::user();

        if (!$user || !$user->email_verified_at) {
            return response()->json(['message' => 'Email not verified'], 403);
        }

        return true;
    }

    // Display the list of tasks
    public function index()
    {

        $userId = Auth::id();

        // Retrieve tasks that belong to the authenticated user
        $tasks = Task::where('user_id', $userId)->get();
        return response()->json($tasks);
    }

    // Display a specific task
    public function show($id)
    {

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Check if the authenticated user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        return response()->json($task);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        $check = $this->checkEmailVerified();
        if ($check !== true) {
            return $check;
        }
        $request['user_id'] = Auth::id();
        $input = $request->all();
        $task = Task::create($input);
        Log::info('task registered successfully.', ['task_id' => $task->id]);
        return response()->json(['message' => 'task registered successfully.', 'task' => $task],201);
    }

    /**
     * Store a newly updated task in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskRequest $request, $id)
    {
        $check = $this->checkEmailVerified();
        if ($check !== true) {
            return $check;
        }
        $task = Task::find($id);


        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $request['user_id'] = Auth::id();
        $input = $request->all();
        $task->update($input);
        Log::info('task updated successfully.', ['task_id' => $task->id]);
        return response()->json(['message' => 'task updated successfully.'],204);
    }

    /**
     * remove a task in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $check = $this->checkEmailVerified();
        if ($check !== true) {
            return $check;
        }
        $task = Task::find($id);


        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }
        $task->delete();
        Log::info('task deleted successfully.', ['task_id' => $task->id]);
        return response()->json(null, 204);
    }



}
