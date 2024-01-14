<?php

namespace Tests\Unit\DomainArea;

use Tests\TestCase;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\DB;
use Database\Seeders\LanguageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostRelationsTest extends TestCase
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
    public function post_has_translations(): void
    {
        $this->assertTrue($this->post->translations->contains($this->translation));
        $this->assertEquals(1, $this->post->translations->count());
    }

    /** @test */
    public function post_translation_belongs_to_language(): void
    {
        $this->assertInstanceOf(PostTranslation::class, $this->translation);
        $this->assertTrue($this->translation->language->is($this->language));
    }

    /** @test */
    public function post_translation_belongs_to_post(): void
    {
        $this->assertInstanceOf(Post::class, $this->post);
        $this->assertTrue($this->translation->post->is($this->post));
    }

    /** @test */
    public function post_force_deleting_deletes_translations()
    {
        $this->post->forceDelete();

        $this->assertDatabaseMissing('posts', ['id' => $this->post->id]);
        $this->assertDatabaseMissing('post_translations', ['post_id' => $this->post->id]);
    }

    /** @test */
    public function post_soft_deleing_dont_deletes_translations()
    {
        $this->post->delete();

        $this->assertSoftDeleted($this->post);
        $this->assertDatabaseHas('post_translations', ['post_id' => $this->post->id]);
    }

    /** @test */
    public function post_has_translation_count()
    {
        $this->post->translations()->delete();

        DB::table('languages')->truncate();

        $this->seed(LanguageSeeder::class);

        $languages = Language::all();

        foreach ($languages as $language) {
            PostTranslation::factory()
                ->withPost($this->post->id)
                ->withLanguage($language->id)
                ->create();
        }

        $this->assertEquals(3, $this->post->translations->count());
    }

}
