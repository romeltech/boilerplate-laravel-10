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
        $admin = new \App\Models\User([
            'username' => 'admin',
            'email'      => 'indemnetest+100@gmail.com',
            'phone_no'  => 5034324324,
            'password'   => bcrypt('admin@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin'
        ]);
        $admin->save();

        $normal = new \App\Models\User([
            'username' => 'normal',
            'email'      => 'indemnetest+101@gmail.com',
            'phone_no'  => 5033333333,
            'password'   => bcrypt('admin@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'normal'
        ]);
        $normal->save();
    }
}
