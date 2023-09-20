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
        return $response;
    }
    /**
     * Display the tasks.
     */
    public function getTasks(GetTaskRequest $request, TaskService $taskService)
    {
        $response = $taskService->getTask();
        return $response;
    }
    public function showTasks($id, TaskService $taskService)
    {
        $response = $taskService->showTask($id);
        return $response;
    }



    public function updateTasks($id, UpdateTaskRequest $request, TaskService $taskService)
    {

        $validated = $request->validated();
        $response = $taskService->updateTask($id, $validated);
        return $response;

    }

    /**
     * Re-assigning the tasks.
     */
    public function reassignTasks($id, ReassignTaskRequest $request, TaskService $taskService)
    {
        $validated = $request->validated();
        $response = $taskService->reassignTask($id, $validated);
        return $response;
    }


    /**
     * Delete the task
     */
    public function deleteTasks($id, TaskService $taskService)
    {
        $response = $taskService->deleteTask($id);
        return $response;
    }
}