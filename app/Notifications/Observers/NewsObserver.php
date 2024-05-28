<?php

namespace App\Observers;

use App\Models\News;
use Illuminate\Support\Str;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        // Aggiorna lo slug della notizia
        $slug = News::createSlug($news->title);

        // Formatta il titolo in grassetto
        $boldTitle = Str::of($news->title)->wrap('<strong>', '</strong>');

        // Limita la lunghezza del contenuto
        $limitedContent = Str::limit($news->content, 10);

        // Rendi maiuscola la prima lettera del sottotitolo
        $formattedSubtitle = Str::ucfirst($news->subtitle);

        // Rendi maiuscola la prima lettera del contenuto
        $formattedContent = Str::ucfirst($limitedContent);

        $news->update([
            'slug' => $slug,
            'title' => $boldTitle,
            'subtitle' => $formattedSubtitle,
            'content' => $formattedContent,
            'published_at' => now(),
            'created_by' => auth()->user()->name,
        ]);
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
        $slug = News::createSlug($news->title);

        $formattedSubtitle = Str::ucfirst($news->subtitle);

        $news->update([
            'slug' => $slug,
            'subtitle' => $formattedSubtitle,
        ]);
    }

    public function updating(News $news): void
    {
        $news->last_modified_at = now();
    }

    /**
     * Handle the News "deleted" event.
     */
    public function deleted(News $news): void
    {
    }

    /**
     * Handle the News "restored" event.
     */
    public function restored(News $news): void
    {
    }

    /**
     * Handle the News "force deleted" event.
     */
    public function forceDeleted(News $news): void
    {
    }
}
