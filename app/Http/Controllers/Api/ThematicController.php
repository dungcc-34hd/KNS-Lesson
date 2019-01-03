<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class ThematicController extends Controller
{
	public function getThematic(Request $request)
	{
		$size = $request->size;
		$query = User::find(Auth::user()->id);
    	if(!is_null($size)){
    		return response()->json([
	    		'code' => 0, 
	    		'data' => $query->thematic
							->paginate($size)
			], 200);
    	}else{
    		return response()->json([
	    		'code' => 0, 
	    		'data' => $query->thematic
			], 200);
    	}
	}
}
