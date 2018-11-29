<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $table='grades';

    public function class()
    {
        return $this->hasMany(Grade::class);
    }
}
