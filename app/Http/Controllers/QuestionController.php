<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function showSingle($id)
    {
        $question_id = $id;
        $question = Question::where('id', $question_id)->first();
        $random_questions = Question::orderByRaw('RAND()')->take(5)->get();
        return view('question', compact('question', 'random_questions'));     
    }

    function create(Request $request)
    {
    	$rules = array(
    		'category_id' => 'required',
    		'question' => 'required'
    	);
    	$this->validate($request, $rules);

    	$question = new Question();
        $question->user_id = Auth::user()->id;
    	$question->category_id = $request->category_id;
    	$question->questions = $request->question;
    	$question->save();
    	return redirect()->back();
    }

    function edit(Request $request, $id)
    {
        $rules = array(
            'category' => 'required',
            'question' => 'required'
        );
        $this->validate($request, $rules);

        $question =  Question::find($id);
        $question->questions = $request->question;
        $question->category_id = $request->category;
        $question->save();

        return redirect()->back();
    }

    function delete($id)
    {
        $question = Question::find($id);
        $question->delete();
        $question->category()->detach($id);
        return redirect('/home');
    }

    function upvote(Request $request)
    {
        // dd($request->question_id);

        Question::where('id', $request->question_id)->increment('upvote', 1);

        $question_upvote = Question::find($request->question_id);
        
        // $question = Question::find($request->question_id);
        // dd($question_upvote->upvote);

        // $me = User::find($request->user_id);
        // $question = Question::find($request->question_id);

        // $me->upvote()->attach($question->id);

        // // return $question_upvote;
        return response()->json(['upvote' => $question_upvote->upvote]);
    }

}
