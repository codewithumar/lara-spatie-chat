<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'user',
        ]);    

        if(! $user){
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);    
        }

        return response()->json([
            'message' => 'Registeration Successfull',
            'data' => $user,
        ], 200);
    }

    public function login(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Please Enter Valid Credentials'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message' => 'Login Successfull',
            'data' => $token,
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Successfull'],200);
    }

    public function show_all()
    {
        $user = User::all();
        return response()->json([
            'message' => 'All users Data',
            'data' => $user,
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if(! $user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'message' => 'Found',
            'data' => $user,
        ], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if(! $user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        User::where('id', $id)->delete();
        return response()->json([
            'message' => 'Successfully Deleted',
        ], 200);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        if(! $user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return response()->json([
            'message' => "User Updated"
        ]);
    }
}