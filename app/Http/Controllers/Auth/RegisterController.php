<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function indexRegister(){

        return view('auth.auth-register-cover');
    }
}
