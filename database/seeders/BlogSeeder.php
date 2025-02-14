<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("blogs")->truncate();

        Blog::factory()
            ->count(10)
            ->create();

        // DB::table("blog")->insert([
        //     "title" => 'blog2',
        //     "description" => 'desc1',
        // ]);

        // DB::table("blog")->insert([
        //     "title" => 'blog3',
        //     "description" => 'desc1',
        // ]);

        // DB::table("blog")->insert([
        //     "title" => 'blog5',
        //     "description" => 'desc1',
        // ]);

        // DB::table("blog")->insert([
        //     "title" => 'blog7',
        //     "description" => 'desc1',
        // ]);
    }
}
