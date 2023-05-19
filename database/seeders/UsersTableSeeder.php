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
            'email'      => 'testaccount+100@gmail.com',
            'phone_no'  => 5034324324,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin',
            'ecode'       => '10001',
            'is_regular' => true,
        ]);
        $admin->save();

        $manager = new \App\Models\User([
            'username' => 'manager',
            'email'      => 'testaccount+102@gmail.com',
            'phone_no'  => 5033333332,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'employee',
            'ecode'       => '10002',
            'is_regular' => true,
        ]);
        $manager->save();

        $employee = new \App\Models\User([
            'username' => 'employee',
            'email'      => 'testaccount+101@gmail.com',
            'phone_no'  => 5033333331,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'employee',
            'ecode'       => '10003',
            'is_regular' => true,
            'manager_ecode' => '10002',
        ]);
        $employee->save();

        $probation = new \App\Models\User([
            'username' => 'probation',
            'email'      => 'testaccount+1011@gmail.com',
            'phone_no'  => 5033333311,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'employee',
            'ecode'       => '10004',
            'is_regular' => false,
            'manager_ecode' => '10002',
        ]);
        $probation->save();

        $hr = new \App\Models\User([
            'username' => 'hr',
            'email'      => 'testaccount+103@gmail.com',
            'phone_no'  => 5033333333,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'employee',
            'ecode'       => '10005',
            'is_regular' => true,
        ]);
        $hr->save();
    }
}
