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
                'role' => 'superadmin',
                'surname' => 'Omacoin',
                'firstname' => 'Super Administrator',
                'email' => 'superadmin@omacoin.com.ng',
                'phone_number' => '08081273542',
                'photo' => 'user.jpg',
                'bank_id' => 1,
                'account_number' => NULL,
                'account_name' => NULL,
                'email_verified_at' => '2021-11-03 10:15:18',
                'password' => '$2y$10$vGLyAJ9kcTyPa/h2YLIjlOHo9hmY0fK2bblQSI9Lht/hSjom1Z5Sy',
                'remember_token' => NULL,
                'created_at' => '2021-11-03 10:06:19',
                'updated_at' => '2021-11-03 10:15:18',
            ),
        ));
        
        
    }
}