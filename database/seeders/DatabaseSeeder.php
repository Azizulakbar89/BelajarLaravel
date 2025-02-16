<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //cara menghapus semua seeder yang sudah ada
        $this->call([
            UserSeeder::class,
            BlogSeeder::class, // Panggil BlogSeeder
        ]);
    }
}
