<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->check()) {
            // Redirect based on user type
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'merchant') {
                return $next($request);
            } 
        }
        return redirect()->route('login');

       
    }
}
