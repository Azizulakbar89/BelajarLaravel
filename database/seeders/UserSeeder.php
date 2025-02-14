<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->truncate();
        User::factory()
            ->count(10)
            ->create();
        // DB::table("users")->insert([
        //     "name" => Str::random(10),
        //     'username' => Str::random(10),
        //     "email" => Str::random(10) . '@example.com',
        //     "password" => bcrypt("password"),
        // ]);
    }
}
