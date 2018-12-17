<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SchoolController extends Controller
{
    public function getschool(Request $request)
	{
		$size = $request->size;
	    $district_id = $request->district_id;
		if(!is_null($size)){
			if(!is_null($district_id)){
				return response()->json([
		    		'code' => 0, 
		    		'data' => DB::table('schools')
		    					->select(['id', 'name','province_id','school_level_id','license_key','district_id','area_id'])
		    					->where('district_id',$district_id)
								->paginate($size)
				], 200);
			}else{
				return response()->json([
		    		'code' => 0, 
		    		'data' => DB::table('schools')
		    					->select(['id', 'name','province_id','school_level_id','license_key','district_id','area_id'])
								->paginate($size)
				], 200);
			}
		}else{
			return response()->json([
	    		'code' => 0, 
	    		'data' => DB::table('schools')
	    					->select(['id', 'name','province_id','school_level_id','license_key','district_id','area_id'])
							->paginate()
			], 200);
		}
	}
}
