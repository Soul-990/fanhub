<?php

namespace App\Http\Controllers;

use App\Models\ChatbotFaq;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $message = trim($request->input('message', ''));
        if (empty($message)) {
            return response()->json([
                'reply' => "Please type a question so I can assist you with Fan Hub Plus!"
            ]);
        }

        $cleanMsg = strtolower($message);

        // Greetings
        if (in_array($cleanMsg, ['hi', 'hello', 'hey', 'greetings', 'sup', 'yo'])) {
            return response()->json([
                'reply' => "Hello! Welcome to Fan Hub Plus. How can I help you explore anime, gaming, movies, characters, or fandom events today?"
            ]);
        }

        // Search faqs
        $faqs = ChatbotFaq::all();
        $bestMatch = null;
        $highestScore = 0;

        foreach ($faqs as $faq) {
            $score = 0;
            $keywords = array_filter(array_map('trim', explode(',', strtolower($faq->keywords ?? ''))));
            
            foreach ($keywords as $kw) {
                if (!empty($kw) && str_contains($cleanMsg, $kw)) {
                    $score += 3;
                }
            }

            if (str_contains(strtolower($faq->question), $cleanMsg) || str_contains($cleanMsg, strtolower($faq->question))) {
                $score += 5;
            }

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $faq;
            }
        }

        if ($bestMatch && $highestScore > 0) {
            return response()->json([
                'reply' => $bestMatch->answer
            ]);
        }

        return response()->json([
            'reply' => "I couldn't find an exact answer for that. You can browse our Explore page, check upcoming Events, or submit feedback to our team via the Feedback page!"
        ]);
    }
}
