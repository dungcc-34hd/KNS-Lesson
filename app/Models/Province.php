<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $fillable = ['name','area_id'] ;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function district()
    {
        return $this->hasMany(District::class);
    }
}
