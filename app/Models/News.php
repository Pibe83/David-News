<?php

namespace App\Models;

use App\Models\Traits\NewsSlugTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\NewsMutatorsTrait;
use App\Models\Traits\NewsAccessorsTrait;
use App\Models\Traits\NewsRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory,

        NewsMutatorsTrait,
        NewsAccessorsTrait,
        NewsRelationshipTrait,
        NewsSlugTrait;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'slug',
        'photo',
    ];
}
