<?php

namespace App\Http\Controllers;

use App\Models\FanArt;
use Illuminate\Http\Request;

class FanArtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $role = Auth()->user()->role;
        if ($role == 1) {
            $fanarts = FanArt::with('user')->latest()->get();
            return view('Admin.fanart', compact('fanarts'));
        }
    }

    public function approve(String $id)
    {
        $fanart = FanArt::findOrFail($id);
        $fanart->status = 1;
        $fanart->save();

        return back()->with('success', 'Fan art "' . $fanart->title . '" has been approved.');
    }

    public function disapprove(String $id)
    {
        $fanart = FanArt::findOrFail($id);
        $fanart->status = 0;
        $fanart->save();

        return back()->with('success', 'Fan art "' . $fanart->title . '" has been disapproved.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.fanartsubmit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fanart = new FanArt();
        $fanart->user_id = Auth()->id();
        $fanart->title = $request->title;
        $fanart->status = 0;

        $imagename = time() . "." . $request->image->extension();
        $request->image->move(public_path("FanArt"), $imagename);
        $fanart->image = $imagename;

        $fanart->save();

        return back()->with('success', 'Your fan art was submitted! An admin will review it shortly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FanArt $fanArt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FanArt $fanArt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FanArt $fanArt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $fanart = FanArt::findOrFail($id);
        if ($fanart->image && file_exists(public_path('FanArt/' . $fanart->image))) {
            @unlink(public_path('FanArt/' . $fanart->image));
        }

        $title = $fanart->title;
        $fanart->delete();

        return back()->with('success', 'Fan art "' . $title . '" has been deleted.');
    }
}
