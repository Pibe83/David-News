<?php

// NewsSlugTrait.php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait NewsSlugTrait
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
