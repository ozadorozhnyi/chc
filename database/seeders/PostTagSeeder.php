<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    private int $tags_per_post;

    public function __construct()
    {
        $this->tags_per_post = (int) config('chc.seeding.tags_per_post');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();

        Post::all()->each(function ($post) use ($tags) {
            $random_tag_ids = $tags->random($this->tags_per_post)->pluck('id')->toArray();
            $post->tags()->attach($random_tag_ids);
        });
    }
}
