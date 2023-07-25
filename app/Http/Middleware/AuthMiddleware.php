<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin')) {
            return redirect()->route('auth.login');
        }
   
        
        if(!auth()->user()){
            return redirect()->route('index.logout');
        }
        // if(auth()->user()->status == '0'){
       
        //     return redirect()->route('index.logout');

        // }
        return $next($request);
    }
}
