<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User([
            'username' => 'admin',
            'email'      => 'indemnetest+100@gmail.com',
            'phone_no'  => 5034324324,
            'password'   => bcrypt('admin@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin'
        ]);
        $user->save();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $dummyUser = new \App\Models\User([
                'username' => 'user-'.$i,
                'email'      => 'indemnetest+'.$i.'@gmail.com',
                'phone_no'  => '5034324324'.$i,
                'password'   => bcrypt('admin@112211'),
                'status'     => 'active', // active, disabled, trashed
                'role'       => 'admin'
            ]);
            $dummyUser->save();
        }
    }
}
