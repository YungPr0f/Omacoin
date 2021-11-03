<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Bank;
use Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTransaction;
use App\Notifications\TransactionUpdate;


class TransactionController extends Controller
{
    public function __construct() {

        $this->middleware(['auth', 'verified']);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $platforms = platforms();
        array_push($platforms, 'Default');

        $units = [];
        $currencies = currencies();
        foreach($currencies as $unit => $currency) {
            $units[] = $unit;
        }

        $networks = networks();

        $validator = Validator::make($request->all(), [
            'account_number' => ['exclude_if:bank_info,existing', 'required_if:bank_info,new',
                function($attribute, $value, $fail) {
                    $length = strlen((string) $value);
                    
                    if(preg_match('/[^0-9]/', $value) || ($length != 10 && $length != 16)) {
                        $fail('The :attribute must be 10 or 16 digits');
                    }
                }
            ],
            'account_name' => ['exclude_if:bank_info,existing', 'required_if:bank_info,new', 'string', 'min:2', 'max:200'],
            'platform' => ['required', 'string', 'max:100', Rule::in($platforms)],
            'currency' => ['required', 'string', 'max:10', Rule::in($units)],
            'wallet_id' => ['required', 'exists:App\Models\Wallet,id'],
            'crypto_amount' => ['required', 'numeric', 'min:10', 'max:10000'],
            'crypto_receipt' => ['required', 'image', 'max:2048'],
        ],[
            'crypto_receipt.max' => 'The :attribute must not be greater than 2MB'
        ]);

        if($validator->passes()) {

            if($request->hasFile('crypto_receipt')) { // If a file is present in Request [POST] Data

                // Unique Identifier for Receipt
                $unique = bin2hex(random_bytes(4));

                $receipt = $request->file('crypto_receipt');
                $filename = $unique . '.' . $receipt->getClientOriginalExtension(); // Rename receipt to unique identifier + file extension
                $receipt->move(public_path('img/receipts/crypto'), $filename); // Move (upload) file to directory
                
                //
                $wallet = Wallet::find($request->wallet_id);

                $transaction = new Transaction;

                $transaction->ref = $unique;
                $transaction->user_id = Auth::id();

                if($request->bank_info == "existing") {
                    $transaction->bank_id = Auth::user()->bank_id;
                    $transaction->account_number = Auth::user()->account_number;
                    $transaction->account_name = Auth::user()->account_name;

                } elseif($request->bank_info == "new") {
                    $bank = explode('|', $request->bank_id);
                    $bank_id = $bank[0];
                    $transaction->bank_id = $bank_id;

                    $transaction->account_number = $request->account_number;
                    $transaction->account_name = $request->account_name;
                    
                } else {
                    return response()->json(['error'=>'Bank information error']);

                }
                
                $transaction->platform = $request->platform;
                $transaction->currency = $request->currency;
                $transaction->wallet_platform = $wallet->platform;
                $transaction->wallet_currency = $wallet->currency;
                $transaction->wallet_network = $wallet->network;
                $transaction->wallet_address = $wallet->address;
                $transaction->wallet_rate = $wallet->rate;
                $transaction->crypto_amount = $request->crypto_amount;
                $transaction->crypto_receipt = $filename; // Update field name with current file name
                $transaction->status = 'processing';
                $transaction->stage = 'crypto_sent';
                $transaction->updated_by = Auth::id();

                if($transaction->save()) { // Save to Database
                    Notification::route('mail', 'transactions@omacoin.com')->notify(new NewTransaction($transaction));
                    return response()->json(['success'=>'Request submitted successfully']); // Send Success Response + Data in JSON Format to the View

                }

            } else {
                return response()->json(['error'=>'Something went wrong']); // Send Error Response in JSON format to View
            
            }

        }

        // If Validator fails
        return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $transaction = Transaction::find($id);
        $action = $request->action;

        if($action == "confirm_crypto") {
            $transaction->stage = "crypto_received";
            $transaction->updated_by = Auth::id();
            $transaction->save();

            Notification::route('mail', 'transactions@omacoin.com')->notify(new TransactionUpdate($transaction));

            return response()->json(['success'=>'Cryptocurrency confirmed']); // Send Success Response in JSON Format to the View
        
        } elseif($action == "send_naira") {

            $validator = Validator::make($request->all(), [
                'naira_receipt' => ['required', 'image', 'max:2048'],
            ],[
                'naira_receipt.max' => 'The :attribute must not be greater than 2MB'
            ]);

            if($validator->passes()) {
                if($request->hasFile('naira_receipt')) { // If a file is present in Request [POST] Data

                    // Unique Identifier for Receipt
                    $unique = bin2hex(random_bytes(4));
    
                    $receipt = $request->file('naira_receipt');
                    $filename = $unique . '.' . $receipt->getClientOriginalExtension(); // Rename receipt to unique identifier + file extension
                    $receipt->move(public_path('img/receipts/naira'), $filename); // Move (upload) file to directory
                    
                    $transaction->naira_amount = $request->naira_amount;
                    $transaction->naira_receipt = $filename; // Update field name with current file name
                    $transaction->stage = 'naira_sent';
                    $transaction->updated_by = Auth::id();

                    $transaction->save(); // Save to Database

                    Notification::route('mail', 'transactions@omacoin.com')->notify(new TransactionUpdate($transaction));

                    return response()->json(['success'=>'Payment processed successfully']); // Send Success Response + Data in JSON Format to the View
    
                } else {
                    return response()->json(['error'=>'Something went wrong']); // Send Error Response in JSON format to View
                
                }
            }

            // If Validator fails
            return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View

        } elseif($action == "confirm_naira") {
            $transaction->stage = "naira_received";
            $transaction->status = "completed";
            $transaction->updated_by = Auth::id();

            $transaction->save();

            Notification::route('mail', 'transactions@omacoin.com')->notify(new TransactionUpdate($transaction));
            
            return response()->json(['success'=>'Payment confirmed']); // Send Success Response in JSON Format to the View
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
