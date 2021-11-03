<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;

class SuperAdmin
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

        if (Auth::check() && Auth::user()->role == 'superadmin') {
            return $next($request);

        } elseif (Auth::check() && Auth::user()->role == 'admin') {
            Session::flash('error', 'Unauthorized action!');
            return redirect(RouteServiceProvider::HOME);
            
        } elseif (Auth::check() && Auth::user()->role == 'member') {
            Session::flash('error', 'Unauthorized action!');
            return redirect(RouteServiceProvider::HOME);

        } else {
            return redirect(RouteServiceProvider::HOME);

        }
    }
}
