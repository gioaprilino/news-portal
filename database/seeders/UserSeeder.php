<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
                User::create([
                    "name"=> "admin",
                    "email"=> "admin@example.com",
                    "email_verified_at"=> now(),
                    "password"=> Hash::make("admin"),
                    "role"=> "admin",
                ]);
        
                User::create([
                    "name"=> "User",
                    "email"=> "user@example.com",
                    "email_verified_at"=> now(),
                    "password"=> Hash::make("user"),
                    "role"=> "user",
                ]);
    }
}
