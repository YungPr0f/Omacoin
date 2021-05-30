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
                'surname' => 'SmartCoin',
                'firstname' => 'Administrator',
                'email' => 'admin@smartcoin.com',
                'phone_number' => '08012345678',
                'photo' => 'c538b6.png',
                'bank_id' => 19,
                'account_number' => '0808080808',
                'account_name' => 'Smartcoin Administrator',
                'email_verified_at' => '2021-04-12 23:26:19',
                'password' => '$2y$10$tn9U45CEnOpktwCTlAmycekLUZKv07DS8HqKsFPV6TSm8z66In50q',
                'remember_token' => '4cg2EzNUXqQCP0TuVgQrv54zerz4aIytLqAY0qbFKkXb35uolmvK5BqSjv5s',
                'created_at' => '2021-04-12 23:25:59',
                'updated_at' => '2021-05-08 17:10:14',
            ),
        ));
        
        
    }
}