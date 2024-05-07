<?php

namespace App\Traits\Models\News;

use Illuminate\Support\Str;

trait NewsAccessors
{
    public function getTitleAttribute($value): string
    {
        return Str::upper($value);
    }
}
