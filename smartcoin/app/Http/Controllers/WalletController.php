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
            'currency' => ['required', 'string', 'max:10', Rule::in($units), 'unique:wallets,currency,NULL,id,platform,' . request('platform')],
            'address' => ['required', 'string', 'max:100', 'unique:wallets,address,NULL,id,currency,' . request('currency')],
            'address' => ['required', 'string', 'max:100', Rule::unique('wallets')->where(function($query) {
                return $query->where('platform', '!=', request('platform'));
            })],
            'rate' => ['required', 'numeric'],
            'note' => ['nullable', 'string', 'max:500'],
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
                $wallet->note = trim(str_replace('<p>&nbsp;</p>', '', $request->note));
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
    public function update(Request $request, $id)
    {
        //
        $wallet = Wallet::find($id);
        $type = $request->type;

        if($type == 'switch') {

            if($request->status == 'true') {
                $wallet->status = 1;
                $wallet->save();

                return response()->json(['success'=>'Wallet activated']); // Send Success Response in JSON Format to the View

            } else {
                $wallet->status = 0;
                $wallet->save();

                return response()->json(['success'=>'Wallet deactivated']); // Send Success Response in JSON Format to the View

            }
            

        } elseif($type == 'update') {
            $platforms = platforms();

            $units = [];
            $currencies = currencies();
            foreach($currencies as $unit => $currency) {
                $units[] = $unit;
            }

            $validator = Validator::make($request->all(), [
                'platform' => ['required', 'string', 'max:100', Rule::in($platforms)],
                'currency' => ['required', 'string', 'max:10', Rule::in($units), 'unique:wallets,currency,'. $wallet->id .',id,platform,' . request('platform')],
                'address' => ['required', 'string', 'max:100', 'unique:wallets,address,' . $wallet->id . ',id,currency,' . request('currency')],
                'address' => ['required', 'string', 'max:100', Rule::unique('wallets')->ignore($wallet->id)->where(function($query) {
                    return $query->where('platform', '!=', request('platform'));
                })],
                'rate' => ['required', 'numeric'],
                'note' => ['nullable', 'string', 'max:500'],
            ],
            [
                'address.unique' => 'The wallet :attribute already exists',
                'currency.unique' => request('platform') . ' ' . request('currency'). ' wallet already exists',
            ]);


            if($validator->passes()) {

                if($request->address != $wallet->address) {
                    $filename = $request->platform . '_' . $request->currency . '_' . date('d-m-y') . '.png';
                    
                    if(walletQR($request->address, public_path('img/wallets/' . $filename))) {
                        @unlink(public_path('img/wallets/' . $wallet->qrcode));

                        $wallet->qrcode = $filename;
                        $wallet->address = $request->address;

                    } else {
                        return response()->json(['error'=>'Error generating QR Code']);
        
                    }

                }

                // $wallet->platform = $request->platform;
                // $wallet->currency = $request->currency;
                
                $wallet->rate = $request->rate;
                $wallet->note = trim(str_replace('<p>&nbsp;</p>', '', $request->note));
                
                $wallet->save(); // Save Changes to Database
        
                // Send currency icon to view
                $wallet->icon = $currencies[$wallet->currency]['icon'];
            
                return response()->json(['success'=>'Wallet updated successfully', 'data'=>$wallet]); // Send Success Response + Data in JSON Format to the View
    
                
            }

            // If Validator fails
            return response()->json(['error'=>$validator->errors()->all()]); // Send Error Response in JSON format to View


        } else {
            return response()->json(['error'=>'Invalid update request']); // Send Error Response in JSON Format to the View
        
        }
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
