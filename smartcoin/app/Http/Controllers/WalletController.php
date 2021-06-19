<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use File;

class WalletController extends Controller
{
    public function __construct() {

        $this->middleware(['auth', 'verified', 'admin']);
        
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
        // ['column_1' => 'required|unique:TableName,column_1,' . $this->id . ',id,colum_2,' . $this->column_2]
        // unique:users,mobile_no,NULL,id,country_id,'.request('country_id')
        
        $platforms = platforms();

        $units = [];
        $currencies = currencies();
        foreach($currencies as $unit => $currency) {
            $units[] = $unit;
        }

        $validator = Validator::make($request->all(), [
            'platform' => ['required', 'string', 'max:100', Rule::in($platforms)],
            'currency' => ['required', 'string', 'max:20', Rule::in($units), 'unique:wallets,currency,NULL,id,platform,' . request('platform')],
            'address' => ['required', 'string', 'max:100', 'unique:wallets,address,NULL,id,currency,' . request('currency')],
            'rate' => ['required', 'numeric'],
        ],
        [
            'address.unique' => 'The wallet :attribute already exists',
            'currency.unique' => request('platform') . ' ' . request('currency'). ' wallet already exists',
            // 'address.unique' => request('platform') . ' ' . request('currency'). ' wallet already exists',
        ]);

        if($validator->passes()) {

            $filename = $request->platform . '_' . $request->currency . '_' . date('d-m-y') . '.png';
            
            if(walletQR($request->address, public_path('img/wallets/' . $filename))) {
                
                $wallet = new Wallet; // Create a new wallet

                $wallet->platform = $request->platform;
                $wallet->currency = $request->currency;
                $wallet->address = $request->address;
                $wallet->rate = $request->rate;
                $wallet->qrcode = $filename;
    
                $wallet->save(); // Save Changes to Database

                // Send currency icon to view
                $wallet->icon = $currencies[$wallet->currency]['icon'];
    
                return response()->json(['success'=>'Wallet created successfully', 'data'=>$wallet]); // Send Success Response + Data in JSON Format to the View
            } else {
                return response()->json(['error'=>'Error generating QR Code']);

            }
            

            
        }

        

        // If Validator fails
        return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View
    }

    public function qr_preview(Request $request) {

        if(walletQR($request->address, public_path('img/wallets/temp/' . $request->address . '.png'))) {

        } else {
            return response()->json(['error'=>'Error generating QR code']);

        }

    }


    public function qr_delete(Request $request) {

        @unlink(public_path('img/wallets/temp/' . $request->address . '.png'));// Remove temporary qr previews

        File::cleanDirectory(public_path('img/wallets/temp/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Wallet $wallet)
    public function destroy($id)
    {
        //
        // return response()->json(['error'=>$id]);
        $wallet = Wallet::find($id); // Find and fetch wallet with matching unique identifier

        if($wallet->delete()) { // If Delete is successful
            @unlink(public_path('img/wallets/' . $wallet->qrcode));

            return response()->json(['success'=>'Wallet deleted successfully']); // Send Success Response in JSON Format to the View

        } else {
            return response()->json(['error'=>'Error deleting wallet']); // Send Error Response in JSON Format to the View

        }
    }
}
