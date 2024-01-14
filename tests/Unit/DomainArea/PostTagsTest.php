<?php

namespace Tests\Unit\DomainArea;

use App\Models\Post;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTagsTest extends TestCase
{
    use RefreshDatabase;

    private Post $post;
    private const RELATED_TAGS_COUNT = 3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
    }

    /** @test */
    public function post_has_tag(): void
    {
        $tag = Tag::factory()->create();
        $this->post->tags()->attach($tag);
        $this->assertTrue($this->post->tags->contains($tag));
    }

    /** @test */
    public function post_has_several_tags()
    {
        $tags = Tag::factory()->count(self::RELATED_TAGS_COUNT)->create();
        $this->post->tags()->attach($tags);
        $this->assertEquals(self::RELATED_TAGS_COUNT, $this->post->tags->count());
    }

    /** @test */
    public function post_has_no_tags_by_default()
    {
        $this->assertInstanceOf(Collection::class, $this->post->tags);
        $this->assertTrue($this->post->tags->isEmpty());
    }

    /** @test */
    public function post_can_detach_tags()
    {
        $tags = Tag::factory()->count(self::RELATED_TAGS_COUNT)->create();

        $this->post->tags()->attach($tags);

        $this->post->tags()->detach();

        $this->assertInstanceOf(Collection::class, $this->post->tags);
        $this->assertTrue($this->post->tags->isEmpty());

        // Verify the detachment from the tag side
        $this->assertTrue(
            $tags->every(fn ($tag) => !$tag->posts->contains($this->post))
        );
    }

    /** @test */
    public function post_force_deleting_deletes_tags()
    {
        $tags = Tag::factory()->count(self::RELATED_TAGS_COUNT)->create();

        $this->post->tags()->attach($tags);

        $this->post->forceDelete();

        $this->assertTrue(
            $tags->fresh()->every(fn ($tag) => !$tag->posts->contains($this->post))
        );
    }

    /** @test */
    public function post_soft_deleting_doesnt_delete_tags()
    {
        $tags = Tag::factory()->count(self::RELATED_TAGS_COUNT)->create();

        $this->post->tags()->attach($tags);

        $this->post->delete();

        $this->post->load('tags');

        $this->assertSoftDeleted($this->post);
        $this->assertInstanceOf(Collection::class, $this->post->tags);
        $this->assertEquals(self::RELATED_TAGS_COUNT, $this->post->tags->count());
    }




}

