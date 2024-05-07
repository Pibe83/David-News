<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Comment;

trait NewsRelationshipTrait
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
