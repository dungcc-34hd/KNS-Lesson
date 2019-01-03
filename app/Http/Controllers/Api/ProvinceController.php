<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Province;

class ProvinceController extends Controller
{
	public function getprovince(Request $request)
	{
		$size = $request->size;
	    $area_id = $request->area_id;
		if(!is_null($size)){
			if(!is_null($area_id)){
				return response()->json([
		    		'code' => 0, 
		    		'data' => Province::where('area_id',$area_id)->paginate($size)
				], 200);
			}else{
				return response()->json([
		    		'code' => 0, 
		    		'data' => Province::paginate($size)
				], 200);
			}
		}else{
			return response()->json([
	    		'code' => 0, 
	    		'data' => Province::all()
			], 200);
		}
	}
    
}
