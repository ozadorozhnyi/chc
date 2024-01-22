<?php

namespace App\Repositories\Interfaces;

interface CacheKeysBuilderInterface
{
    public function cacheKeyAppend(string $key, mixed $value);

    public function cacheKeyAppendWith(array $options): void;

    public function cacheKeyBuild(string $separator = ':'): string;

}
