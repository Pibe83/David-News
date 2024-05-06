<?php

namespace App\Http\Controllers\Traits;

use App\Models\Comment;
use Illuminate\Http\Request;

trait CommentOperationsTrait
{
    public function createComment(Request $request)
    {
        $request->validate([
            'comment-text' => 'required',
            'news_id' => 'required|exists:news,id',
        ]);

        return Comment::create([
            'comment-text' => $request->input('comment-text'),
            'user_id' => auth()->id(),
            'news_id' => $request->input('news_id'),
        ]);
    }

    public function likeComment($commentId)
    {
        return $this->like($commentId);
    }
}
