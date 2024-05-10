<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Like\LikeRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory,
        LikeRelationships;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
        'content_type',
        'content_id',
    ];
}
