<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category', 'content')->latest()->get();
        return view('Admin.article', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.articleadd', compact('categories', 'contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        $imageName = null;
        if ($request->hasFile('featured_image')) {
            $imageName = time() . '_art.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('storage/articles'), $imageName);
        }

        Article::create([
            'category_id' => $request->category_id,
            'content_id' => $request->content_id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'body' => $request->body,
            'featured_image' => $imageName,
            'author_name' => $request->author_name ?: auth()->user()->name,
            'is_approved' => 1,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article published successfully.');
    }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.articleedit', compact('article', 'categories', 'contents'));
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('featured_image')) {
            $imageName = time() . '_art.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('storage/articles'), $imageName);
            $article->featured_image = $imageName;
        }

        $article->category_id = $request->category_id;
        $article->content_id = $request->content_id;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->author_name = $request->author_name;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function approve(string $id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = 1;
        $article->published_at = $article->published_at ?: now();
        $article->save();
        return back()->with('success', 'Article approved and published.');
    }

    public function reject(string $id)
    {
        $article = Article::findOrFail($id);
        $article->is_approved = 0;
        $article->save();
        return back()->with('success', 'Article approval revoked.');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return back()->with('success', 'Article deleted successfully.');
    }
}
