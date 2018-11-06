<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class AreaController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * check Login
     * @return bool|string
     */
    public function checkLogin()
    {
        if(!empty(Auth::user('id'))){
            return "sdsdsa";
        }
        return true;
    }
    public function index()
    {

    }

}
