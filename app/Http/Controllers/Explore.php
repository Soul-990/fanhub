<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;

class Explore extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all();
        $genres = Genre::all();

        $query = Content::with(['category', 'genres', 'ratings']);

        // Filter by category
        if ($request->filled('category')) {
            $catVal = $request->category;
            $query->whereHas('category', function ($q) use ($catVal) {
                $q->where('name', $catVal)->orWhere('id', $catVal);
            });
        } elseif (session()->has('filter')) {
            $catVal = session('filter');
            $query->whereHas('category', function ($q) use ($catVal) {
                $q->where('name', $catVal);
            });
        }

        // Filter by genre
        if ($request->filled('genre') && $request->genre !== 'all') {
            $genreVal = $request->genre;
            $query->whereHas('genres', function ($q) use ($genreVal) {
                $q->where('name', $genreVal)->orWhere('genres.id', $genreVal);
            });
        }

        // Filter by release year
        if ($request->filled('year') && $request->year !== 'all') {
            $query->where('release_year', $request->year);
        }

        // Search query
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderBy('popularity', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->latest();
        }

        $content = $query->paginate(12)->withQueryString();

        return view('explore', compact('content', 'category', 'genres'));
    }

    public function filter(String $Cat)
    {
        return redirect()->route("explore", ['category' => $Cat]);
    }
}
