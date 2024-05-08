<?php

namespace App\Http\Controllers\Traits;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait LikeOperationsTrait
{
    public function like($commentId)
    {
        $comment = Comment::find($commentId);

        if (! $comment) {
            return response()->json(['error' => 'Commento non trovato'], 404);
        }

        $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Hai messo "Mi piace" a questo commento'], 200);
    }

    public function unlike(Request $request, $likeId)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Utente non autenticato'], 401);
        }

        $like = Like::find($likeId);

        if (! $like) {
            return response()->json(['error' => 'Like non trovato'], 404);
        }

        if ($like->user_id != Auth::id()) {
            return response()->json(['error' => 'Non sei autorizzato a rimuovere questo like'], 403);
        }

        $like->delete();

        return response()->json(['message' => 'Hai rimosso il like'], 200);
    }
}
