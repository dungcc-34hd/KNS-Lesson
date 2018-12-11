<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $fillable = ['name','school_level_id','district_id','quantity_student','area_id','provice_id'] ;

    public function schoolLevel()
    {
        return $this->belongsTo(SchoolLevel::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function area(){
    	return $this->belongsTo(Area::class);
    }
    public function province(){
    	return $this->belongsTo(Province::class);
    }
}
