<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class DistrictController extends Controller
{
    public function getdistrict(Request $request)
	{
		$size = $request->size;
	    $province_id = $request->province_id;
		if(!id_null($size)){
			if($province_id){
				return response()->json([
		    		'code' => 0, 
		    		'data' => District::select(['id', 'name','province_id'])
		    					->where('province_id',$province_id)
								->paginate($size)
				], 200);
			}else{
				return response()->json([
		    		'code' => 0, 
		    		'data' => District::select(['id', 'name','province_id'])
								->paginate($size)
				], 200);
			}
		}else{
			return response()->json([
	    		'code' => 0, 
	    		'data' => District::select(['id', 'name','province_id'])
							->paginate()
			], 200);
		}
	}
}
