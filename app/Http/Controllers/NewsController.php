<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\NewsOperationsTrait;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_new' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public', 'photos');
            $validatedData['photo'] = $imagePath;
        }

        $news = News::create($validatedData);

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
