<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth()->user()->role;
        if ($role == 1) {
            $feedbacks = Feedback::with('user')->latest()->get();
            return view('Admin.feedback', compact('feedbacks'));
        }
    }


    public function resolve(String $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 1;
        $feedback->save();

        return back()->with('success', 'Feedback marked as resolved.');
    }

     public function reopen(String $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 0;
        $feedback->save();

        return back()->with('success', 'Feedback re-opened.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.feedbacksubmit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'type' => 'nullable|string|in:general,suggestion,bug,content_request',
        ]);

        $feedback = new Feedback();
        $feedback->user_id = Auth()->id();
        $feedback->title = $request->title;
        $feedback->message = $request->message;
        $feedback->type = $request->input('type', 'general');
        $feedback->status = 0;
        $feedback->save();

        return back()->with('success', 'Thanks! Your feedback has been sent to the team.');
    }

    /**
     * Display the specified resource.
     */
    public function show(feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(String $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return back()->with('success', 'Feedback deleted.');
    }
}
