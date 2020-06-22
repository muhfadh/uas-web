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
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@blog.com',
            'password' => Hash::make('rahasia'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Fadhlan',
            'username' => 'fadh',
            'email' => 'fadhlan@umm.ac.id',
            'password' => Hash::make('rahasiabanget'),
        ]);
    }
}
