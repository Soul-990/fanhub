<?php

namespace App\Http\Controllers;

use App\Models\ChatbotFaq;
use Illuminate\Http\Request;

class AdminChatbotFaqController extends Controller
{
    public function index()
    {
        $faqs = ChatbotFaq::latest()->get();
        return view('Admin.faq', compact('faqs'));
    }

    public function create()
    {
        return view('Admin.faqadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'keywords' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        ChatbotFaq::create([
            'question' => $request->question,
            'keywords' => $request->keywords,
            'answer' => $request->answer,
            'category' => $request->category ?: 'General',
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ entry added for Chatbot.');
    }

    public function edit(string $id)
    {
        $faq = ChatbotFaq::findOrFail($id);
        return view('Admin.faqedit', compact('faq'));
    }

    public function update(Request $request, string $id)
    {
        $faq = ChatbotFaq::findOrFail($id);
        $request->validate([
            'question' => 'required|string|max:255',
            'keywords' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        $faq->update([
            'question' => $request->question,
            'keywords' => $request->keywords,
            'answer' => $request->answer,
            'category' => $request->category ?: 'General',
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'Chatbot FAQ updated successfully.');
    }

    public function destroy(string $id)
    {
        $faq = ChatbotFaq::findOrFail($id);
        $faq->delete();
        return back()->with('success', 'Chatbot FAQ deleted successfully.');
    }
}
