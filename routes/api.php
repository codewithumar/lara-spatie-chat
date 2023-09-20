<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/users/register', [UserController::class, 'registerUser']); // Done
Route::post('/users/login', [UserController::class, 'loginUser']); // Done




Route::middleware('auth:sanctum')->group(function () {

    // Route for Users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users'); // Done
        Route::get('/{id}', [UserController::class, 'getUser'])->middleware('permission:can-access-all-users'); // Done 
        Route::delete('/{id}', [UserController::class, 'deleteUser'])->middleware('permission:can-access-all-users'); // Done 
        Route::put('/{id}', [UserController::class, 'updateUser'])->middleware('permission:can-access-all-users'); // Done
        Route::post('/logout', [UserController::class, 'logoutUser']); // Done
    });


    // Route for TaskController
    Route::prefix('/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'getTasks'])->middleware('permission:can-view-task'); //Get All Tasks
        Route::post('/', [TaskController::class, 'postTasks'])->middleware('permission:can-create-task'); //Post a task
        Route::get('/{id}', [TaskController::class, 'showTasks'])->middleware('permission:can-view-task');
        Route::delete('/{id}', [TaskController::class, 'deleteTasks'])->middleware('permission:can-delete-task');
        Route::put('/{id}', [TaskController::class, 'updateTasks'])->middleware('permission:can-update-task'); // for updating complete start
        Route::put('/reassign/{id}', [TaskController::class, 'reassignTasks'])->middleware('permission:can-reassign-task'); // for reassigning the task
    });


    // Routes for TeamController
    Route::prefix('/teams')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->middleware('permission:can-view-teams');
        Route::post('/add', [TeamController::class, 'store'])->middleware('permission:can-create-teams');
        Route::get('/show', [TeamController::class, 'show'])->middleware('permission:can-view-specific-team');
        Route::put('/update/{id}', [TeamController::class, 'update'])->middleware('permission:can-update-teams');
        Route::delete('/delete/{id}', [TeamController::class, 'destroy'])->middleware('permission:can-delete-team');
    });



    // Routes for TeamMemberController
    Route::prefix('/teammember')->group(function () {
        Route::get('/', [TeamMemberController::class, 'getAllTeamMembers'])->middleware('permission:can-view-members'); // Done
        Route::post('/', [TeamMemberController::class, 'postTeam'])->middleware('permission:can-create-members'); // Done
        Route::put('/{user_id}', [TeamMemberController::class, 'updateTeamMember'])->middleware('permission:can-update-member'); // Done 
        Route::delete('/{user_id}', [TeamMemberController::class, 'deleteTeamMember'])->middleware('permission:can-update-member'); // Done
        Route::get('/{team_id}', [TeamMemberController::class, 'getTeamMember'])->middleware('permission:can-delete-member'); // Done
    });



    // Routes for DepartmentController
    Route::post('/departments', [DepartmentController::class, 'postDepartments'])->middleware('permission:can-add-department');
    Route::put('/departments/{id}', [DepartmentController::class, 'updateDepartments'])->middleware('permission:can-update-department');
    Route::delete('/departments/{id}', [DepartmentController::class, 'deleteDepartments'])->middleware('permission:can-delete-department');
    Route::get('/departments', [DepartmentController::class, 'getDepartments'])->middleware('permission:can-view-department');
    Route::get('/departments/{id}', [DepartmentController::class, 'showDepartments'])->middleware('permission:can-view-department');
});
