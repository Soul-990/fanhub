<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Content;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'content_id' => $request->content_id,
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Thank you! Your rating and review have been saved.');
    }
}
