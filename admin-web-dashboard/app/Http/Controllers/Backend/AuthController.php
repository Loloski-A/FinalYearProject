<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;


class AuthController extends Controller
{
    public function login(Request $request)
    {
    //    $password = "1234";
    //    $dd = Hash::make($password);
    //    dd($dd);
    return view('backend.auth.login');
    // echo 'A';
    // die();
    }

    public function login_admin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],true)){
            if(!empty(Auth::User()->status)){
                if(Auth::User()->is_role == 1){
                    return redirect('admin/dashboard');
                }else{
                    return redirect('login')->with('error', 'Not Admin');
                }
            }else{
                $user_id = Auth::User()->id;
                Auth::logout();
                $user = User::find($user_id);
                return redirect('login')->with('success', 'This email is not verified yet!');
            }
        }else {
            return redirect()->back()->with('error', 'Invalid login credentials!');
        }
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect(url('login'));
    // }

    // public function forgot(Request $request)
    // {
    //     return view('backend.auth.forgot');
    // }
}
