<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class UserArticlesController extends Controller
{
    public function index()
    {
        $articles = Auth::user()->articles()->with('author:id,name')->get();

        return compact('articles');
    }
}
