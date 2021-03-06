<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Auth;
use Validator;
use Hash;

class DashboardController extends Controller
{

    public function __construct() {

        $this->middleware(['auth', 'verified']);

        $this->middleware('superadmin')->only('role_edit');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userbank = Bank::where('id', Auth::user()->bank_id)->first();
        // $usertransactions = User::find(Auth::id())->Transaction::all();
        $usertransactions = Transaction::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        
        $banks = Bank::all();
        // $users = User::all();
        $users = User::orderBy('created_at', 'desc')->get();
        $wallets = Wallet::all();
        $transactions = Transaction::orderBy('updated_at', 'desc')->get();

        $currencies = currencies();
        $platforms = platforms();
        $networks = networks();

        return view('dashboard')->withBanks($banks)->withUserbank($userbank)->withUsers($users)
            ->withCurrencies($currencies)->withPlatforms($platforms)->withNetworks($networks)
            ->withWallets($wallets)->withUsertransactions($usertransactions)
            ->withTransactions($transactions);
    }

    public function profile_update(Request $request) {
        $user = User::find(Auth::id()); // Fetch Currently Logged in User

        $validator = Validator::make($request->all(), [
            'surname' => ['sometimes', 'required', 'string', 'max:100'], // Surname field is required and cannot exceed 255 characters in length
            'firstname' => ['sometimes', 'required', 'string', 'max:100'], // First name field is required and cannot exceed 255 characters in length
            'email' => ['sometimes', 'required', 'string', 'email', 'max:100', 'unique:users,email,' . $user->id], // Email field is required, must be a valid email address, and cannot exceed 255 characters in length
            'phone_number' => ['sometimes', 'required', 'string', 'max:20', 'unique:users,phone_number,' . $user->id], // Email field is required, must be a valid email address, and cannot exceed 255 characters in length
            'current_password' => ['sometimes', 'required', 'password'],
            'new_password' => ['sometimes', 'required', 'string', 'confirmed', 'min:8'],
            'account_number' => ['sometimes', 'required',
                function($attribute, $value, $fail) {
                    $length = strlen((string) $value);
                    
                    if(preg_match('/[^0-9]/', $value) || ($length != 10 && $length != 16)) {
                        $fail('The :attribute must be 10 or 16 digits');
                    }
                }
            ],
            'account_name' => ['sometimes', 'required', 'string', 'min:2', 'max:200'],
            'photo' => ['sometimes', 'required', 'image', 'max:2048'], // Profile photo [file] must be an image (jpg, png, etc.)
        ],
        [
            'photo.required' => 'No new :attribute selected', // Error message if no photo selected
            'photo.max' => 'The :attribute must not be greater than 2MB'
        ]);


        if ($validator->passes()) { // If Data Validation is passed

            

            $fieldname = $request->fieldname; // Get Field Name


            if($fieldname == "photo") {

                if($request->hasFile($fieldname)) { // If a file is present in Request [POST] Data

                    // Unique Identifier for Profile Photo
                    $unique = bin2hex(random_bytes(3));

                    if($user->$fieldname != "user.jpg") { // If user's profile photo is NOT the default
                        @unlink(public_path('img/users/' . $user->$fieldname)); // Remove user's existing profile photo from directory
                    }

                    $photo = $request->file($fieldname);
                    $filename = $unique . '.' . $photo->getClientOriginalExtension(); // Rename photo to unique identifier + file extension
                    $photo->move(public_path('img/users'), $filename); // Move (upload) file to directory
                    
                    $user->$fieldname = $filename; // Update field name with current file name
                    $data = asset('img/users/' . $user->$fieldname);

                } else {
                    return response()->json(['error'=>'Something went wrong']); // Send Error Response in JSON format to View
                
                }


            } elseif($fieldname == "bank_id") {

                $bank = explode('|', $request->$fieldname);

                $bank_id = $bank[0];

                $user->$fieldname = $bank_id;

                $data = $bank_id . '|' . url('img/banks/' . Bank::find($bank_id)->icon);

            } elseif($fieldname == "new_password") {
                
                $user->password = Hash::make($request->$fieldname);

                $data = '';

            } else {

                // return response()->json(['success'=>'Update successful', 'data'=>$request->account_number]);

                $user->$fieldname = $request->$fieldname; // Set corresponding user's data to provided request [POST] data

                $data = $user->$fieldname;

            }


            $user->save(); // Save Changes to Database
            return response()->json(['success'=>'Update successful', 'data'=>$data]); // Send Success Response + Data in JSON Format to the View
            
        }
        
        // If Validator fails
        return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View
    }


    public function role_edit(Request $request, $id)
    {

        if($id != Auth::id()) {
            $user = User::find($id); // Find and fetch user with matching unique identifier

            if($request->role == 'disable') {
                $user->role = NULL;

            } else {
                $user->role = $request->role;

            }

            $user->save();

            return response()->json(['success'=>'Role updated successfully', 'data'=>$user]);

        } else {
            return response()->json(['error'=>'You cannot edit your own role']); // Send Error Response in JSON Format to the View

        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
