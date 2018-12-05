<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonDetail extends Model
{
    const TYPE = [
        1 => 'PhotoSlide',
        2 => 'Video',
        3 => 'Quiz_1DapAn',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
