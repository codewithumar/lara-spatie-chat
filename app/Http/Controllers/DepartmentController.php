<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

// use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function postDepartments(PostDepartmentRequest $request, DepartmentService $departmentService)
    {

        $validated = $request->validated();
        $response = $departmentService->postDepartment($validated);
        if (!$response) {
            return response()->json([
                'message' => 'Failed to create a new Department'
            ]);
        }
        return response()->json([
            'message' => 'Department Created Successfully'
        ]);

    }
    public function getDepartments(DepartmentService $departmentService)
    {
        $response = $departmentService->getDepartment();
        if (!$response) {
            return response()->json(['message' => 'No Data found'], 404);
        }
        return $response;
    }
    public function showDepartments($id, DepartmentService $departmentService)
    {
        $response = $departmentService->showDepartment($id);
        if ($response === -1) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return $response;
    }

    public function updateDepartments($id, UpdateDepartmentRequest $request, DepartmentService $departmentService)
    {
        $validated = $request->validated();
        $response = $departmentService->updateDepartment($id, $validated);
        if ($response === -1) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json([
            'message' => "Department Updated Successfully"
        ]);

    }

    public function deleteDepartments($id, DepartmentService $departmentService)
    {
        $response = $departmentService->deleteDepartment($id);
        if ($response === -1) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json(['message' => 'Department Deleted Duccessfully']);
    }
}