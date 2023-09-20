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
        return $user;
    }

    public function login(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return -1;
        }
        $token = $user->createToken('token')->plainTextToken;
        return $token;
    }

    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }

    public function show_all()
    {
        return  User::all();
    }

    public function show($id)
    {
        return  User::find($id);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return -1;
        }
        return User::where('id', $id)->delete();
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            return -1;
        }

        return  $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }
}
