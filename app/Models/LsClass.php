<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LsClass extends Model
{
    public $table='ls_class';

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
