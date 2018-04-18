<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_questions = Question::orderBy('created_at', 'desc')->get();
        $random_users = User::orderByRaw('RAND()')->take(5)->get();
        $question_count = Question::where('user_id', Auth::user()->id)->count();
        $followers_count = Auth::user()->followers()->count();
        $following_count = Auth::user()->following()->count();
        return view('home', compact('all_questions', 'random_users', 'question_count', 'followers_count', 'following_count'));
    }
}
