<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Helpers\CacheManager;
use App\Models\PostTranslation;
use App\Repositories\Traits\CacheKeysBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\CacheKeysBuilderInterface;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostRepository implements CacheKeysBuilderInterface
{
    use CacheKeysBuilder;

    private bool $with_tags;

    public function __construct(Request $request)
    {
        $this->model = Post::class;
        $this->with_tags = $request->header('X-With-Tags') === 'yes';
    }

    public function getById(int $postId)
    {
        $this->cacheKeyAppendWith([
            'id' => $postId,
            'locale' => app()->getLocale(),
            'with-tags' => ($this->with_tags ? 'yes' : 'no'),
        ]);

        return CacheManager::remember($this->cacheKeyBuild(), function() use ($postId) {
            $post = Post::withCurrentLocale()
                ->when($this->with_tags, fn($query) => $query->with('tags'))
                ->findOrFail($postId);

            if (0 === $post->translations->count()) {
                throw new NotFoundHttpException();
            }

            return $post;
        }, config('chc.cache-expiration-time.posts.model-item'));
    }

    public function getAll(int $perPage = 10)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        $this->cacheKeyAppendWith([
            'page' => $page,
            'locale' => app()->getLocale(),
            'with-tags' => ($this->with_tags ? 'yes' : 'no'),
        ]);

        return CacheManager::remember($this->cacheKeyBuild(), function () use ($perPage, $page) {
            $query = Post::withCurrentLocale()
                ->when($this->with_tags, fn($query) => $query->with('tags'));

            return $this->paginate($query, $perPage, $page);
        }, config('chc.cache-expiration-time.posts.collection'));
    }

    public function store(array $data)
    {
        $post = Post::create();

        $language = Language::where('locale', app()->getLocale())->first();

        PostTranslation::factory()
            ->withPost($post->id)
            ->withLanguage($language->id)
            ->forLocale($language->locale)
            ->create();

        $this->with_tags = false;

        return $this->getById((int) $post->id);
    }

    public function delete(int $postId)
    {
        Cache::repository()
    }

    protected function paginate($query, $perPage, $page)
    {
        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

