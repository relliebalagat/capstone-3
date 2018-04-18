<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;

class AnswerController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create(Request $request, $question_id)
    {
    	$new_answer = new Answer();
    	$new_answer->answers = $request->answer;
    	$new_answer->user_id = Auth::user()->id;
    	$new_answer->question_id = $question_id;
    	$new_answer->save();

    	return redirect()->back();
    }
}
