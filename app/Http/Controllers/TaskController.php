<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\PostTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\ReassignTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;


class TaskController extends Controller
{
    /**
     * Creating Task
     */
    public function postTasks(PostTaskRequest $request, TaskService $taskService)
    {
        $validated = $request->validated();
        $response = $taskService->postTask($validated);
        if (!$response) {
            return response()->json([
                'message' => 'Failed to create a new Task'
            ]);
        }
        return response()->json([
            'message' => 'Task Created Successfully'
        ]);
    }
    /**
     * Display the tasks.
     */
    public function getTasks(GetTaskRequest $request, TaskService $taskService)
    {
        $response = $taskService->getTask();
        if (!$response) {
            return response()->json(['message' => 'No Data found'], 404);
        }
        return response()->json($response);
    }
    public function showTasks($id, TaskService $taskService)
    {
        $response = $taskService->showTask($id);
        if ($response === -1) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($response);
    }



    public function updateTasks($id, UpdateTaskRequest $request, TaskService $taskService)
    {

        $validated = $request->validated();
        $response = $taskService->updateTask($id, $validated);
        if ($response === -1) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json([
            'message' => "Task Updated Successfully"
        ]);
    }

    /**
     * Re-assigning the tasks.
     */
    public function reassignTasks($id, ReassignTaskRequest $request, TaskService $taskService)
    {
        $validated = $request->validated();
        $response = $taskService->reassignTask($id, $validated);
        if ($response === -1) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json([
            'message' => "Task Re-Assigned Successfully"
        ]);
    }


    /**
     * Delete the task
     */
    public function deleteTasks($id, TaskService $taskService)
    {
        $response = $taskService->deleteTask($id);
        if ($response === -1) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json(['message' => 'Task Deleted Duccessfully']);
    }
}
