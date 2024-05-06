<?php

namespace App\Traits\Models\News;

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
