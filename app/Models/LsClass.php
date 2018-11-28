<?php

namespace App\Models;

use App\User;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
