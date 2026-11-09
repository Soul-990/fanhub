<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class AdminMerchandiseController extends Controller
{
    public function index()
    {
        $items = Merchandise::with('category', 'content')->latest()->get();
        return view('Admin.merchandise', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.merchandiseadd', compact('categories', 'contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'description' => 'required|string',
            'price' => 'nullable|string|max:50',
            'tag' => 'nullable|string|max:50',
            'product_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_merch.' . $request->image->extension();
            $request->image->move(public_path('storage/merchandise'), $imageName);
        }

        Merchandise::create([
            'category_id' => $request->category_id,
            'content_id' => $request->content_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'tag' => $request->tag,
            'is_upcoming' => $request->has('is_upcoming') ? 1 : 0,
            'product_url' => $request->product_url,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise showcase item added successfully.');
    }

    public function edit(string $id)
    {
        $item = Merchandise::findOrFail($id);
        $categories = Category::all();
        $contents = Content::orderBy('name', 'asc')->get();
        return view('Admin.merchandiseedit', compact('item', 'categories', 'contents'));
    }

    public function update(Request $request, string $id)
    {
        $item = Merchandise::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'content_id' => 'nullable|exists:contents,id',
            'description' => 'required|string',
            'price' => 'nullable|string|max:50',
            'tag' => 'nullable|string|max:50',
            'product_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_merch.' . $request->image->extension();
            $request->image->move(public_path('storage/merchandise'), $imageName);
            $item->image = $imageName;
        }

        $item->category_id = $request->category_id;
        $item->content_id = $request->content_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->tag = $request->tag;
        $item->is_upcoming = $request->has('is_upcoming') ? 1 : 0;
        $item->product_url = $request->product_url;
        $item->save();

        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise showcase item updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = Merchandise::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Merchandise item deleted successfully.');
    }
}
