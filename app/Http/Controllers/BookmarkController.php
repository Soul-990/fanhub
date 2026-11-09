<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Content;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookmarks = Bookmark::with(['content.category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('bookmarks', compact('bookmarks'));
    }

    public function toggle(Request $request, $id = null)
    {
        $contentId = $id ?? $request->input('content_id');
        $content = Content::findOrFail($contentId);

        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('content_id', $content->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $bookmarked = false;
            $msg = 'Removed from your bookmarks.';
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'content_id' => $content->id,
            ]);
            $bookmarked = true;
            $msg = 'Added to your bookmarks!';
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'bookmarked' => $bookmarked,
                'message' => $msg,
                'count' => Bookmark::where('user_id', auth()->id())->count()
            ]);
        }

        return back()->with('success', $msg);
    }
}
