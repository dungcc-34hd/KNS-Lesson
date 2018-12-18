<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\School;
use Validator;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // try{

            $arr = $request->all();
            $validator = Validator::make($arr, [
                'email' => 'required|string|email|max:190|unique:users',
                'name'  =>  'string|min:8|max:190',
                'password' => 'required|min:6|string'
            ],[
                'email.required'    => 'email không được để trống',
                'email.string'   => 'email sai định dạng',
                'email.email'   => 'email sai định dạng',
                'email.unique'   => 'email đã tồn tại',
                'name.string'   => 'Tên sai định dạng',
                'name.min'   => 'Tên phải có ít nhất 6 ký tự',
                'name.max'   => 'Tên chỉ được phép nhiều nhất 190 ký tự',
                'password.min'   => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.required'   => 'Mật khẩu không được để trống'
            ]);

            if(!$validator->fails()){
                $arr['password'] = Hash::make($arr['password']);
                $user = User::create($arr);
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addHours(4);
                $token->save();
                return response()->json([
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'school_id' => $user->school_id,
                        'token' => $tokenResult->accessToken,
                        'tel' => $user->tel,
                        'area_id' => $user->area_id,
                        'province_id' => $user->province_id,
                        'class_id' => $user->class_id,
                        'grade_id' => $user->grade_id,
                        'district_id' => $user->district_id,
                        'quantity_student' => $user->quantity_student,
                        'role_id' => $user->role_id,
                        'IP'    => request()->ip()
                    ],
                    'code'  => '0'
                ],200);
            }else{
                $error = $validator->errors();
                return response()->json(['error' => $error, 'code' => 104], 200);
            }

        // }
        // catch (\Exception $e) {
        //     $array = ['error' => $e->getMessage()];
        //     return response()->json([$array], 104);
        // }

    }


	//Login
    public function login(Request $request)
    {

//        try {
            $email = $request->email;
            $password = Hash::make($request->password);
            $credentials = $request->only('email', 'password');
            $user = User::where('email',$email)->first();

            if (Auth::attempt($credentials)) {
                $license_key = !empty($user->school_id) ? School::where('id',$user->school_id)->first()->license_key : "";
                $user->ip = request()->ip();
                $user->save();
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addHours(4);
                $token->save();

                return response()->json([
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'school_id' => $user->school_id,
                        'token' =>  $tokenResult->accessToken,
                        'tel' => $user->tel,
                        'area_id' => $user->area_id,
                        'province_id' => $user->province_id,
                        'class_id' => $user->class_id,
                        'grade_id' => $user->grade_id,
                        'district_id' => $user->district_id,
                        'quantity_student' => $user->quantity_student,
                        'role_id' => $user->role_id,
                        'license_key'   => $license_key,
                        'IP'    => request()->ip()
                    ],
                    'code'=>0
                ],200);
            }else{
                return response()->json([
                    ['message' => 'Email hoặc mật khẩu không đúng', 'code' => 1]
                ], 200);
            }







//        } catch (\Exception $e) {
//            $array = ['message' => errorSystem, 'error' => $e->getMessage()];
//            return response()->json([
//                $array
//            ], 502);
//        }

    }

   public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
