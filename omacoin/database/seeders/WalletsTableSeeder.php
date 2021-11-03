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
                'platform' => 'Binance',
                'currency' => 'USDT',
                'network' => 'ERC20',
                'address' => '0x600e1b4cd97a48eb62aaebbe062c5c83a28198e6',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_USDT_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 10:59:49',
                'updated_at' => '2021-11-03 10:59:49',
            ),
            1 => 
            array (
                'id' => 2,
                'platform' => 'Binance',
                'currency' => 'USDT',
                'network' => 'BEP2',
                'address' => 'bnb136ns6lfw4zs5hg4n85vdthaad7hq5m4gtkgf23',
                'rate' => 540,
                'note' => '<p>USDT Memo: 403905512</p>',
                'qrcode' => 'Binance_USDT_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:04:14',
                'updated_at' => '2021-11-03 11:04:14',
            ),
            2 => 
            array (
                'id' => 3,
                'platform' => 'Binance',
                'currency' => 'USDT',
                'network' => 'BEP20',
                'address' => '0x600e1b4cd97a48eb62aaebbe062c5c83a28198e6',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_USDT_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:05:12',
                'updated_at' => '2021-11-03 11:05:12',
            ),
            3 => 
            array (
                'id' => 4,
                'platform' => 'Binance',
                'currency' => 'USDT',
                'network' => 'TRC20',
                'address' => 'TTRz3Pq9YwZ1qv92VXFViSnFLuzPPTC9PR',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_USDT_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:06:04',
                'updated_at' => '2021-11-03 11:06:04',
            ),
            4 => 
            array (
                'id' => 5,
                'platform' => 'Binance',
                'currency' => 'BTC',
                'network' => NULL,
                'address' => '1MQxRwe8dpsoD6875RCLe5VeoX8Qdfj73X',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_BTC_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:06:50',
                'updated_at' => '2021-11-03 11:06:50',
            ),
            5 => 
            array (
                'id' => 6,
                'platform' => 'Binance',
                'currency' => 'DOGE',
                'network' => NULL,
                'address' => 'DPKQB6cAbP9GMoPejQh8RJDtkhje4Rk43A',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_DOGE_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:07:24',
                'updated_at' => '2021-11-03 11:07:24',
            ),
            6 => 
            array (
                'id' => 7,
                'platform' => 'Binance',
                'currency' => 'ETH',
                'network' => 'ERC20',
                'address' => '0x600e1b4cd97a48eb62aaebbe062c5c83a28198e6',
                'rate' => 530,
                'note' => '',
                'qrcode' => 'Binance_ETH_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:08:02',
                'updated_at' => '2021-11-03 11:08:02',
            ),
            7 => 
            array (
                'id' => 8,
                'platform' => 'Binance',
                'currency' => 'BNB',
                'network' => 'BEP2',
                'address' => 'bnb136ns6lfw4zs5hg4n85vdthaad7hq5m4gtkgf23',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Binance_BNB_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:09:40',
                'updated_at' => '2021-11-03 11:09:40',
            ),
            8 => 
            array (
                'id' => 9,
                'platform' => 'Paxful',
                'currency' => 'BTC',
                'network' => NULL,
                'address' => '3PYiLU3Bv5prf65wspZngngKt5E4ih32VM',
                'rate' => 540,
                'note' => '',
                'qrcode' => 'Paxful_BTC_03-11-21.png',
                'status' => 0,
                'created_at' => '2021-11-03 11:31:13',
                'updated_at' => '2021-11-03 11:31:13',
            ),
        ));
        
        
    }
}