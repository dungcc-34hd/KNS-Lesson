<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class LsClass extends Model
{
    public $table='class';

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
  
}
