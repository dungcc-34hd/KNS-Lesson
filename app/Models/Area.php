<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $table ='ls_areas';
    protected $fillable = ['name','description'];
}
