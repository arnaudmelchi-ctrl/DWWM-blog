<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])->paginate(1);
        return view('articles-list', compact('articles'));

    }

    public function adminIndex(): View 
    {
        $articles = Article::with(['category', 'user'])->paginate(1);

        return view('articles-admin-list', compact('articles'));
    }

    public function show($id): View
    {
        $article = Article::with(['category', 'user'])->findOrFail($id);

        // Correction : "articles-detail" avec un "s"
        return view('articles-detail', compact('article'));
    }
}

