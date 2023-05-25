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
            'role'       => 'app_admin',
            'ecode'       => '10001',
            'is_regular' => true,
        ]);
        $admin->save();

        $employee = new \App\Models\User([
            'username' => 'normal',
            'email'      => 'testaccount+101@gmail.com',
            'phone_no'  => 5033333331,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'normal',
            'ecode'       => '10002',
            'is_regular' => true,
            'superior_ecode' => '10003',
        ]);
        $employee->save();

        $manager = new \App\Models\User([
            'username' => 'manager',
            'email'      => 'testaccount+102@gmail.com',
            'phone_no'  => 5033333332,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'normal',
            'ecode'       => '10003',
            'is_regular' => true,
        ]);
        $manager->save();

        $probation = new \App\Models\User([
            'username' => 'probation',
            'email'      => 'testaccount+1011@gmail.com',
            'phone_no'  => 5033333311,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'normal',
            'ecode'       => '10004',
            'is_regular' => false,
            'superior_ecode' => '10003',
        ]);
        $probation->save();

        $hr = new \App\Models\User([
            'username' => 'hr_admin',
            'email'      => 'testaccount+103@gmail.com',
            'phone_no'  => 5033333333,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'hr_admin',
            'ecode'       => '10005',
            'is_regular' => true,
        ]);
        $hr->save();

        $hrbp = new \App\Models\User([
            'username' => 'hrbp',
            'email'      => 'testaccount+104@gmail.com',
            'phone_no'  => 5034324325,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'hrbp',
            'ecode'       => '10006',
            'is_regular' => true,
        ]);
        $hrbp->save();
    }
}
