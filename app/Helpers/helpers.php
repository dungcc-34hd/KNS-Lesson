<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Artwork;
use Illuminate\Support\Facades\Validator;

if (!function_exists('formatCurrency')) {
    function formatCurrency($cost)
    {
        if ($cost >= 0)
            return '$' . number_format($cost, 2);
        return '-$' . number_format(abs($cost), 2);
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $new = 'd-m-Y', $old = 'Y-m-d')
    {
        if (is_null($date)) return '-';
        return \Carbon\Carbon::createFromFormat($old, $date)->format($new);
    }
}

if (!function_exists('canPermissions')) {
    function canPermissions($permission)
    {
        if (!Auth::user()->hasPermission($permission)) {
            return abort(403);
        }
    }
}

if (!function_exists('messageSS')) {
    function message($request, $alert, $message)
    {
        $request->session()->flash('flash_level', $alert);
        $request->session()->flash('flash_message', $message);
    }
}
if(!function_exists('validationCustom'))
{
    function validationCustom($request, $array)
    {
        $validator = Validator::make($request->all(), $array);
        if ($validator->fails()) {
            $validation = $validator->getMessageBag()->getMessages();
            $validation['status'] = -1;
            return $validation;
        }
        return null;
    }
}

