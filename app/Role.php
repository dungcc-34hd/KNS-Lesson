<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable= ['name','display_name','description'];

   // public function update($id, $name,$display_name,$){
   // 	$update=self::where('id', $id)->update([$array]);
   //        return $update;
   // }

}
