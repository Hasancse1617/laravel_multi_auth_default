<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $data = $request->all();
            // dd($data);
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin'])) {
                $request->session()->regenerate();
                return redirect('admin/dashboard');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        return view('admin.login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
}
