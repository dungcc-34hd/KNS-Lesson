<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LsClass;

class ClassController extends Controller
{
    public function getclass(Request $request)
	{
		$size = $request->size;
	    $grade_id = $request->grade_id;
		if(!is_null($size)){
			if(!is_null($grade_id)){
				return response()->json([
		    		'code' => 0, 
		    		'data' => LsClass::select(['id', 'name','grade_id'])
		    					->where('grade_id',$grade_id)
								->paginate($size)
				], 200);
			}else{
				return response()->json([
		    		'code' => 0, 
		    		'data' => LsClass::select(['id', 'name','grade_id'])
								->paginate($size)
				], 200);
			}
		}else{
			return response()->json([
	    		'code' => 0, 
	    		'data' => LsClass::select(['id', 'name','grade_id'])
							->paginate()
			], 200);
		}
	}
}
