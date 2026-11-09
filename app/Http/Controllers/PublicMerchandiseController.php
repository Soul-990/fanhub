<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicMerchandiseController extends Controller
{
    public function index(Request $request)
    {
        $query = Merchandise::with(['category', 'content']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('upcoming')) {
            $query->where('is_upcoming', true);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('tag', 'like', '%' . $request->search . '%');
            });
        }

        $merchandise = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('merchandise', compact('merchandise', 'categories'));
    }
}
