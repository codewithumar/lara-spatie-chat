<?php
namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class DepartmentService
{
    public function postDepartment(array $data)
    {
        $name = $data['name'];

        $department = Department::create([
            'name' => $name,
        ]);
        if (!$department) {
            return response()->json([
                'message' => 'Failed to create a new Department'
            ]);
        }
        return response()->json([
            'message' => 'Department Created Successfully'
        ]);

    }

    public function getDepartment()
    {
        $response = Department::all();
        return $response;
    }
    public function showDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json($department);
    }

    public function updateDepartment($id, array $data)
    {
        $department = Department::find($id);
        $department->name = $data['name'];

        // Save the updated department
        $department->save();
        return response()->json([
            'message' => "Department Updated Successfully"
        ]);
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        $department->delete();
        return response()->json(['message' => 'Department Deleted Duccessfully']);
    }

}
?>