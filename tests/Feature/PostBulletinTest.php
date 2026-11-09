<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Post;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostBulletinTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_redirects_to_the_published_posts(): void
    {
        $this->get('/')
            ->assertRedirect(route('posts.index'));
    }

    public function test_database_seeder_creates_the_required_bulletin_records(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('authors', 5);
        $this->assertDatabaseCount('posts', 51);
        $this->assertSame(10, Post::query()->where('is_published', false)->count());
        $this->assertDatabaseHas('authors', [
            'name' => 'Kagawad Paul Yuson',
            'email' => 'kagawad.yuson@bulletin.test',
        ]);
        $this->assertDatabaseHas('posts', [
            'title' => 'Purok Yuson Clean-up Drive',
            'is_pinned' => true,
            'published_at' => '2026-05-23 10:00:00',
        ]);
        $this->assertSame(
            ['Announcement', 'Ayuda', 'Health', 'Off-Topic', 'Peace & Order'],
            Post::query()->distinct()->orderBy('category')->pluck('category')->all(),
        );
    }

    public function test_index_filters_published_posts_and_keeps_filters_on_pagination(): void
    {
        $author = Author::factory()->create();

        foreach (range(1, 6) as $number) {
            Post::factory()->create([
                'author_id' => $author->id,
                'title' => "Clean-up notice {$number}",
                'category' => 'Announcement',
                'published_at' => now()->subDays(6 - $number),
            ]);
        }

        Post::factory()->draft()->create([
            'author_id' => $author->id,
            'title' => 'Clean-up notice draft',
            'category' => 'Announcement',
        ]);
        Post::factory()->create([
            'author_id' => $author->id,
            'title' => 'Health post',
            'category' => 'Health',
        ]);

        $this->get(route('posts.index', ['q' => 'Clean-up', 'category' => 'Announcement']))
            ->assertOk()
            ->assertSee('Clean-up notice 6')
            ->assertSee('Showing 1–5 of 6 posts')
            ->assertDontSee('Clean-up notice draft')
            ->assertDontSee('Health post')
            ->assertSee('page=2');

        $this->get(route('posts.index', ['q' => 'Clean-up', 'category' => 'Announcement', 'page' => 2]))
            ->assertOk()
            ->assertSee('Clean-up notice 1')
            ->assertSee('Showing 6–6 of 6 posts');
    }

    public function test_index_orders_pinned_posts_first_and_shows_empty_state(): void
    {
        Post::factory()->create([
            'title' => 'Newest regular post',
            'published_at' => now(),
        ]);
        Post::factory()->create([
            'title' => 'Pinned post',
            'is_pinned' => true,
            'published_at' => now()->subMonth(),
        ]);

        $this->get(route('posts.index'))
            ->assertOk()
            ->assertSeeInOrder(['Pinned post', 'Newest regular post'])
            ->assertSee('Pinned');

        Post::query()->delete();

        $this->get(route('posts.index', ['q' => 'not found']))
            ->assertOk()
            ->assertSee('No posts match your search.')
            ->assertSee('Showing 0–0 of 0 posts');
    }

    public function test_show_increments_views_and_drafts_or_missing_posts_return_404(): void
    {
        $post = Post::factory()->create([
            'title' => 'Published community update',
            'views' => 4,
        ]);

        $this->get(route('posts.show', $post->id))
            ->assertOk()
            ->assertSee('Published community update')
            ->assertSee('5 views');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'views' => 5,
        ]);

        $draft = Post::factory()->draft()->create();
        $this->get(route('posts.show', $draft->id))->assertNotFound();
        $this->get(route('posts.show', 999999))->assertNotFound();
    }
}
