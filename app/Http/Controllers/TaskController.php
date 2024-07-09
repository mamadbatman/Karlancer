<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // نمایش لیست تسک‌ها
    public function index()
    {
        return Task::all();
    }

    // نمایش یک تسک خاص
    public function show(Task $task)
    {
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
    public function update(TaskRequest $request, Task $task)
    {
        $input = $request->all();
        $task->update($input);
        Log::info('task updated successfully.', ['task_id' => $task->id]);
        return response()->json(['message' => 'task updated successfully.', 'task' => $task],200);
    }

    /**
     * remove a task in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        Log::info('task deleted successfully.', ['task_id' => $task->id]);
        return response()->json(null, 204);
    }
}
