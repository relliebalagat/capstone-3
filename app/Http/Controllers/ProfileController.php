<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;
use Auth;
use Image;

class ProfileController extends Controller
{
	public function  profile()
	{
		return view('profile', array('user' => Auth::user()));
	}

    public function show($id)
    {
        $user_id = $id;
        $users = User::find($user_id);
        $questions = Question::all()->where('user_id', $user_id);
        $random_users = User::orderByRaw('RAND()')->take(3)->get();
        
        $followers_count = $users->followers()->count();
        $question_count = Question::where('user_id', $users->id)->count();

        $is_add_question = false;
        $is_following = false;

        if(Auth::check())
        {
            $is_add_question = (Auth::id() == $users->id);
            $me = Auth::user();
            $following_count = $is_add_question ? $me->following()->count() : 0;
            $is_following = !$is_add_question && $me->isFollowing($users);
        }
        
        $is_follow_button = !$is_add_question && !$me->isFollowing($users);
        return view('profile', compact('users', 'questions', 'random_users', 'is_add_question', 'is_following', 'following_count', 'question_count', 'followers_count'));
    }

    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $followers_count = $user->followers()->count();

        $list = $user->followers()->orderBy('username')->get();

        $is_edit_profile = false;
        $is_following = false;

        if(Auth::check()) {
            $is_edit_profile = (Auth::id() == $user->id);

            $me = Auth::user();
            // $following_count = $is_edit_profile ? $me->following()->count : 0;
            $is_following = !$is_edit_profile && $me->isFollowing($user);
        }

        $random_users = User::orderByRaw('RAND()')->take(3)->get();

        return view('followers', compact('user', 'followers_count', 'is_edit_profile', 'following_count', 'is_following', 'list', 'random_users'));
    }

    public function following()
    {
        $me = Auth::user();
        $followers_count = $me->followers()->count();
        $following_count = $me->following()->count();
        $list = $me->following()->orderBy('username')->get();
        $is_edit_profile = true;
        $is_following = false;
        $random_users = User::orderByRaw('RAND()')->take(3)->get();
        return view('following', [
            'user' => $me,
            'followers_count' => $followers_count,
            'is_edit_profile' => $is_edit_profile,
            'following_count' => $following_count,
            'is_following' => $is_following,
            'list' => $list,
            'random_users' => $random_users,
            ]);
    }

    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return redirect()->back();
    }
}
