<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use InvalidArgumentException;

class PostTranslationFactory extends Factory
{
    private const TITLE_MAX_WORDS = 6;
    private const DESCRIPTION_MAX_PARAGRAPHS = 3;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(self::TITLE_MAX_WORDS, true),
            'description' => $this->faker->paragraphs(self::DESCRIPTION_MAX_PARAGRAPHS, true),
            'content' => $this->faker->text(),
        ];
    }

    /**
     * Set up the post relationship.
     *
     * @param  int  $postId
     * @return $this
     */
    public function withPost(int $postId): PostTranslationFactory
    {
        return $this->state(function (array $attributes) use ($postId) {
            return [
                'post_id' => $postId,
            ];
        });
    }

    /**
     * Set up the language relationship.
     *
     * @param  int  $languageId
     * @return $this
     */
    public function withLanguage(int $languageId): PostTranslationFactory
    {
        return $this->state(function (array $attributes) use ($languageId) {
            return [
                'language_id' => $languageId,
            ];
        });
    }

    /**
     * Defines a model localization state.
     *
     * @param string $locale
     * @return PostTranslationFactory
     */
    public function forLocale(string $locale): PostTranslationFactory
    {
        $locales = config('chc.l18n');

        if (!array_key_exists($locale, $locales)) {
            throw new InvalidArgumentException("Locale '{$locale}' is not supported.");
        }

        return $this->setLocale($locales[$locale]);
    }

    /**
     * Generates a model localization state for a specified locale.
     *
     * @param string $locale
     * @return PostTranslationFactory
     */
    protected function setLocale(string $locale): PostTranslationFactory
    {
        return $this->state(function (array $attributes) use ($locale) {

            /** @todo: add faker providers fo support generating data in different languages... */
            $this->faker->locale($locale);

            return [
                'title' => $this->faker->sentence(self::TITLE_MAX_WORDS, true),
                'description' => $this->faker->paragraphs(self::DESCRIPTION_MAX_PARAGRAPHS, true),
                'content' => $this->faker->text(),
            ];
        });
    }
}


