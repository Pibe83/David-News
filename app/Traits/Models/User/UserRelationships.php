<?php

namespace App\Traits\Models\User;

use App\Models\Like;
use App\Models\News;
use App\Models\Comment;
use App\Models\Quotation;
use App\Models\QuotationHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationships
{
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function history()
    {
        return $this->hasMany(QuotationHistory::class, 'user_id');
    }
}
