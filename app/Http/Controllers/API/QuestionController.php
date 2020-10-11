<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notification;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function answer(Request $request)
    {
        $question = Question::find($request->id);
        $question->answer = $request->answer;
        $question->is_answered = true;
        $question->save();

        Notification::create([
            'user_id' => $request->user_id,
            'notification_page' => 'Question and answers'
        ]);

        return response()->json($question, 200);
    }

    public function ask(Request $request)
    {
        $question  = Question::create($request->all());

        Notification::create([
            'user_id' => $request->geek_id,
            'notification_page' => 'Question and answers'
        ]);

        return response()->json($question, 200);
    }

    public function delete_message(Question $question)
    {
        $id = $question->id;
        $question->delete();
        return response()->json(['id' => $id]);
    }
}
