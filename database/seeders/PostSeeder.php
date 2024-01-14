<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    private int $count;

    public function __construct()
    {
        $this->count = (int) config('chc.seeding.posts');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count($this->count)->create();
    }
}
