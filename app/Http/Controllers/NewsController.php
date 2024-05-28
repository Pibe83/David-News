<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Http\Requests\StoreNewsRequest;
use App\Jobs\Quotation\ProcessNewsCreation;
use App\Http\Controllers\Traits\NewsOperationsTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;

class NewsController extends Controller
{
    use NewsOperationsTrait;

    public function index()
    {
        $news = News::all();

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function showBySlug(string $slug)
    {
        $news = News::where('slug', $slug)->first();

        if (! $news) {
            return redirect()->route('home');
        }

        return view('news.show', compact('news'));
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public', 'photos');
            $validatedData['photo'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->id();

        $news = News::create($validatedData);

        /* $batch = Bus::batch([
            new ProcessNewsCreation($news),
        ])->dispatch(); */

        return redirect()->route('news.show', $news)
            ->with('success', 'Notizia creata con successo!');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'your-slug',
            'user_id' => auth()->id(),
        ]);

        $news->update($validatedData);

        return redirect()->route('news.show', [$news, 'random' => uniqid()])
            ->with('success', 'Notizia aggiornata con successo!');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Notizia cancellata con successo!');
    }
}
