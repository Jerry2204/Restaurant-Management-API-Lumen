<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->insert([
            [
                'table_number' => 1
            ],
            [
                'table_number' => 2
            ],
            [
                'table_number' => 3
            ],
            [
                'table_number' => 4
            ],
            [
                'table_number' => 5
            ],
        ]);
    }
}
