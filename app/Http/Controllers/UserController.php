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
        if (!$response) {
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }

        return response()->json([
            'message' => 'Registeration Successfull',
            'data' => $response,
        ], 200);
    }

    public function loginUser(LoginUserRequest $request, UserService $userService)
    {
        $validate = $request->validated();
        $token = $userService->login($validate);
        if ($token == -1) {
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }
        return response()->json([
            'message' => 'Login Successfull',
            'data' => $token,
        ], 200);
    }

    public function logoutUser(UserService $userService)
    {
        $response = $userService->logout();
        if (!$response) {
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }
        return response()->json(['message' => 'Logout Successfull'], 200);
    }

    public function getUsers(UserService $userService)
    {
        $response = $userService->show_all();
        return response()->json([
            'message' => 'All users Data',
            'data' => $response,
        ], 200);
    }

    public function getUser($id, UserService $userService)
    {
        $user = $userService->show($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'message' => 'Found',
            'data' => $user,
        ], 200);
    }

    public function deleteUser($id, UserService $userService)
    {
        $response = $userService->delete($id);
        if ($response == -1) {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
        return response()->json([
            'message' => 'Successfully Deleted',
        ], 200);
    }

    public function updateUser($id, UpdateUserRequest $request, UserService $userService)
    {
        $validateData = $request->validated();
        $response = $userService->update($id, $validateData);
        if ($response == -1) {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
        return response()->json([
            'message' => "User Updated"
        ]);
    }
}
