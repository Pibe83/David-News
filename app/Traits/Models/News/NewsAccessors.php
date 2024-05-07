<?php

namespace App\Traits\Models\News;

use Illuminate\Support\Str;

trait NewsAccessors
{
    /**
     * Get the title attribute.
     *
     * @return string
     */
    public function getTitleAttribute($value): string
    {
        return Str::upper($value);
    }
}
