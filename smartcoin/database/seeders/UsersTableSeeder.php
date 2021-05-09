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
                'email_verified_at' => '2021-04-12 23:26:19',
                'password' => '$2y$10$oOLqLi0hgKmEJSArULRMZuN0dvVSO2wp2fxRM3vNMJRX83SyYsRy6',
                'remember_token' => '4cg2EzNUXqQCP0TuVgQrv54zerz4aIytLqAY0qbFKkXb35uolmvK5BqSjv5s',
                'created_at' => '2021-04-12 23:25:59',
                'updated_at' => '2021-04-12 23:27:32',
            ),
        ));
        
        
    }
}