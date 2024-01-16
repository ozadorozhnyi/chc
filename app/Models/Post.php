<?php

namespace App\Models;

use App\Models\Interfaces\Localizable;
use App\Models\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model implements Localizable
{
    use HasFactory;
    use SoftDeletes;
    use Localization;

    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
