<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transactions')->delete();
        
        \DB::table('transactions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ref' => '26775545',
                'user_id' => 1,
                'platform' => 'Default',
                'currency' => 'DOGE',
                'wallet_platform' => 'Binance',
                'wallet_currency' => 'DOGE',
                'wallet_address' => 'DPKQB6cAbP9GMoPejQh8RJDtkhje4Rk43A',
                'wallet_rate' => '200.00',
                'crypto_amount' => '111.00',
                'crypto_receipt' => '26775545.PNG',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_received',
                'created_at' => '2021-09-26 13:35:00',
                'updated_at' => '2021-10-03 11:00:28',
            ),
            1 => 
            array (
                'id' => 2,
                'ref' => '06b5fd74',
                'user_id' => 1,
                'platform' => 'Default',
                'currency' => 'ETH',
                'wallet_platform' => 'Paxful',
                'wallet_currency' => 'ETH',
                'wallet_address' => '0x5AF01DF4a7fA1F81262A0B89940479A21b4569e7',
                'wallet_rate' => '420.00',
                'crypto_amount' => '243.00',
                'crypto_receipt' => '06b5fd74.png',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_sent',
                'created_at' => '2021-09-25 17:10:00',
                'updated_at' => '2021-10-03 10:49:04',
            ),
            2 => 
            array (
                'id' => 3,
                'ref' => 'c7564c90',
                'user_id' => 1,
                'platform' => 'Paxful',
                'currency' => 'USDT',
                'wallet_platform' => 'Paxful',
                'wallet_currency' => 'USDT',
                'wallet_address' => '0x5AF01DF4a7fA1F81262A0B89940479A21b4569e7',
                'wallet_rate' => '416.00',
                'crypto_amount' => '700.50',
                'crypto_receipt' => 'c7564c90.PNG',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'naira_sent',
                'created_at' => '2021-09-25 16:56:31',
                'updated_at' => '2021-09-25 20:50:00',
            ),
            3 => 
            array (
                'id' => 4,
                'ref' => 'cbcba568',
                'user_id' => 1,
                'platform' => 'Blockchain',
                'currency' => 'BTC',
                'wallet_platform' => 'Blockchain',
                'wallet_currency' => 'BTC',
                'wallet_address' => '1GdLqHLCTadpnCQp4Nb6UrLaJ5GupYKdPL',
                'wallet_rate' => '467.00',
                'crypto_amount' => '4300.00',
                'crypto_receipt' => 'cbcba568.png',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'naira_received',
                'created_at' => '2021-07-18 17:03:34',
                'updated_at' => '2021-07-18 17:03:34',
            ),
            4 => 
            array (
                'id' => 5,
                'ref' => '21f0e93c',
                'user_id' => 1,
                'platform' => 'Blockchain',
                'currency' => 'BTC',
                'wallet_platform' => 'Blockchain',
                'wallet_currency' => 'BTC',
                'wallet_address' => '1GdLqHLCTadpnCQp4Nb6UrLaJ5GupYKdPL',
                'wallet_rate' => '467.00',
                'crypto_amount' => '1350.00',
                'crypto_receipt' => '21f0e93c.png',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_received',
                'created_at' => '2021-07-18 17:03:55',
                'updated_at' => '2021-10-03 10:28:32',
            ),
            5 => 
            array (
                'id' => 6,
                'ref' => '7ac88deb',
                'user_id' => 1,
                'platform' => 'Paxful',
                'currency' => 'USDT',
                'wallet_platform' => 'Paxful',
                'wallet_currency' => 'USDT',
                'wallet_address' => '0x5AF01DF4a7fA1F81262A0B89940479A21b4569e7',
                'wallet_rate' => '416.00',
                'crypto_amount' => '4678.00',
                'crypto_receipt' => '7ac88deb.png',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_received',
                'created_at' => '2021-07-18 17:04:17',
                'updated_at' => '2021-10-03 08:54:53',
            ),
            6 => 
            array (
                'id' => 7,
                'ref' => '44f15afe',
                'user_id' => 1,
                'platform' => 'Default',
                'currency' => 'DOGE',
                'wallet_platform' => 'Binance',
                'wallet_currency' => 'DOGE',
                'wallet_address' => 'DPKQB6cAbP9GMoPejQh8RJDtkhje4Rk43A',
                'wallet_rate' => '200.00',
                'crypto_amount' => '200.00',
                'crypto_receipt' => '44f15afe.jpg',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_received',
                'created_at' => '2021-09-25 15:10:00',
                'updated_at' => '2021-07-24 17:47:06',
            ),
            7 => 
            array (
                'id' => 8,
                'ref' => '2610e536',
                'user_id' => 1,
                'platform' => 'Default',
                'currency' => 'DOGE',
                'wallet_platform' => 'Binance',
                'wallet_currency' => 'DOGE',
                'wallet_address' => 'DPKQB6cAbP9GMoPejQh8RJDtkhje4Rk43A',
                'wallet_rate' => '200.00',
                'crypto_amount' => '50.00',
                'crypto_receipt' => '2610e536.PNG',
                'naira_amount' => NULL,
                'naira_receipt' => NULL,
                'status' => 'processing',
                'stage' => 'crypto_received',
                'created_at' => '2021-09-29 00:08:37',
                'updated_at' => '2021-10-03 08:52:53',
            ),
        ));
        
        
    }
}