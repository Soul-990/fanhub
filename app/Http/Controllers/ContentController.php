<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::with('category', 'genres')->latest()->get();
        return view('Admin.content', compact('contents'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('Admin.contentadd', compact('categories', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'type' => 'nullable|string|max:100',
            'release_date' => 'required|date',
            'release_year' => 'nullable|integer',
            'popularity' => 'nullable|integer',
            'image' => 'required|image|max:4096',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $content = new Content();
        $imagename = time() . "." . $request->image->extension();
        $request->image->move(public_path("content"), $imagename);

        $content->category_id = $request->category_id;
        $content->name = $request->name;
        $content->slug = Str::slug($request->name) . '-' . time();
        $content->description = $request->description;
        $content->type = $request->type ?: 'TV Series';
        $content->image = $imagename;
        $content->release_date = $request->release_date;
        $content->release_year = $request->release_year ?: date('Y', strtotime($request->release_date));
        $content->popularity = $request->popularity ?: rand(80, 99);
        $content->status = $request->status ?: 'Released';
        $content->save();

        if ($request->has('genres')) {
            $content->genres()->sync($request->genres);
        }

        return redirect()->route("content")->with('success', 'Content added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $content = Content::with('genres')->findOrFail($id);
        $categories = Category::all();
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('Admin.contentedit', compact('content', 'categories', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $content = Content::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'type' => 'nullable|string|max:100',
            'release_date' => 'required|date',
            'release_year' => 'nullable|integer',
            'popularity' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $content->category_id = $request->category_id;
        $content->name = $request->name;
        $content->slug = Str::slug($request->name);
        $content->description = $request->description;
        $content->type = $request->type ?: 'TV Series';
        $content->release_date = $request->release_date;
        $content->release_year = $request->release_year ?: date('Y', strtotime($request->release_date));
        if ($request->has('popularity')) {
            $content->popularity = $request->popularity;
        }

        if ($request->hasFile('image')) {
            $imagename = time() . "." . $request->image->extension();
            $request->image->move(public_path("content"), $imagename);
            $content->image = $imagename;
        }

        $content->save();

        if ($request->has('genres')) {
            $content->genres()->sync($request->genres);
        } else {
            $content->genres()->sync([]);
        }

        return redirect()->route("content")->with('success', 'Content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return back()->with('success', 'Content deleted successfully.');
    }
}
