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
        DB::table('todos')->insert([
            'name' => 'タスク1',
            'deadline' => new DateTime('2024-07-13 00:00:00'),
            'assignee_id' => 1,
            'tag_id' => 2,
            'completed' => false,
            'team_id' => 3,
            'creater_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('todos')->insert([
            'name' => 'タスク2',
            'deadline' => new Datetime('2025-08-18 00:00:00'),
            'assignee_id' => 3,
            'tag_id' => 1,
            'completed' => false,
            'team_id' => null,
            'creater_id' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('todos')->insert([
            'name' => 'タスク3',
            'deadline' => null,
            'assignee_id' => 1,
            'tag_id' => null,
            'completed' => false,
            'team_id' => null,
            'creater_id' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
