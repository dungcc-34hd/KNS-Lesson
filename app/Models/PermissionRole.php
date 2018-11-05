<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    //

    public $table = 'permission_role';
    public $timestamps = false;

    public static function deleteAll($role_id)
    {
        self::where('role_id', '=',$role_id)->delete();
    }

    public static function addPermissionRole($permission_id,$role_id)
    {
        $pr = new PermissionRole;
        $pr->permission_id = (int)$permission_id;
        $pr->role_id = (int)$role_id;
        $pr->save();
    }
}
