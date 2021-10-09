<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Wallet;
use App\Models\User;
use Auth;

class TransactionController extends Controller
{
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

        $validator = Validator::make($request->all(), [
            'bank_id' => ['required', 'exists:App\Models\Bank,id'],
            'account_number' => ['sometimes', 'required',
                function($attribute, $value, $fail) {
                    $length = strlen((string) $value);
                    
                    if(preg_match('/[^0-9]/', $value) || ($length != 10 && $length != 16)) {
                        $fail('The :attribute must be 10 or 16 digits');
                    }
                }
            ],
            'account_name' => ['sometimes', 'required', 'string', 'min:2', 'max:200'],
            'platform' => ['required', 'string', 'max:100', Rule::in($platforms)],
            'currency' => ['required', 'string', 'max:10', Rule::in($units)],
            'wallet_id' => ['required', 'exists:App\Models\Wallet,id'],
            'amount' => ['required', 'numeric', 'min:10', 'max:10000'],
            'receipt' => ['required', 'image', 'max:2048'],
        ],[
            'receipt.max' => 'The :attribute must not be greater than 2MB'
        ]);

        if($validator->passes()) {

            if($request->hasFile('receipt')) { // If a file is present in Request [POST] Data

                // Unique Identifier for Receipt
                $unique = bin2hex(random_bytes(4));

                $receipt = $request->file('receipt');
                $filename = $unique . '.' . $receipt->getClientOriginalExtension(); // Rename receipt to unique identifier + file extension
                $receipt->move(public_path('img/receipts'), $filename); // Move (upload) file to directory
                
                //
                $wallet = Wallet::find($request->wallet_id);

                $transaction = new Transaction;

                $transaction->ref = $unique;
                $transaction->user_id = Auth::id();
                $transaction->bank_id = $request->bank_id;
                $transaction->account_number = $request->account_number;
                $transaction->account_name = $request->account_name;
                $transaction->platform = $request->platform;
                $transaction->currency = $request->currency;
                $transaction->wallet_platform = $wallet->platform;
                $transaction->wallet_currency = $wallet->currency;
                $transaction->wallet_address = $wallet->address;
                $transaction->wallet_rate = $wallet->rate;
                $transaction->crypto_amount = $request->amount;
                $transaction->crypto_receipt = $filename; // Update field name with current file name
                $transaction->status = 'processing';
                $transaction->stage = 'crypto_sent';

                $transaction->save(); // Save to Database
                return response()->json(['success'=>'Request submitted successfully']); // Send Success Response + Data in JSON Format to the View

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
            $transaction->save();

            return response()->json(['success'=>'Cryptocurrency confirmed']); // Send Success Response in JSON Format to the View
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
