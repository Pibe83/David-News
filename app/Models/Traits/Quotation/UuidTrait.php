<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    public function getUuidAttribute($value)
    {
        return Str::uuid($value);
    }
}
