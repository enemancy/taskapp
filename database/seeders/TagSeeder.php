<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            'name' => '準備',
            'colorcode' => '#FF0000',
        ]);
        DB::table('tags')->insert([
            'name' => '開発',
            'colorcode' => '#00FF00',
        ]);
        DB::table('tags')->insert([
            'name' => 'テスト',
            'colorcode' => '#0000FF',
        ]);
        DB::table('tags')->insert([
            'name' => 'リリース',
            'colorcode' => '#000000',
        ]);
        DB::table('tags')->insert([
            'name' => 'その他',
            'colorcode' => '#FFFFFF',
        ]);
    }
}
