<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        DB::table('users')->insert([
            [
                'full_name'=>'rush-perfumery',
                'user_name'=>'admin',
                'email'=>'info@rushperfumery.net',
                'password'=>Hash::make('123456'),
                'role'=>'admin',
                'status'=>'active',
                
            ] ,
        ]);
    }
}
