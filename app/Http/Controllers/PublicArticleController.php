<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user'])
            ->where('is_approved', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest('published_at')->paginate(9);
        $categories = Category::all();

        return view('articles', compact('articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::with(['category', 'content', 'user'])
            ->where('is_approved', true)
            ->findOrFail($id);

        $recentArticles = Article::where('is_approved', true)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('article-detail', compact('article', 'recentArticles'));
    }
}
