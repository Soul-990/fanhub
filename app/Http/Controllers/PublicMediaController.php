<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Content;
use Illuminate\Http\Request;

class PublicMediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('content.category');

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $mediaItems = $query->latest()->paginate(12);

        return view('media', compact('mediaItems'));
    }
}
