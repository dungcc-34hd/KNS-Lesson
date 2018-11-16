<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $table = 'ls_districts';

    public $fillable =['name','provincial_id'];

    public function provincial()
    {
        return $this->belongsTo(Provincial::class);
    }
}
