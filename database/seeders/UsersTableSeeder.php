<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name'      => 'Admin',
                'username'  => 'admin',
                'email'     => 'admin@mail.com',
                'password'  => Hash::make('admin123'),
                'role'      => 'admin',
                'status'    => 'Active',
            ],
            //Agent
            [
                'name'      => 'Agent',
                'username'  => 'agent',
                'email'     => 'agent@mail.com',
                'password'  => Hash::make('agent123'),
                'role'      => 'agent',
                'status'    => 'Active',
            ],
            //User
            [
                'name'      => 'User',
                'username'  => 'user',
                'email'     => 'user@mail.com',
                'password'  => Hash::make('user123'),
                'role'      => 'user',
                'status'    => 'Active',
            ],
        ]);
    }
}
