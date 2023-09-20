<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function registerUser(RegisterUserRequest $request, UserService $userService)
    {

        $validate = $request->validated();
        $response = $userService->register($validate);
        return $response;
    }

    public function loginUser(LoginUserRequest $request, UserService $userService)
    {
        $validate = $request->validated();
        $response = $userService->login($validate);
        return $response;
    }

    public function logoutUser(UserService $userService)
    {
        $response = $userService->logout();
        return $response;
    }

    public function getUsers(UserService $userService)
    {
        $response = $userService->show_all();
        return $response;
    }

    public function getUser($id, UserService $userService)
    {
        $response = $userService->show($id);
        return $response;
    }

    public function deleteUser($id, UserService $userService)
    {
        $response = $userService->delete($id);
        return $response;
    }

    public function updateUser($id, UpdateUserRequest $request, UserService $userService)
    {
        $validate = $request->validated();
        $response = $userService->update($id, $validate);
        return $response;
    }
}
