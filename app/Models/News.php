<?php

namespace App\Models;

use App\Traits\Models\News\NewsActions;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\News\NewsMutators;
use App\Traits\Models\News\NewsAccessors;
use App\Traits\Models\News\NewsRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory,
        NewsAccessors,
        NewsActions,
        NewsMutators,
        NewsRelationships;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'slug',
        'photo',
        'user_id',
    ];
}
