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
        
        $user = User::find(Auth::user()->id);
        // To check if the user has already upvoted the post
        foreach($user->upvote as $user) {
            $q = $user->pivot->question_id;
            $u = $user->pivot->user_id;
            if($q == $question_id && $u == Auth::user()->id) {
                return 'true';
            } else {
                return 'false';
            }
        }
        
        // return view('question', compact('question', 'random_questions'));     
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
        // $user = User::find($request->user_id);

        // return $user;


        Question::where('id', $request->question_id)->increment('upvote', 1);
        $question_upvote = Question::find($request->question_id);

        $me = User::find($request->user_id);
        $question = Question::find($request->question_id);

        $me->upvote()->attach($question->id);
        return response()->json(['upvote' => $question_upvote->upvote]);
    }

    function downvote(Request $request)
    {
        Question::where('id', $request->question_id)->increment('downvote', 1);
        $question_downvote = Question::find($request->question_id);

        $me = User::find($request->user_id);
        $question = Question::find($request->question_id);

        $me->downvote()->attach($question->id);
        return response()->json(['downvote' => $question_downvote->downvote]);
    }

}
