<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Validation\ValidationException; // Import ValidationException
use Carbon\Carbon; // Import Carbon for timestamps

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('backend.auth.login');
    }

    public function login_admin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],true)){
            if(!empty(Auth::User()->status)){
                if(Auth::User()->is_role == 1){ // Assuming 1 for admin
                    return redirect('admin/dashboard');
                }else{
                    Auth::logout(); // Log out non-admin users
                    return redirect('login')->with('error', 'Access Denied: Not an Admin Account.');
                }
            }else{
                $user_id = Auth::User()->id;
                Auth::logout();
                $user = User::find($user_id); // Find the user to potentially update their status if needed
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

            // Store the random password for further use if needed (e.g., in mail)
            $user->password_random = $random_password;

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

             // Redirect back with success message
            return redirect()->back()->with('success', 'Password Successfully Sent to Your Email. Please Check your Email');
        }else{
            // Email not found in the database
            return redirect()->back()->with('error', 'Email Id Not Found!');
        }
    }

      public function register(Request $request)
    {
        // Before showing the registration form, check if an admin already exists.
        // $adminExists = User::where('is_role', 1)->exists();
        // if ($adminExists) {
        //     // If an admin exists, redirect to the login page with an info message.
        //     return redirect('login')->with('error', 'Admin registration is disabled. An admin account already exists.');
        // }
        // If no admin, show the registration form.
        return view('backend.auth.register');
    }

    public function register_admin(Request $request)
    {
        // --- ADDED LOGIC: Check if an admin already exists ---
        $adminExists = User::where('is_role', 1)->exists();
        if ($adminExists) {
            return redirect('login')->with('error', 'Cannot register a new admin. An account already exists.');
        }

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_role' => 1, // Set to 1 for admin
                'status' => 1,  // Set to 1 for active/verified by default for admin registration
                'email_verified_at' => Carbon::now(),
            ]);

            Auth::login($user);

            return redirect('admin/dashboard')->with('success', 'Admin account registered and logged in successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Admin registration error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during registration. Please try again.');
        }
    }
}
