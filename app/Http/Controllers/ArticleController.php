<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function show():View{
        return view('articles-list');
    }

    public function index () {
        $articles = Article::all();

        return view('articles-list',[
            'articles' => $articles]);
    }
}


