<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'content', 'slug', 'photo'];

    public static function createSlug(string $string): string
    {
        $slug = Str::slug($string);

        $count = 2;

        while (self::where('slug', $slug)->exists()) {
            $slug = Str::slug($string) . '-' . $count++;
        }

        return $slug;
    }

    public function getTitleAttribute($value): string
    {
        return Str::upper($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::upper($value);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = Str::snake($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
