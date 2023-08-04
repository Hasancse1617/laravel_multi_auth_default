<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\PasswordResetMail;
use DB;
use Str;
use Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $inputType;

    public function login(Request $request){
        if($request->isMethod('post')){
            
            $inputType = filter_var($request->input_type, FILTER_VALIDATE_EMAIL)? 'email':'username';
            $request->merge([$inputType => $request->input_type]);

            $request->validate([
                'email' => ['required_without:username', 'string', 'email', 'exists:admins,email'],
                'username' => ['required_without:email', 'string', 'exists:admins,username'],
                'password' => ['required'],
            ]);

            $data = $request->all();
            $remember = false;
            // dd($data);
            if(isset($data['remember_me'])){
                $remember = true;
            }
            if (Auth::guard('admin')->attempt([$inputType => $data['input_type'], 'password' => $data['password']], $remember)) {
                $request->session()->regenerate();
                return redirect('admin/dashboard');
            }
            return back()->withErrors([
                'email' => 'Invalid Username or Password',
            ]);
        }
        return view('admin.login');
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'email' => ['required', 'email'],
            ]);
            $data = $request->all();
            // dd($data);
            $token = Str::random(60);
            $restlinkExist = DB::table('password_reset_tokens')
                            ->where(['email' => $request->email])
                            ->first();
            
            if($restlinkExist){
                DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            }

            DB::table('password_reset_tokens')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            $email = $data['email'];
            $mailData = ['token'=>$token];

            Mail::to($email)->send(new PasswordResetMail($mailData));

            return redirect()->back()->with('success','We have e-mailed your password reset link!');
        }

        return view('admin.forgot-password');
    }

    public function resetPassword(Request $request, $token){

        if($request->isMethod('post')){
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);
            
            $updatePassword = DB::table('password_reset_tokens')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

            if(!$updatePassword){
                return back()->withInput()->with('error', 'Invalid token!');
            }
            $user = User::where('email', $request->email)
                          ->update(['password' => Hash::make($request->password)]);

              DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

              return redirect('/admin/login')->with('success', 'Your password has been changed!');
        }
        // dd('Hasan');
        return view('admin.reset-password', compact('token'));
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    public function slider(){
        return view('admin.slider');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','logout successfully');
    }
}
