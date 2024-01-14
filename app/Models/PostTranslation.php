<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
