<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Post,
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ini_set('memory_limit', '-1');

        $countUsers = 500;
        $countPosts = $countUsers * 5;

        $users = User::factory($countUsers)->make();
        $chunks = $users->chunk(100);
        $chunks->each(function ($chunk) {
            User::insert($chunk->toArray());
        });

        $posts = Post::factory($countPosts)->make();
        $chunks = $posts->chunk(500);
        $chunks->each(function ($chunk) {
            Post::insert($chunk->toArray());
        });
    }
}
