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
        // Trova il commento corrispondente all'ID fornito
        $comment = Comment::find($commentId);

        // Verifica se il commento esiste
        if (! $comment) {
            return response()->json(['error' => 'Commento non trovato'], 404);
        }

        // Ora puoi aggiungere il like al commento

        $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Hai messo "Mi piace" a questo commento'], 200);
    }

    public function unlike(Request $request, $likeId)
    {
        // Verifica se l'utente è autenticato
        if (! Auth::check()) {
            return response()->json(['error' => 'Utente non autenticato'], 401);
        }

        // Trova il like corrispondente all'ID fornito
        $like = Like::find($likeId);

        // Se il like non esiste, restituisci un errore
        if (! $like) {
            return response()->json(['error' => 'Like non trovato'], 404);
        }

        // Verifica se l'utente autenticato è il proprietario del like
        if ($like->user_id != Auth::id()) {
            return response()->json(['error' => 'Non sei autorizzato a rimuovere questo like'], 403);
        }

        // Elimina il like
        $like->delete();

        return response()->json(['message' => 'Hai rimosso il like'], 200);
    }
}
