<?php

namespace App\Traits\Models\News;

use App\Models\User;
use App\Models\Comment;

trait NewsRelationships
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
