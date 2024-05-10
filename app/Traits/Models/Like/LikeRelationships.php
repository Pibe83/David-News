<?php

namespace App\Traits\Models\Like;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LikeRelationships
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likeable(): BelongsTo
    {
        return $this->morphTo();
    }
}
