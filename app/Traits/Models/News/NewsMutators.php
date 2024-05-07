<?php

namespace App\Traits\Models\News;

use Illuminate\Support\Str;

trait NewsMutators
{
    /**
     * Set the title attribute.
     *
     * @param  string $value
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = Str::upper($value);
    }

    /**
     * Set the content attribute.
     *
     * @param  string $value
     * @return void
     */
    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = Str::snake($value);
    }
}
