<?php

namespace App\Traits\Models\News;

use Illuminate\Support\Str;

trait NewsActions
{
    public static function createSlug(string $string): string
    {
        $slug = Str::slug($string);

        $count = 2;

        while (self::where('slug', $slug)->exists()) {
            $slug = Str::slug($string) . '-' . $count++;
        }

        return $slug;
    }
}
