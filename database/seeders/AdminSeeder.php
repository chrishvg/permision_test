<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Admin',
             'last_name' => 'Admin',
             'phone' => '1234567890',
             'email' => 'admin@admin.com',
             'password' => bcrypt('password'),
             'is_admin' => true,
             'is_enabled' => true
            ],
        ]);
    }
}
