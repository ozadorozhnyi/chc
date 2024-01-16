<?php

namespace Tests\Unit\ModelsTranslations;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Language;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private Post $post;
    private Language $language;
    private PostTranslation $translation;

    /** @test */
    public function local_scope_with_current_locale(): void
    {
        $this->createPostWithTranslation();

        $retrievedPost = Post::withCurrentLocale()->find($this->post->id);

        $this->assertTrue($retrievedPost->translations->contains($this->translation));
    }

    /** @test */
    public function local_scope_with_locale(): void
    {
        $this->createPostWithTranslation('es', 'es_ES');

        $retrievedPost = Post::withLocale('es')->find($this->post->id);

        $this->assertTrue($retrievedPost->translations->contains($this->translation));
    }

    /** @test */
    public function local_scope_with_locales(): void
    {
        Artisan::call('db:seed', ['--class' => 'Database\Seeders\LanguageSeeder']);

        $languages = Language::all();

        $post = Post::factory()->create();

        $translations = collect();
        $languages->each(function ($language) use ($post, $translations) {
            $translations->push(
                PostTranslation::factory()
                    ->withPost($post->id)
                    ->withLanguage($language->id)
                    ->create()
            );
        });

        $locales = $languages->pluck('locale')->toArray();

        $retrievedPost = Post::withLocales($locales)->find($post->id);

        $translations->each(function ($current) use ($retrievedPost) {
            $this->assertTrue(
                $retrievedPost->translations->contains($current)
            );
        });
    }

    /** @test */
    public function local_scope_with_non_existent_locale(): void
    {
        $this->createPostWithTranslation();

        $retrievedPost = Post::withLocale('it')->find($this->post->id);

        $this->assertInstanceOf(Post::class, $retrievedPost);
        $this->assertCount(0, $retrievedPost->translations, 'No translations should exist for the non-existent locale');
    }

    /** @test */
    public function local_scope_with_non_existent_locales(): void
    {
        $this->createPostWithTranslation();

        $retrievedPost = Post::withLocales(['it', 'de'])->find($this->post->id);

        $this->assertInstanceOf(Post::class, $retrievedPost);
        $this->assertCount(0, $retrievedPost->translations, 'No translations should exist for the non-existent locales');
    }

    /**
     * Automates creation of test instances.
     *
     * @param string $locale
     * @param string $prefix
     */
    private function createPostWithTranslation($locale = 'en', $prefix = 'en_US'): void
    {
        $this->post = Post::factory()->create();

        $this->language = Language::factory()->create([
            'locale' => $locale,
            'prefix' => $prefix
        ]);

        $this->translation = PostTranslation::factory()
            ->withPost($this->post->id)
            ->withLanguage($this->language->id)
            ->create();
    }
}
