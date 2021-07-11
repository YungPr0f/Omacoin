<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallets')->delete();
        
        \DB::table('wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'platform' => 'Paxful',
                'currency' => 'USDT',
                'address' => '0x5AF01DF4a7fA1F81262A0B89940479A21b4569e7',
                'rate' => 0,
                'qrcode' => 'Paxful_USDT_17-06-21.png',
                'created_at' => '2021-06-17 01:22:24',
                'updated_at' => '2021-06-17 01:22:24',
            ),
            1 => 
            array (
                'id' => 2,
                'platform' => 'Paxful',
                'currency' => 'ETH',
                'address' => '0x5AF01DF4a7fA1F81262A0B89940479A21b4569e7',
                'rate' => 0,
                'qrcode' => 'Paxful_ETH_17-06-21.png',
                'created_at' => '2021-06-17 01:22:42',
                'updated_at' => '2021-06-17 01:22:42',
            ),
            2 => 
            array (
                'id' => 3,
                'platform' => 'Binance',
                'currency' => 'BTC',
                'address' => '1MQxRwe8dpsoD6875RCLe5VeoX8Qdfj73X',
                'rate' => 0,
                'qrcode' => 'Binance_BTC_17-06-21.png',
                'created_at' => '2021-06-17 01:23:07',
                'updated_at' => '2021-06-17 01:23:07',
            ),
            3 => 
            array (
                'id' => 4,
                'platform' => 'Binance',
                'currency' => 'USDT',
                'address' => '0x600e1b4cd97a48eb62aaebbe062c5c83a28198e6',
                'rate' => 0,
                'qrcode' => 'Binance_USDT_17-06-21.png',
                'created_at' => '2021-06-17 01:23:33',
                'updated_at' => '2021-06-17 01:23:33',
            ),
            4 => 
            array (
                'id' => 5,
                'platform' => 'Blockchain',
                'currency' => 'BTC',
                'address' => '1GdLqHLCTadpnCQp4Nb6UrLaJ5GupYKdPL',
                'rate' => 0,
                'qrcode' => 'Blockchain_BTC_17-06-21.png',
                'created_at' => '2021-06-17 01:23:54',
                'updated_at' => '2021-06-17 01:23:54',
            ),
            5 => 
            array (
                'id' => 6,
                'platform' => 'Binance',
                'currency' => 'DOGE',
                'address' => 'DPKQB6cAbP9GMoPejQh8RJDtkhje4Rk43A',
                'rate' => 0,
                'qrcode' => 'Binance_DOGE_17-06-21.png',
                'created_at' => '2021-06-17 07:37:27',
                'updated_at' => '2021-06-17 07:37:27',
            ),
        ));
        
        
    }
}