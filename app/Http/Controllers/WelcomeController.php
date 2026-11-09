<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Content;
use App\Models\Character;
use App\Models\Article;
use App\Models\Event;
use App\Models\Merchandise;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('contents')->get();
        $trending = Content::with('category')->orderBy('popularity', 'desc')->take(8)->get();
        $characters = Character::with('category', 'content')->orderBy('views', 'desc')->take(4)->get();
        $articles = Article::with('category')->where('is_approved', 1)->latest('published_at')->take(3)->get();
        $events = Event::orderBy('event_date', 'asc')->take(2)->get();
        $merchandise = Merchandise::with('category')->take(4)->get();

        $stats = [
            'categories' => $categories->count(),
            'titles' => Content::count(),
            'characters' => Character::count(),
            'articles' => Article::where('is_approved', 1)->count(),
        ];

        return view('welcome', compact('categories', 'trending', 'characters', 'articles', 'events', 'merchandise', 'stats'));
    }
}
