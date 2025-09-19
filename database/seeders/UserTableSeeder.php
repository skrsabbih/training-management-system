<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'status'=>'1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trainer User',
                'email' => 'trainer@trainer.com',
                'password' => bcrypt('password'),
                'status'=>'1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trainee User',
                'email' => 'trainee@trainee.com',
                'password' => bcrypt('password'),
                'status'=>'1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
