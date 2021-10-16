<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banks')->delete();
        
        \DB::table('banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bank Name',
                'slug' => '',
                'code' => '',
                'icon' => 'bank.jpg',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Abbey Mortgage Bank',
                'slug' => 'abbey-mortgage-bank',
                'code' => '801',
                'icon' => 'abbey-mortgage-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Access Bank',
                'slug' => 'access-bank',
                'code' => '044',
                'icon' => 'access-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'Access Bank (Diamond)',
                'slug' => 'access-bank-diamond',
                'code' => '063',
                'icon' => 'access-bank-diamond.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'ALAT by WEMA',
                'slug' => 'alat-by-wema',
                'code' => '035A',
                'icon' => 'alat-by-wema.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'ASO Savings and Loans',
                'slug' => 'asosavings',
                'code' => '401',
                'icon' => 'asosavings.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bowen Microfinance Bank',
                'slug' => 'bowen-microfinance-bank',
                'code' => '50931',
                'icon' => 'bowen-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'CEMCS Microfinance Bank',
                'slug' => 'cemcs-microfinance-bank',
                'code' => '50823',
                'icon' => 'cemcs-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Citibank Nigeria',
                'slug' => 'citibank-nigeria',
                'code' => '023',
                'icon' => 'citibank-nigeria.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Coronation Merchant Bank',
                'slug' => 'coronation-merchant-bank',
                'code' => '559',
                'icon' => 'coronation-merchant-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Ecobank Nigeria',
                'slug' => 'ecobank-nigeria',
                'code' => '050',
                'icon' => 'ecobank-nigeria.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Ekondo Microfinance Bank',
                'slug' => 'ekondo-microfinance-bank',
                'code' => '562',
                'icon' => 'ekondo-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Eyowo',
                'slug' => 'eyowo',
                'code' => '50126',
                'icon' => 'eyowo.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Fidelity Bank',
                'slug' => 'fidelity-bank',
                'code' => '070',
                'icon' => 'fidelity-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'First Bank of Nigeria',
                'slug' => 'first-bank-of-nigeria',
                'code' => '011',
                'icon' => 'first-bank-of-nigeria.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'First City Monument Bank',
                'slug' => 'first-city-monument-bank',
                'code' => '214',
                'icon' => 'first-city-monument-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'FSDH Merchant Bank Limited',
                'slug' => 'fsdh-merchant-bank-limited',
                'code' => '501',
                'icon' => 'fsdh-merchant-bank-limited.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Globus Bank',
                'slug' => 'globus-bank',
                'code' => '00103',
                'icon' => 'globus-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Guaranty Trust Bank',
                'slug' => 'guaranty-trust-bank',
                'code' => '058',
                'icon' => 'guaranty-trust-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Hackman Microfinance Bank',
                'slug' => 'hackman-microfinance-bank',
                'code' => '51251',
                'icon' => 'hackman-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Hasal Microfinance Bank',
                'slug' => 'hasal-microfinance-bank',
                'code' => '50383',
                'icon' => 'hasal-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Heritage Bank',
                'slug' => 'heritage-bank',
                'code' => '030',
                'icon' => 'heritage-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Ibile Microfinance Bank',
                'slug' => 'ibile-mfb',
                'code' => '51244',
                'icon' => 'ibile-mfb.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Infinity MFB',
                'slug' => 'infinity-mfb',
                'code' => '50457',
                'icon' => 'infinity-mfb.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Jaiz Bank',
                'slug' => 'jaiz-bank',
                'code' => '301',
                'icon' => 'jaiz-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Keystone Bank',
                'slug' => 'keystone-bank',
                'code' => '082',
                'icon' => 'keystone-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Kuda Bank',
                'slug' => 'kuda-bank',
                'code' => '50211',
                'icon' => 'kuda-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Lagos Building Investment Company Plc.',
                'slug' => 'lbic-plc',
                'code' => '90052',
                'icon' => 'lbic-plc.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Mayfair MFB',
                'slug' => 'mayfair-mfb',
                'code' => '50563',
                'icon' => 'mayfair-mfb.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'One Finance',
                'slug' => 'one-finance',
                'code' => '565',
                'icon' => 'one-finance.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'PalmPay',
                'slug' => 'palmpay',
                'code' => '999991',
                'icon' => 'palmpay.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Parallex Bank',
                'slug' => 'parallex-bank',
                'code' => '526',
                'icon' => 'parallex-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Parkway - ReadyCash',
                'slug' => 'parkway-ready-cash',
                'code' => '311',
                'icon' => 'parkway-ready-cash.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Paycom',
                'slug' => 'paycom',
                'code' => '999992',
                'icon' => 'paycom.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Petra Mircofinance Bank Plc',
                'slug' => 'petra-microfinance-bank-plc',
                'code' => '50746',
                'icon' => 'petra-microfinance-bank-plc.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Polaris Bank',
                'slug' => 'polaris-bank',
                'code' => '076',
                'icon' => 'polaris-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Providus Bank',
                'slug' => 'providus-bank',
                'code' => '101',
                'icon' => 'providus-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Rand Merchant Bank',
                'slug' => 'rand-merchant-bank',
                'code' => '502',
                'icon' => 'rand-merchant-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Rubies MFB',
                'slug' => 'rubies-mfb',
                'code' => '125',
                'icon' => 'rubies-mfb.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Sparkle Microfinance Bank',
                'slug' => 'sparkle-microfinance-bank',
                'code' => '51310',
                'icon' => 'sparkle-microfinance-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Stanbic IBTC Bank',
                'slug' => 'stanbic-ibtc-bank',
                'code' => '221',
                'icon' => 'stanbic-ibtc-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Standard Chartered Bank',
                'slug' => 'standard-chartered-bank',
                'code' => '068',
                'icon' => 'standard-chartered-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Sterling Bank',
                'slug' => 'sterling-bank',
                'code' => '232',
                'icon' => 'sterling-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Suntrust Bank',
                'slug' => 'suntrust-bank',
                'code' => '100',
                'icon' => 'suntrust-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'TAJ Bank',
                'slug' => 'taj-bank',
                'code' => '302',
                'icon' => 'taj-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'TCF MFB',
                'slug' => 'tcf-mfb',
                'code' => '51211',
                'icon' => 'tcf-mfb.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Titan Trust Bank',
                'slug' => 'titan-trust-bank',
                'code' => '102',
                'icon' => 'titan-trust-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Union Bank of Nigeria',
                'slug' => 'union-bank-of-nigeria',
                'code' => '032',
                'icon' => 'union-bank-of-nigeria.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'United Bank For Africa',
                'slug' => 'united-bank-for-africa',
                'code' => '033',
                'icon' => 'united-bank-for-africa.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Unity Bank',
                'slug' => 'unity-bank',
                'code' => '215',
                'icon' => 'unity-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'VFD Microfinance Bank Limited',
                'slug' => 'vfd',
                'code' => '566',
                'icon' => 'vfd.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Wema Bank',
                'slug' => 'wema-bank',
                'code' => '035',
                'icon' => 'wema-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Zenith Bank',
                'slug' => 'zenith-bank',
                'code' => '057',
                'icon' => 'zenith-bank.png',
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ),
        ));
        
        
    }
}