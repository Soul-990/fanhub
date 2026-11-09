<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('contents')->orderBy('name', 'asc')->get();
        return view('Admin.genre', compact('genres'));
    }

    public function create()
    {
        return view('Admin.genreadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('Admin.genreedit', compact('genre'));
    }

    public function update(Request $request, string $id)
    {
        $genre = Genre::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,' . $id,
        ]);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return back()->with('success', 'Genre deleted successfully.');
    }
}
