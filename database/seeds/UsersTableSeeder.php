<?php

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
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'FSLDK.Admin',
            'username' => 'admin',
            'email' => 'admin@fsldk.com',
            'password' => Hash::make('fsldkmalang'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'FSLDK.Author',
            'username' => 'author',
            'email' => 'author@fsldk.com',
            'password' => Hash::make('authorfsldk'),
        ]);
    }
}
