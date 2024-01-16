<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Localizable
{
    public function translations(): HasMany;
}
