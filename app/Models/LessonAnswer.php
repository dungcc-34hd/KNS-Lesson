<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonAnswer extends Model
{
    public static function findLessonContentByID($lesson_content_id)
    {
        return LessonAnswer::where('lesson_content_id',$lesson_content_id)->get();
    }
}
