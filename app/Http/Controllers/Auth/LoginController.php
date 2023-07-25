<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('isLoginUser');
       // $this->middleware('auth');
    }

    public function indexLogin(){

        return view('auth.auth-login-cover');
    }

    public function storeLogin(Request $request){


        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => 'required',

        ]);

        // return 'sss';

      

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email', $request->email)->first();
           
             session()->put('admin', $user);
             return redirect()->route('panel.dashboard'); 

        } else {
            return back()->with('error', 'Wrong email or password');
        }

    }
}
