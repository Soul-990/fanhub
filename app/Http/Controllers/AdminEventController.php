<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->orderBy('event_date', 'asc')->get();
        return view('Admin.event', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.eventadd', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'event_date' => 'required|date',
            'event_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_ev.' . $request->image->extension();
            $request->image->move(public_path('storage/events'), $imageName);
        }

        Event::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'city' => $request->city,
            'event_date' => $request->event_date,
            'event_url' => $request->event_url,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event scheduled successfully.');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('Admin.eventedit', compact('event', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'event_date' => 'required|date',
            'event_url' => 'nullable|url',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_ev.' . $request->image->extension();
            $request->image->move(public_path('storage/events'), $imageName);
            $event->image = $imageName;
        }

        $event->category_id = $request->category_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->city = $request->city;
        $event->event_date = $request->event_date;
        $event->event_url = $request->event_url;
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
