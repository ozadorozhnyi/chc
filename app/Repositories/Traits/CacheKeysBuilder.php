<?php

namespace App\Repositories\Traits;

use Illuminate\Support\Str;

trait CacheKeysBuilder
{
    protected string $model;
    private array $parts = [];

    public function cacheKeyAppend(string $key, mixed $value)
    {
        $this->parts[] = Str::slug("{$key}-{$value}");
    }

    public function cacheKeyAppendWith(array $options): void
    {
        foreach ($options as $key => $value) {
            $this->cacheKeyAppend($key, $value);
        }
    }

    public function cacheKeyBuild(string $separator = ':'): string
    {
        $this->keyAppendWithBaseParts();

        return \implode($separator, $this->parts);
    }

    private function keyAppendWithBaseParts(): void
    {
        \array_unshift($this->parts,
            Str::slug(\strtolower(\class_basename($this->model)))
        );
    }
}
