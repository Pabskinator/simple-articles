<?php

namespace App\Http\Controllers;

use App\Http\ArticleFilter;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilteredArticlesController extends Controller
{
    public function index(Request $request, ArticleFilter $filter)
    {
        if($request->mod === 'home'){
            $articles = Article::filter($filter)->latest()->with('author:id,name')->get();
        }else{
            $articles = Article::filter($filter)->where('user_id', Auth::user()->id)->with('author:id,name')->get();
        }

        return compact('articles');
    }
}
