<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserThematic extends Model
{
	public $table = 'user_thematics';
    protected $fillable=['user_id','thematic_id'];
    public function thematic(){
    	return $this->belongsTo(Thematic::class);
    }
}
