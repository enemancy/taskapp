<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'aaa',
            'email' => 'aaa@example.com',
            'password' => 'aaaaaaaa',
        ]);

        DB::table('todos')->insert([
            'name' => 'タスク1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'assignee_id' => 1,
        ]);
        DB::table('todos')->insert([
            'name' => 'タスク2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            // 'assignee_id' => 1,
        ]);
        DB::table('todos')->insert([
            'name' => 'タスク3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'assignee_id' => 1,
        ]);
    }
}
