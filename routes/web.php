<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

// Catégories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Inscription
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


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
Route::get('/admin/categories', [CategoryController::class, 'adminIndex'])->name('admin.categories.index');
Route::get('/admin/categories/creer', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{category}/modifier', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');