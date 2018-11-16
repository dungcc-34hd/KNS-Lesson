<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitleLesson extends Model
{
    public $table = 'ls_title_lesson';

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

}

