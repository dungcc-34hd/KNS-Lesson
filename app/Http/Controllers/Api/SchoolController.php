<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use Validator;

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
		    		'data' => School::where('district_id',$district_id)->paginate($size)
				], 200);
			}else{
				return response()->json([
		    		'code' => 0, 
		    		'data' => School::paginate($size)
				], 200);
			}
		}else{
			return response()->json([
	    		'code' => 0, 
	    		'data' => School::all()
			], 200);
		}
	}

	public function createschool(Request $request){
        $arr = $request->all();
        $arr['license_key'] = $this->simpleRandString();
        $validator = Validator::make($arr, [
            'email' => 'required|string|email|max:190|unique:schools',
            'name'  =>  'string|min:8|max:190|unique:schools',
            'phone' => 'required|min:6|string',
            'area_id'  => 'required',
            'province_id'  => 'required',
            'district_id'  => 'required',
            'school_level_id'  => 'required'
        ],[
            'email.required'    => 'email không được để trống',
            'email.string'   => 'email sai định dạng',
            'email.email'   => 'email sai định dạng',
            'email.unique'   => 'email đã tồn tại',
            'name.string'   => 'Tên sai định dạng',
            'name.min'   => 'Tên phải có ít nhất 6 ký tự',
            'name.max'   => 'Tên chỉ được phép nhiều nhất 190 ký tự',
            'name.unique'   => 'Tên trường đã tồn tại',
            'phone.min'   => 'Số điện thoại phải có ít nhất 6 ký tự',
            'phone.required'   => 'Số điện thoại không được để trống',
            'area_id.required'   => 'Khu vực không được để trống',
            'province_id.required'   => 'Tỉnh thành không được để trống',
            'district_id.required'   => 'Quận huyện không được để trống',
            'school_level_id.required'   => 'Cấp không được để trống'
        ]);

        if(!$validator->fails()){
            School::create($arr);
            return response()->json([
                'data' => ['message'=>'Tạo thành công'],
                'code'  => '0'
            ],200);
        }else{
            $error = $validator->errors();
            return response()->json(['error' => $error, 'code' => 104], 200);
        }
    }

    public function simpleRandString($length=8, $list="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"){

        mt_srand((double)microtime()*1000000);
        $newstring="";

        if($length>0){

            while(strlen($newstring)<$length){
                $newstring.=$list[mt_rand(0, strlen($list)-1)];
            }
        }

        return $newstring;

    }
}
