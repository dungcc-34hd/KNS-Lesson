<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;

class AreaController extends Controller
{
    public function getarea(Request $request)
    {
    	$size = $request->size;
    	if(!is_null($size)){
    		return response()->json([
	    		'code' => 0, 
	    		'data' => Area::select(['id', 'name'])->paginate($size)
			], 200);
    	}else{
    		return response()->json([
	    		'code' => 0, 
	    		'data' => Area::select(['id', 'name'])->paginate()
			], 200);
    	}
    }
}
