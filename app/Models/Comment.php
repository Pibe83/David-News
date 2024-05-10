<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Comment\CommentRelationships;

class Comment extends Model
{
    use CommentRelationships;

    protected $fillable = [
        'comment-text',
        'user_id',
        'news_id',
    ];
}
