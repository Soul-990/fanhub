<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicCharacterController extends Controller
{
    public function index(Request $request)
    {
        $query = Character::with(['category', 'content']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%');
        }

        $characters = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('characters', compact('characters', 'categories'));
    }

    public function show($id)
    {
        $character = Character::with(['category', 'content.genres'])->findOrFail($id);
        
        $relatedCharacters = Character::where('category_id', $character->category_id)
            ->where('id', '!=', $character->id)
            ->take(4)
            ->get();

        return view('character-detail', compact('character', 'relatedCharacters'));
    }
}
