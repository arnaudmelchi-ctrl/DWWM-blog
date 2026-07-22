<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (FRONT-OFFICE)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Catégories (Vue publique si vous affichez la liste des catégories aux visiteurs)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


/*
|--------------------------------------------------------------------------
| ROUTES ADMINISTRATION (BACK-OFFICE)
|--------------------------------------------------------------------------
*/

// --- ESPACE ADMIN : ARTICLES ---
Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index');
Route::get('/admin/articles/creer', [ArticleController::class, 'create'])->name('admin.articles.create');
Route::post('/admin/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
Route::get('/admin/articles/{slug}/modifier', [ArticleController::class, 'edit'])->name('admin.articles.edit');
Route::put('/admin/articles/{slug}', [ArticleController::class, 'update'])->name('admin.articles.update');
Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');


// --- ESPACE ADMIN : CATÉGORIES ---

// 1. Liste des catégories en admin
Route::get('/admin/categories', [CategoryController::class, 'adminIndex'])->name('admin.categories.index');

// 2. Formulaire de création + sauvegarde
Route::get('/admin/categories/creer', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

// 3. Formulaire de modification + sauvegarde
Route::get('/admin/categories/{category}/modifier', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

// 4. Suppression
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');




// Route GET : Affiche la page du formulaire
Route::get('/register', [RegisterController::class, 'create'])->name('register');

// Route POST : Traite la soumission du formulaire
Route::post('/register', [RegisterController::class, 'store']);