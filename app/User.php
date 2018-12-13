<?php

namespace App;

use App\Models\Area;
use App\Models\Province;
use App\Models\District;
use App\Models\School;
use App\Models\Grade;
use App\Models\LsClass;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name', 'email','tel', 'password','area_id','province_id','district_id','school_id','grade_id','class_id','role_id','quantity_student'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function lsClass()
    {
        return $this->belongsTo(LsClass::class,'class_id','id');
    }

  
}
