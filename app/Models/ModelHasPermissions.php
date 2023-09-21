<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class ModelHasPermissions extends Model
{
    use HasFactory;
    protected $table = 'model_has_permissions';
    protected $fillable = [
        'model_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
