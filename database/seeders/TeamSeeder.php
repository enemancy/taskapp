<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            'name' => 'Aチーム',
            'auth_id' => 1,
        ]);
        DB::table('teams')->insert([
            'name' => 'Bチーム',
            'auth_id' => 2,
        ]);
        DB::table('teams')->insert([
            'name' => 'Cチーム',
            'auth_id' => 3,
        ]);
    }
}
