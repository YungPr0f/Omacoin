<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'in:member,admin,superadmin',
            'surname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'role' => $request->role ?? '',
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        

        if(empty($request->role)) {

            return response()->json(['error'=>'User created successfully', 'data'=>$user]);

            // Auth::login($user);

            // event(new Registered($user));

            // Session::flash('success', 'Registration successful');
            // return redirect(RouteServiceProvider::HOME);

        } else {

            if(!empty($validator->errors())) {
                return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View

            } else {
                return response()->json(['success'=>'User created successfully', 'data'=>$user]); // Send Success Response + Data in JSON Format to the View

            }

        }
        
    }
}
