<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
});

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/articles/admin', [ArticleController::class, 'adminIndex']);