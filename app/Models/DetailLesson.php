<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLesson extends Model
{
    public $table='ls_detail_lesson';

    public function titleLesson()
    {
        return $this->belongsTo(GradeLevel::class);
    }
}
