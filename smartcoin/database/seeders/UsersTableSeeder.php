<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role' => 'member',
                'surname' => 'SmartCoin',
                'firstname' => 'Member',
                'email' => 'member@smartcoin.com',
                'phone_number' => '08012345678',
                'photo' => 'd2178c.jpg',
                'bank_id' => 22,
                'account_number' => '0808080808',
                'account_name' => 'Smartcoin Member',
                'email_verified_at' => '2021-04-12 23:26:19',
                'password' => '$2y$10$09WdogOd60r7vXRrJPPyouRh6Vl93vTeYqzFvN9MWiWiZpOGtq86q',
                'remember_token' => '3ZyLSq04LgL5xjk7LnSf8gReHOyl0tKddcGtfyL1Uqxfwb8jJfcX5hi78gpt',
                'created_at' => '2021-04-12 23:25:59',
                'updated_at' => '2021-06-11 01:17:05',
            ),
            1 => 
            array (
                'id' => 2,
                'role' => 'admin',
                'surname' => 'SmartCoin',
                'firstname' => 'Administrator',
                'email' => 'admin@smartcoin.com',
                'phone_number' => '08012345679',
                'photo' => 'user.jpg',
                'bank_id' => 1,
                'account_number' => NULL,
                'account_name' => NULL,
                'email_verified_at' => '2021-05-29 21:37:11',
                'password' => '$2y$10$w3ib.QXiqKL9KA9if6DUsuW2ltbGztkr.DL2xfrWsWUfL1P9LXMT2',
                'remember_token' => 'QEpxAz5sfbNJLwOhwh0OUzfeqgt4HV0QKRFtys9GI8p7K7Hse7qpXJJid5Uy',
                'created_at' => '2021-05-27 17:23:04',
                'updated_at' => '2021-05-29 21:37:11',
            ),
        ));
        
        
    }
}