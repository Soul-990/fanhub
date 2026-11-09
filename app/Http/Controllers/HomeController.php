<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\FanArt;
use App\Models\Feedback;
use App\Models\Rating;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;

        if ($role == 1) {
            return view('Admin.main');
        }

        // Regular user dashboard
        $bookmarks = Bookmark::with('content.category')
            ->where('user_id', $user->id)
            ->latest()
            ->take(6)
            ->get();

        $fanarts = FanArt::where('user_id', $user->id)
            ->latest()
            ->get();

        $feedbacks = Feedback::where('user_id', $user->id)
            ->latest()
            ->get();

        $ratings = Rating::with('content')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('User.main', compact('user', 'bookmarks', 'fanarts', 'feedbacks', 'ratings'));
    }
}
