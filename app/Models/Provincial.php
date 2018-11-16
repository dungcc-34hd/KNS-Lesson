<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincial extends Model
{
    public $table = 'ls_provincials';

    public $fillable = ['name','area_id'] ;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
