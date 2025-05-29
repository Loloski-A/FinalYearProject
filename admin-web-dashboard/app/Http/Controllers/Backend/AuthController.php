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

    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }

    public function forgot(Request $request)
    {
        return view('backend.auth.forgot');
    }

    public function forgot_admin(Request $request)
    {
        // Generate a random password

        $random_password = rand(1111,9999);

        // Retrieve the user by email
        $user = User::where('email', '=', $request->email)->first();
        if(!empty($user)){
            // Update the user's password
            $user->password = Hash::make($random_password);
            $user->save();

            // Store the random password for further use if needed
            $user->password_random = $random_password;

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

             // Redirect back with success message
            return redirect()->back()->with('success', 'Password Successfully Sent to Your Email. Pleas Check your Email');
        }else{
            // Email not found in the database
            return redirect()->back()->with('error', 'Email Id Not Found!');
        }
    }
}
