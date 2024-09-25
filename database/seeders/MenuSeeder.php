<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Chicken Katsu Curry Rice',
                'description' => 'Nasi putih yang dicampur dengan kari yang lezat dan ditambah dengan chicken katsu yang gurih',
                'price' => 54000,
                'category' => 'food'
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Beef Katsu Curry Rice',
                'description' => 'Nasi putih yang dicampur dengan kari yang lezat dan ditambah dengan beef katsu yang gurih',
                'price' => 64000,
                'category' => 'food'
            ],
        ]);
    }
}
