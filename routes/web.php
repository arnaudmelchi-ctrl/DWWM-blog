<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/{slug}',[ArticleController::class,'show'])->name('articles.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


    
// Route pour afficher le formulaire d'édition
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Route pour traiter la suppression
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// --- ESPACE ADMINISTRATION ARTICLES ---

// 1. Afficher la liste des articles (Admin)
Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index');

// 2. Formulaire de création (Écran 5)
Route::get('/admin/articles/creer', [ArticleController::class, 'create'])->name('admin.articles.create');

// 3. Action de sauvegarde de la création en BDD
Route::post('/admin/articles', [ArticleController::class, 'store'])->name('admin.articles.store');

// 4. Formulaire d'édition (Écran 5 pré-rempli)
Route::get('/admin/articles/{slug}/modifier', [ArticleController::class, 'edit'])->name('admin.articles.edit');

// 5. Action de mise à jour en BDD (après édition)
Route::put('/admin/articles/{slug}', [ArticleController::class, 'update'])->name('admin.articles.update');

// 6. Action de suppression de l'article (Écran 6)
Route::delete('/admin/articles/{slug}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

