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
        return $response;
    }
    public function getDepartments(DepartmentService $departmentService)
    {
        $response = $departmentService->getDepartment();
        return $response;
    }
    public function showDepartments($id, DepartmentService $departmentService)
    {
        $response = $departmentService->showDepartment($id);
        return $response;
    }

    public function updateDepartments($id, UpdateDepartmentRequest $request, DepartmentService $departmentService)
    {
        $validated = $request->validated();
        $response = $departmentService->updateDepartment($id, $validated);
        return $response;
    }

    public function deleteDepartments($id, DepartmentService $departmentService)
    {
        $response = $departmentService->deleteDepartment($id);
        return $response;
    }
}