<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
         //    $password = "123456789";
    //    $dd = Hash::make($password);
    //    dd($dd);
    return view('backend.auth.login');
    // echo 'A';
    // die();
    }

    public function forgot(Request $request)
    {
        return view('backend.auth.forgot');
    }
}
