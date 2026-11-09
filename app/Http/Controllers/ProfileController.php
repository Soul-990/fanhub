<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();
        $categories = Category::all();
        return view('profile', compact('user', 'categories'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'favorite_fandoms' => 'nullable|string|max:1000',
            'categories_of_interest' => 'nullable|string|max:1000',
            'display_preferences' => 'nullable|string|in:system,light,dark',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->favorite_fandoms = $request->favorite_fandoms;
        $user->categories_of_interest = $request->categories_of_interest;
        $user->display_preferences = $request->display_preferences ?? 'system';

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $imageName = 'user_' . $user->id . '_' . time() . '.' . $request->file('profile_image')->extension();
            $request->file('profile_image')->move(public_path('avatars'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profile and fandom preferences updated successfully!');
    }
}
