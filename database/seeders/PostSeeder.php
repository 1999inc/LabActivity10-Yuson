<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)
            ->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::create([
            'title' => 'Purok Yuson Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Recruiting new volunteers for the upcoming clean-up drive in Purok Yuson. Join us in making our community cleaner and greener!',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-05-23 10:00:00',
            'author_id' => Author::where('email', 'kagawad.yuson@bulletin.test')->firstOrFail()->id,
        ]);
    }
}
