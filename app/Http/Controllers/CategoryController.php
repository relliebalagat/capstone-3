<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use Illuminate\Http\Request;
use App\User;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $id = $category->id;
        $category_model = Category::find($id);
        $random_users = User::orderByRaw('RAND()')->take(3)->get();
     	return view('category', compact('category', 'random_users'));
    }
}
