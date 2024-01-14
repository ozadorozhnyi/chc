<?php

namespace Tests\Unit\DomainArea;

use Tests\TestCase;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageRelationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function language_has_translations()
    {
        $post = Post::factory()->create();
        $language = Language::factory()->create();

        $translation = PostTranslation::factory()
            ->withPost($post->id)
            ->withLanguage($language->id)
            ->create();

        $this->assertInstanceOf(PostTranslation::class, $translation);
        $this->assertTrue($language->translations->contains($translation));
    }

    /** @test */
    public function language_deleting_deletes_translations()
    {
        $post = Post::factory()->create();
        $language = Language::factory()->create();

        PostTranslation::factory()
            ->withPost($post->id)
            ->withLanguage($language->id)
            ->create();

        $language->delete();

        $this->assertDatabaseMissing('languages', ['id' => $language->id]);
        $this->assertDatabaseMissing('post_translations', ['language_id' => $language->id]);
    }
}
