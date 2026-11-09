<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Character;
use App\Models\Content;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::with('category', 'content')->latest()->get();
        return view('Admin.character', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.characteradd', compact('categories', 'contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'role' => 'nullable|string|max:150',
            'desc' => 'required|string',
            'bio' => 'nullable|string',
            'image' => 'required|image|max:4096',
        ]);

        $character = new Character();
        $imagename = time() . "." . $request->image->extension();
        $request->image->move(public_path("character"), $imagename);

        $character->category_id = $request->category_id;
        $character->content_id = $request->content_id;
        $character->name = $request->name;
        $character->role = $request->role;
        $character->desc = $request->desc;
        $character->bio = $request->bio;
        $character->image = $imagename;
        $character->save();

        return redirect()->route("character")->with('success', 'Character profile added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $character = Character::findOrFail($id);
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.characteredit', compact('character', 'categories', 'contents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $character = Character::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'role' => 'nullable|string|max:150',
            'desc' => 'required|string',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $character->category_id = $request->category_id;
        $character->content_id = $request->content_id;
        $character->name = $request->name;
        $character->role = $request->role;
        $character->desc = $request->desc;
        $character->bio = $request->bio;

        if ($request->hasFile('image')) {
            $imagename = time() . "." . $request->image->extension();
            $request->image->move(public_path("character"), $imagename);
            $character->image = $imagename;
        }

        $character->save();
        return redirect()->route("character")->with('success', 'Character profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
        return back()->with('success', 'Character profile deleted successfully.');
    }
}
