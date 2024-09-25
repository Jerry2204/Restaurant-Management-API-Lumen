<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::create([
            'name' => 'Jerry Andrianto Pangaribuan',
            'email' => 'jerry@example.com',
            'password' => Hash::make('jerry123')
        ]);
    }
}
