<?php

namespace App\Traits\Models\News;

use Illuminate\Support\Str;

trait NewsMutators
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
