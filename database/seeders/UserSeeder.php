<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'aaa',
            'email' => 'aaa@example.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'yuuya',
            'email' => 'yuuya@example.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'tester',
            'email' => 'tester@example.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'developer',
            'email' => 'developer@example.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'author',
            'email' => 'author@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
