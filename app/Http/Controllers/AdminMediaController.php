<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Content;
use Illuminate\Http\Request;

class AdminMediaController extends Controller
{
    public function index()
    {
        $media = Media::with('content')->latest()->get();
        return view('Admin.media', compact('media'));
    }

    public function create()
    {
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.mediaadd', compact('contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content_id' => 'required|exists:contents,id',
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:Image,Video,Audio,Trailer',
            'file_url' => 'required|string',
            'thumbnail' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
        ]);

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '_thumb.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('storage/media'), $thumbnailName);
        }

        Media::create([
            'content_id' => $request->content_id,
            'title' => $request->title,
            'type' => $request->type,
            'file_url' => $request->file_url,
            'thumbnail' => $thumbnailName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media created successfully.');
    }

    public function edit(string $id)
    {
        $item = Media::findOrFail($id);
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.mediaedit', compact('item', 'contents'));
    }

    public function update(Request $request, string $id)
    {
        $item = Media::findOrFail($id);
        $request->validate([
            'content_id' => 'required|exists:contents,id',
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:Image,Video,Audio,Trailer',
            'file_url' => 'required|string',
            'thumbnail' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailName = time() . '_thumb.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('storage/media'), $thumbnailName);
            $item->thumbnail = $thumbnailName;
        }

        $item->content_id = $request->content_id;
        $item->title = $request->title;
        $item->type = $request->type;
        $item->file_url = $request->file_url;
        $item->description = $request->description;
        $item->save();

        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = Media::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Media deleted successfully.');
    }
}
