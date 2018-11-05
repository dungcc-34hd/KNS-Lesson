<?php


namespace Modules\admin\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(!Auth::guest())
        {
            return redirect()->route('admin.index');
        }
        return view('admin::login.index');
    }

    public function login(Request $request)
    {
        $remember = false;
        if(isset($request->remember)) $remember = true;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            return redirect()->route('admin.index');
        }
        else{
            message($request, 'danger', 'Username or Password is wrong.');
            return redirect()->route('admin.login.index');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login.index');
    }
}