<?php

namespace App\Services;

use App\Models\ModelHasPermissions;


class PermissionsService
{
    public function getUserPermissions($id)
    {
        $userPermissions = ModelHasPermissions::where('model_id', $id)
            ->with(['permission:id,name']) // Specify the fields you want to select from the permissions table
            ->get(['permission_id', 'model_id']);

        return $userPermissions;
    }
}
