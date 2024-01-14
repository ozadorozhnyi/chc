<?php

namespace Database\Seeders;

use App\Models\PostTranslation;
use Illuminate\Support\Facades\Log;
use App\Models\{Post, Language};
use Illuminate\Database\Seeder;

class PostTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $languages = Language::all();

        foreach ($posts as $post) {
            foreach ($languages as $language) {
                PostTranslation::factory()
                    ->withPost($post->id)
                    ->withLanguage($language->id)
                    ->forLocale($language->locale)
                    ->create();
            }
        }
    }

    /**
     * Seed PostTranslation with error handling.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\Language  $language
     * @return void
     */
    private function seedPostTranslation(Post $post, Language $language): void
    {
        try {
            PostTranslation::factory()->create([
                'post_id' => $post->id,
                'language_id' => $language->id,
            ]);
        } catch (\Exception $error) {
            Log::error("Error seeding PostTranslation: {$error->getMessage()}", [
                'post_id' => $post->id,
                'language_id' => $language->id,
            ]);
        }
    }
}
