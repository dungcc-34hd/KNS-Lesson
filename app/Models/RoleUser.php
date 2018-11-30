<?php

namespace App\Models;

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //
    public $table = 'role_user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id', 'user_type',
    ];

    // public static function getRoleByUserID($id)
    // {
    //     return self::where('user_id', $id)->first();
    // }

    public function users() 
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

}
