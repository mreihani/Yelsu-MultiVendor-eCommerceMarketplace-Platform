<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            //Admin
            'firstname' => 'AdminName',
            'lastname' => 'AdminFamilyName',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('mOn^@OW5RqrMLPYi3$$sAlX'),
            'role' => 'admin',
            'status' => 'active'
            ],
            //Vendor
            ['firstname' => 'Vendorname',
            'lastname' => 'VendorFamilyName',
            'username' => 'vendor',
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'vendor',
            'status' => 'active'
            ],
            //User
            ['firstname' => 'UserName',
            'lastname' => 'UserFamilyName',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'user',
            'status' => 'active'
            ]
        ]);
    }
}
