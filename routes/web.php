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

// Route pour afficher le formulaire d'édition
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Route pour traiter la suppression
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');