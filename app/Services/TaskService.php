<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class TaskService
{
    public function postTask(array $data)
    {
        $name = $data['name'];
        $status = $data['status'];
        $comments = $data['comments'];
        $user_id = $data['user_id'];

        return Task::create([
            'name' => $name,
            'status' => $status,
            'comments' => $comments,
            'user_id' => $user_id,
        ]);

    }

    public function getTask()
    {
        return Task::all();
    }
    public function showTask($id)
    {
        // Retrieve the task by ID or return a JSON response with a 404 status if not found
        $task = Task::find($id);
        if (!$task) {
            return -1;
        }
        return $task;
    }

    public function updateTask($id, array $data)
    {

        $task = Task::find($id);
        if (!$task) {
            return -1;
        }
        // Update the task's attributes
        $task->name = $data['name'];
        $task->status = $data['status'];
        $task->comments = $data['comments'];
        $task->user_id = $data['user_id'];

        // Save the updated task
        return $task->save();
    }

    public function reassignTask($id, array $data)
    {
        $task = Task::find($id);
        if (!$task) {
            return -1;
        }
        $task->user_id = $data['user_id'];
        return $task->save();

    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return -1;
        }
        return $task->delete();
    }
}
?>