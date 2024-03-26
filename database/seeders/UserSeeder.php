<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'Pedro Nhamirre',
                'email' => 'pedrooliv62@gmail.com',
                'password' => bcrypt('pedrinho2003'),
                'role' => 'admin',
                'email_verified_at'=> now()
              
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 4',
                'email' => 'user4@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 5',
                'email' => 'user5@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 6',
                'email' => 'user6@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 7',
                'email' => 'user7@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 8',
                'email' => 'user8@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 9',
                'email' => 'user9@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 10',
                'email' => 'user10@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 11',
                'email' => 'user11@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 12',
                'email' => 'user12@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User 13',
                'email' => 'user13@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email_verified_at'=> now()
            ],
        ]);

    }
}
