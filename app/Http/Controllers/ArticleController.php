<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    

    public function index () {
        $articles = Article::with(['category', 'user'])->get();

        return view('articles-list',compact('articles'));
    }

    public function adminIndex () {
        $articles = Article::with(['category', 'user'])->get();

        return view('articles-admin-list',compact('articles'));
    }
}


