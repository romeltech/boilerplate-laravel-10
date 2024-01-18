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
            'email'      => 'romel.i@gagroup.net',
            'phone_no'  => 5034324324,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'admin' // admin, normal, manager,
        ]);
        $user->save();
        $user->profile()->create([
            'full_name' => 'Romel Indemne'
        ]);

        $normal = new \App\Models\User([
            'username' => 'normal',
            'email'      => 'normal@gagroup.net',
            'phone_no'  => 5034324324,
            'password'   => bcrypt('gag@112211'),
            'status'     => 'active', // active, disabled, trashed
            'role'       => 'normal' // admin, normal, manager,
        ]);
        $normal->save();
    }
}
