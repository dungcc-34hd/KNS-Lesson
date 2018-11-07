<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $table = 'ls_schools';

    public $fillable = ['name','school_level_id','district_id','quantity_student'] ;

    public function schoolLevel()
    {
        return $this->belongsTo(SchoolLevel::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
