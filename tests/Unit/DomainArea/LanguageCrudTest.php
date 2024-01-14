<?php

namespace Tests\Unit\DomainArea;

use Tests\TestCase;
use App\Models\Language;
use Database\Seeders\LanguageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_seeds_languages_table_with_config_data(): void
    {
        $this->seed(LanguageSeeder::class);

        $languages = config('chc.l18n');

        foreach ($languages as $locale => $prefix) {
            $this->assertDatabaseHas('languages', [
                'locale' => $locale,
                'prefix' => $prefix,
            ]);
        }
    }

    /**
     * @test
     */
    public function it_can_create_and_retrieve_a_language(): void
    {
        $language = Language::factory()->create();

        $this->assertDatabaseCount('languages', 1);
        $this->assertEquals($language->id, Language::first()->id);
    }

    /** @test */
    public function it_can_be_updated(): void
    {
        $language = Language::factory()->create();

        $italian = [
            'locale' => 'it',
            'prefix' => 'it_IT'
        ];

        $language->update($italian);
        $language->refresh();

        $this->assertEquals($italian['locale'], $language->locale);
        $this->assertEquals($italian['prefix'], $language->prefix);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $language = Language::factory()->create();

        $language->delete();

        $this->assertDatabaseMissing('languages', ['id' => $language->id]);
    }
}
