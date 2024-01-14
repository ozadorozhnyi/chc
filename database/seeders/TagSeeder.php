<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    private int $count;

    public function __construct()
    {
        $this->count = (int) config('chc.seeding.tags');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory($this->count)->create();
    }
}
