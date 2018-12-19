<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\User;
use Auth;

class LessonController extends Controller
{
    public function getlesson(Request $request)
    {
    	$size = $request->size;
    	if(!is_null($size)){
    		return response()->json([
	    		'code' => 0,
	    		'data' => Lesson::select(['id', 'name'])
							->paginate($size)
			], 200);
    	}else{
    		return response()->json([
	    		'code' => 0,
	    		'data' => Lesson::select(['id', 'name'])
							->paginate()
			], 200);
    	}
    }

    public function downloadZip(Request $request)
    {
        $lessonId = $request->lessonId;
        if(!is_null($lessonId)){
            $this->updateAmountDownload();
            $lesson = Lesson::find($lessonId);
            isset($lesson) ? $name = $lesson->name : '';
            $path = path.$name.'.zip';
            return response()->file($path);
        }else{
            return response()->json(['cannot download']);
        }
        
    }

    public function updateAmountDownload()
    {
        $user = User::find(Auth::user()->id);
        $user->download = $user->download + 1;
        $user->save();
    }

}
