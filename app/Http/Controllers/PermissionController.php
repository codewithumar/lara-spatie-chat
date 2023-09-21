<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function getPermissions()
    {
        return response()->json([
            "message" => "Permissions fetched successfully",
            "data" => Permission::all()
        ], 200);
    }
    public function grantPermission(Request $request)
    {
        $user = User::find($request->user_id);
        //return $user;
        if (!$user) {
            return response()->json([
                "message" => "User not found",
            ], 404);
        }

        $permission = Permission::find($request->permission_id);

        if (!$permission) {
            return response()->json([
                "message" => "Permission not found",
            ], 404);
        }

        $name = $permission->name;
        $user->givePermissionTo($name);

        return response()->json([
            "message" => "Permission assigned successfully",
            "permission" => $name
        ], 200);
    }
}
