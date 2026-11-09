<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class PublicContentController extends Controller
{
    public function show($id)
    {
        $content = Content::with(['category', 'genres', 'characters', 'media', 'ratings.user'])
            ->findOrFail($id);

        $userRating = null;
        $isBookmarked = false;

        if (auth()->check()) {
            $userRating = Rating::where('user_id', auth()->id())
                ->where('content_id', $content->id)
                ->first();

            $isBookmarked = Bookmark::where('user_id', auth()->id())
                ->where('content_id', $content->id)
                ->exists();
        }

        // Related content in the same category
        $related = Content::where('category_id', $content->category_id)
            ->where('id', '!=', $content->id)
            ->take(4)
            ->get();

        return view('content-detail', compact('content', 'userRating', 'isBookmarked', 'related'));
    }
}
