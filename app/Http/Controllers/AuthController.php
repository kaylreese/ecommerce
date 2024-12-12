<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;
use App\Models\NotificationModel;

class AuthController extends Controller
{
    public function login_admin() 
    {
        // dd(Hash::make('123'));
        
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1){
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request) 
    {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 1, 'is_delete' => 0], $remember)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', "Por favor ingrese un email o password correcto!!");
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function auth_login(Request $request) 
    {
        $remember = !empty($request->is_remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1, 'is_delete' => 0], $remember)) {
           
            if (!empty(Auth::user()->email_verified_at)) {
                $json['status'] = true;
                $json['message'] = 'success';
            } else {
                $user = User::getUser(Auth::user()->id);

                try {
                    Mail::to($user->email)->send(new RegisterMail($user));
                } catch (\Throwable $th) {
                    
                }
                
                Auth::logout();

                $json['status'] = false;
                $json['message'] = 'Your account email not verified. Please check your inbox and verified.';
            }
            
        } else {
            $json['status'] = false;
            $json['message'] = 'Please enter currect email and password';
        }

        return json_encode($json);
    }
    
    
    public function auth_register(Request $request) 
    {
        $checkEmail = User::checkEmail($request->email);

        if (empty($checkEmail)) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            try {
                Mail::to($user->email)->send(new RegisterMail($user));
            } catch (\Throwable $th) {
                
            }

            $user_id = $user->id;
            $url = url('admin/customers');
            $message = 'New Customer Register #'.$request->name;

            NotificationModel::insert($user_id, $url, $message);

            $json['status'] = true;
            $json['message'] = 'Your account successfully register. Please verify your email address.';
        } else {
            $json['status'] = false;
            $json['message'] = 'This email already register please choose another.';
        }

        return json_encode($json);
    }
    
    
    public function activate_email($id) 
    {
        $id = base64_decode($id);
        $user = User::getUser($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', 'Email successfully verified.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }

    public function forgot_password(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);

        $data['meta_title'] = "Forgot Password";

        return view('auth.forgot');
    }
    
    public function auth_forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            try {
                Mail::to($user->email)->send(new ForgotPasswordMail($user));
            } catch (\Throwable $th) {
                
            }

            return redirect()->back()->with('success', "Please check your email and reset your password");
        } else {
            return redirect()->back()->with('error', "Email not found in the system.");
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();

        if(!empty($user)) {
            $data['meta_title'] = "Reset Password";
            $data['user'] = $user;

            return view('auth.reset', $data);
        } else {
            abort (404);
        }
    }

    public function auth_reset($token, Request $request)
    {
        if($request->password == $request->cpassword) {
            $user = User::where('remember_token', '=', $token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', "Password successfully reset");
        } else {
            return redirect()->back()->with('error', "Password and confirm password does not match");
        }
    }
}
