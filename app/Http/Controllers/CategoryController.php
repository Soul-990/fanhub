<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cat = Category::withCount('contents')->get();
        return view('Admin.category', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.categoryadd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'c_image' => 'required|image|max:4096',
            'description' => 'nullable|string',
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name);
        $cat->description = $request->description;

        $imagename = time() . "." . $request->c_image->extension();
        $request->c_image->move(public_path("Cat"), $imagename);
        $cat->image = $imagename;
        $cat->save();

        return redirect()->route("cat")->with('success', 'Category added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $cat = Category::findOrFail($id);
        return view('Admin.categoryedit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $cat = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'c_image' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
        ]);

        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name);
        $cat->description = $request->description;

        if ($request->hasFile('c_image')) {
            $imagename = time() . "." . $request->c_image->extension();
            $request->c_image->move(public_path("Cat"), $imagename);
            $cat->image = $imagename;
        }

        $cat->save();
        return redirect()->route("cat")->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
