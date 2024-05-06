<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait NewsMutatorsTrait
{
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::upper($value);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = Str::snake($value);
    }
}
