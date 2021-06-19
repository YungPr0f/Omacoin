<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        // return $request->user()->hasVerifiedEmail()
        //             ? redirect()->intended(RouteServiceProvider::HOME)
        //             : view('auth.verify-email');

        if($request->user()->hasVerifiedEmail()) {
            Session::flash('info', 'Your email has already been verified');
            return redirect()->intended(RouteServiceProvider::HOME);

        } else {
            Session::flash('info', 'Please verify your email address to continue');
            return view('auth.verify-email');
            
        }
    }
}
