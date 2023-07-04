<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('userId')) 
        {
            return $next($request);
        }
        return redirect()->route('login')->with('success', 'Login to continue');
}
}