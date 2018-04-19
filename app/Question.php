<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'questions', 'user_id', 'category_id', 'upvote', 'downvote',
    ];

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function answer()
    {
    	return $this->hasMany('App\Answer');
    }

    function category()
    {
        return $this->belongsTo('App\Category');
    }
}
