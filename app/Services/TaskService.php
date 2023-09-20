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

        $task = Task::create([
            'name' => $name,
            'status' => $status,
            'comments' => $comments,
            'user_id' => $user_id,
        ]);
        if (!$task) {
            return response()->json([
                'message' => 'Failed to create a new Team'
            ]);
        }
        return response()->json([
            'message' => 'Task Created Successfully'
        ]);
    }

    public function getTask()
    {
        return response()->json([
            'message' => 'success',
            'data' => Task::all(),
        ]);
    }
    public function showTask($id)
    {
        // Retrieve the task by ID or return a JSON response with a 404 status if not found
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

    public function updateTask($id, array $data)
    {

        $task = Task::find($id);

        // Update the task's attributes
        $task->name = $data['name'];
        $task->status = $data['status'];
        $task->comments = $data['comments'];
        $task->user_id = $data['user_id'];

        // Save the updated task
        $task->save();

        return response()->json([
            'message' => "Task Updated Successfully"
        ]);
    }

    public function reassignTask($id, array $data)
    {
        $task = Task::find($id);
        $task->user_id = $data['user_id'];
        $task->save();
        return response()->json([
            'message' => "Task Re-Assigned Successfully"
        ]);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json(['message' => 'Task Deleted Duccessfully']);
    }
}
?>