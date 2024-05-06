<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment-text', 'user_id', 'news_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
