<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait NewsAccessorsTrait
{
    public function getTitleAttribute($value)
    {
        return Str::upper($value);
    }
}
