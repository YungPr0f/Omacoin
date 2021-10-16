<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->role;

        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);

        } else {
            
            Session::flash('error', 'Administrators only!');
            return redirect(RouteServiceProvider::HOME);

        }

    }
}
