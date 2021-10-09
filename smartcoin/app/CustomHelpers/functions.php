<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

// date_default_timezone_set('Africa/Lagos');

// Timeago Function
function timeago( $ptime )
{
    $ptime = strtotime( $ptime );

    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'Year',
                30 * 24 * 60 * 60       =>  'Month',
                24 * 60 * 60            =>  'Day',
                60 * 60                 =>  'Hour',
                60                      =>  'Minute',
                1                       =>  'Second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}



// Wallet QR Code Function
function walletQR($address, $filepath)
{
    QrCode::format('png')->size(1000)->merge('/public/img/logo/smartcoin2.png', .25)->errorCorrection('H')->generate($address, $filepath);

    return true;
}


function currencies() {
    $currencies = [
        "BTC" => [
            "name" => "Bitcoin",
            "icon" => "btc.png",
            "default" => "Paxful"
        ],
        "ETH" => [
            "name" => "Ethereum",
            "icon" => "eth.png",
            "default" => "Paxful"
        ],
        "USDT" => [
            "name" => "Tether",
            "icon" => "usdt.png",
            "default" => "Paxful"
        ],
        "DOGE" => [
            "name" => "Dogecoin",
            "icon" => "doge.png",
            "default" => "Binance"
        ]
    ];

    return $currencies;
}


function platforms() {
    $platforms = ['Paxful', 'Blockchain', 'Binance'];

    return $platforms;
}


function amount($number) {
    return $number = number_format($number, 2, '.', ',');
}


?>