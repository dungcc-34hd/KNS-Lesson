<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $fillable =['name','provincial_id'];

    public function province()
    {
        return $this->belongsTo(Provincial::class);
    }
}
