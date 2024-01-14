<?php

namespace Tests\Unit\DomainArea;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Language;
use App\Models\PostTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTranslationRelationsTest extends TestCase
{
    use RefreshDatabase;

    private Post $post;
    private Language $language;
    private PostTranslation $translation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
        $this->language = Language::factory()->create();
        $this->translation = PostTranslation::factory()
            ->withPost($this->post->id)
            ->withLanguage($this->language->id)
            ->create();
    }

    /** @test */
    public function translation_belongs_to_correct_language()
    {
        $this->assertInstanceOf(Language::class, $this->language);
        $this->assertTrue($this->translation->language->is($this->language));
    }

    /** @test */
    public function translation_belongs_to_correct_post()
    {
        $this->assertInstanceOf(Post::class, $this->post);
        $this->assertTrue($this->translation->post->is($this->post));
    }

    /** @test */
    public function translation_post_has_title_description_and_content()
    {
        $this->assertNotNull($this->translation->title);
        $this->assertNotNull($this->translation->description);
        $this->assertNotNull($this->translation->content);
    }

}
