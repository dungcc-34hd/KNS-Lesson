<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    protected $fillable=['id_type','type','name','description'];
    const TYPE = [
        '1' => 'Ảnh',
        '2' => 'Video',
        '3' => 'Câu hỏi-tr',
    ];

}
