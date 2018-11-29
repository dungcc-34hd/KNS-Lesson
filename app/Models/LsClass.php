<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LsClass extends Model
{
    public $table='class';

    public function gradeLevel()
    {
        return $this->belongsTo(Grade::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
