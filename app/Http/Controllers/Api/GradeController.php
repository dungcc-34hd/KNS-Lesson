<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Auth;

class GradeController extends Controller
{
	public function getgrade(Request $request)
	{
		$size = $request->size;

    	if(!is_null($size)){
    		return response()->json([
	    		'code' => 0, 
	    		'data' => Grade::select(['id', 'name'])
	    					->where('id',Auth::user()->grade_id)
							->paginate($size)
			], 200);
    	}else{
    		return response()->json([
	    		'code' => 0, 
	    		'data' => Grade::select(['id', 'name'])
	    					->where('id',Auth::user()->grade_id)
							->get()
			], 200);
    	}
	}
    	
}
