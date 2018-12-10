<?php

namespace App;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    //
    protected $fillable = [
        'name', 'display_name','description',
    ];
    public static function getPermissions()
    {
        return self::get()->toArray();
    }

    public static function getPermissionsByType()
    {
        return self::select('type')->groupBy('type')->get();
    }
}
