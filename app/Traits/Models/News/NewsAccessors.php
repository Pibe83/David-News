<?php

namespace App\Traits\Models\News;

trait NewsAccessors
{
    public function getTitleAttribute($value): string
    {
        return Str::upper($value);
    }
}
