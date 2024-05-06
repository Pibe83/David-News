<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\NewsOperationsTrait;

class NewsController extends Controller
{
    use NewsOperationsTrait;

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

        // Utilizza la funzione createNews definita nel trait
        $news = News::create($validatedData);

        return redirect()->route('news.show', ['slug' => $news->slug])->with('success', 'Notizia creata con successo!');
    }

    public function show($slug)
    {
        // Utilizza la funzione showNews definita nel trait
        return $this->showNews($slug);
    }

    public function index()
    {
        return $this->indexNews();
    }

    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Notizia cancellata con successo!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $news = News::findOrFail($id);
        $news->update($validatedData);

        return redirect()->route('news.show', ['slug' => $news->slug])->with('success', 'News updated successfully');
    }
}
