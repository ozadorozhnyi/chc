<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [];

        foreach (config('chc.l18n') as $locale => $prefix) {
            $items[] = [
                'locale' => $locale,
                'prefix' => $prefix
            ];
        }

        Language::insert($items);
    }
}
