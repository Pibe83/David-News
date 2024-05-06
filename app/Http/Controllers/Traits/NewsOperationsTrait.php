<?php

namespace App\Http\Controllers\Traits;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait NewsOperationsTrait
{
    public function createNews(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public', 'photos');
            $validatedData['photo'] = $imagePath;
        }

        $slug = Str::slug($validatedData['title']);
        $count = 2;

        while (News::where('slug', $slug)->exists()) {
            $slug = Str::slug($validatedData['title']) . '-' . $count++;
        }

        $validatedData['slug'] = $slug;

        return News::create($validatedData);
    }

    public function deleteNews($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();
    }

    public function showNews($slug)
    {
        $news = News::where('slug', $slug)->first();

        if (! $news) {
            return redirect()->route('home');
        }

        return view('news.show', compact('news'));
    }

    public function indexNews()
    {
        $news = News::all();

        return view('news.index', ['news' => $news]);
    }

    public function showBySlug(?string $slug = null)
    {
        $news = News::where('slug', $slug)->first();

        if (! $news) {
            return redirect()->route('home');
        }

        return view('news.show', compact('news'));
    }
}
