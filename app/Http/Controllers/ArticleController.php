<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
{
    // 1. Récupération des catégories et des tags pour les filtres
    $categories = Category::all();
    $tags = Tag::all();

    // 2. Préparation de la requête sans bloquer sur la casse de 'published'
    $query = Article::whereRaw('LOWER(status) = ?', ['published'])
                    ->with(['category', 'user', 'tags'])
                    ->latest('published_at');

    // 3. Filtre par Catégorie si sélectionnée
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // 4. Filtre par Tag si sélectionné
    if ($request->filled('tag')) {
        $query->whereHas('tags', function ($q) use ($request) {
            $q->where('tags.id', $request->tag);
        });
    }

    // 5. Pagination avec conservation des paramètres d'URL
    $articles = $query->paginate(2)->withQueryString();

    // 6. Envoi des données à la vue "articles-list"
    return view('articles-list', compact('articles', 'categories', 'tags'));
}

    public function adminIndex(): View 
    {
        $articles = Article::with(['category', 'user'])->paginate(1);
        return view('articles-admin-list', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = Article::with(['category', 'user'])->where('slug', $slug)->firstOrFail();
        return view('articles-detail', compact('article'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles-create', compact('categories', 'tags'));
    }

    /**
     * Enregistrer un nouvel article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100|unique:articles,slug',
            'content' => 'required|string',
            'id_category' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published', // CORRIGÉ EN MINUSCULES
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['slug']);
        $article->content = $validated['content'];
        $article->status = $validated['status'];
        $article->category_id = $validated['id_category']; 
        $article->user_id = auth()->id() ?? 1; 

        if ($validated['status'] === 'published') {
            $article->published_at = now();
        }

        $article->save();

        $article->tags()->sync($validated['tags'] ?? []); 

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été créé !');
    }

    public function edit(string $slug)
    {
        $article = Article::with('tags')->where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles-create', compact('article', 'categories', 'tags'));
    }

    /**
     * Mettre à jour l'article existant
     */
    public function update(Request $request, string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100|unique:articles,slug,' . $article->id,
            'content' => 'required|string',
            'id_category' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published', // CORRIGÉ EN MINUSCULES
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['slug']);
        $article->content = $validated['content'];
        $article->category_id = $validated['id_category']; 

        // Gestion de la date de publication
        if ($validated['status'] === 'published' && $article->status !== 'published') {
            $article->published_at = now();
        } elseif ($validated['status'] === 'draft') {
            $article->published_at = null;
        }

        $article->status = $validated['status'];
        $article->save();

        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été modifié !');
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été supprimé !');
    }
}