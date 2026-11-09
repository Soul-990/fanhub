<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $role = Auth()->user()->role;
        if ($role == 1) {
            $users = User::where('role', 0)->latest()->get();
            return view('Admin.users', compact('users'));
        }
    }

    public function ban(String $id)
    {
        $user = User::findOrFail($id);

        // Safety net: never allow banning an admin account.
        if ($user->role == 1) {
            return back()->with('error', 'Admin accounts cannot be banned.');
        }

        $user->is_banned = 1;
        $user->save();

        return back()->with('success', $user->name . ' has been banned.');
    }

    public function unban(String $id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = 0;
        $user->save();

        return back()->with('success', $user->name . ' has been unbanned.');
    }
}
