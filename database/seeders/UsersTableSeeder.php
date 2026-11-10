<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
            array(
                0 =>
                array(
                    'id' => 1,
                    'name' => 'pantera',
                    'password' => Hash::make('katasandi'),
                    'email' => 'panterasayangkamu@gmail.com',
                    'role' => 'admin',
                    'email_verified_at' => now(),
                    'remember_token' => NULL,
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
                1 =>
                array(
                    'id' => 2,
                    'name' => 'admin',
                    'password' => Hash::make('katasandi'),
                    'email' => 'admin@growlytics.com',
                    'role' => 'admin',
                    'email_verified_at' => now(),
                    'remember_token' => NULL,
                    'created_at' => now(),
                    'updated_at' => now(),
                )
            )
        );
    }
}
