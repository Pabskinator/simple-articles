<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return compact('articles');
    }

    public function show(Article $article)
    {
        return compact('article');
    }

    public function store(Request $request)
    {
        $this->validateArticle();

        Auth::user()->articles()->create($request->all());
    }

    public function edit(Article $article)
    {
        return new ArticleResource($article);
    }

    public function update(Article $article)
    {
        return $article->update($this->validateArticle());
    }

    public function destroy(Article $article)
    {
        $article->delete();
    }

    public function validateArticle(): array
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);
    }
}
