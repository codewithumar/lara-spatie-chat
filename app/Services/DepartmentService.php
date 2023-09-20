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
        return Department::create([
            'name' => $name,
        ]);

    }

    public function getDepartment()
    {
        return Department::all();

    }
    public function showDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return -1;
        }
        return $department;
    }

    public function updateDepartment($id, array $data)
    {
        $department = Department::find($id);
        if (!$department) {
            return -1;
        }
        $department->name = $data['name'];
        return $department->save();

    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return -1;
        }
        return $department->delete();

    }

}
?>