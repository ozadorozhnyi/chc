<?php

namespace Tests\Unit\DomainArea;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_and_retrieve_a_tag(): void
    {
        $tag = Tag::factory()->create();

        $this->assertDatabaseCount('tags', 1);
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals($tag->id, Tag::first()->id);
    }

    /** @test */
    public function it_can_be_updated(): void
    {
        $tag = Tag::factory()->create();

        $a_new_tag_name = 'a baba galamaga';

        $tag->update(['name' => $a_new_tag_name]);

        $this->assertEquals($a_new_tag_name, $tag->refresh()->name);
    }

    /** @test */
    public function it_can_be_soft_deleted()
    {
        $tag = Tag::factory()->create();

        $tag->delete();

        $this->assertSoftDeleted($tag);
    }
}
