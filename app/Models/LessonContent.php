<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model
{
    public function lessonDetail()
    {
        return $this->belongsTo(LessonDetail::class);
    }
    public static function findLessonByID($lesson_detail_id)
    {
        return LessonContent::where('lesson_detail_id',$lesson_detail_id)->first();
    }
}
