<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	public $fillable =['is_public','name'];

    public function lessonDetail()
    {
        return $this->hasMany(LessonDetail::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}

