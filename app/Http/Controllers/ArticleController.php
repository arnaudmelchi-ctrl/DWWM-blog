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

    public function show(string $slug): View
    {
        $article = Article::with(['category', 'user'])->where('slug', $slug)->firstOrFail();

        // Correction : "articles-detail" avec un "s"
        return view('articles-detail', compact('article'));
    }

    // 1. Afficher le formulaire de création (Écran 5) - CORRIGÉ
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        // On passe bien les catégories ET les tags à la vue
        return view('articles-create', compact('categories', 'tags'));
    }

    /**
     * 2. Enregistrer un nouvel article en base de données
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:100|unique:articles,slug',
            'content' => 'required|string',
            'id_category' => 'required|exists:categories,id',
            'status' => 'required|in:DRAFT,PUBLISHED',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // On crée l'article
        $article = new Article();
        $article->title = $validated['title'];
        // On s'assure que le slug est bien formaté au cas où
        $article->slug = Str::slug($validated['slug']);
        $article->content = $validated['content'];
        $article->status = $validated['status'];
        $article->category_id = $validated['id_category'];
        
        // Pour l'auteur (id_user), on prend l'ID de l'administrateur connecté
        // Si l'authentification n'est pas encore en place, tu peux mettre temporairement : auth()->id() ?? 1
        $article->user_id = auth()->id() ?? 1; 

        // Gestion de la date de publication selon le statut choisi
        if ($validated['status'] === 'PUBLISHED') {
            $article->published_at = now();
        }

        $article->save();
    // Version sécurisée : si aucun tag, on envoie un tableau vide []
        $article->tags()->sync($validated['tags'] ?? []); 
        // Association des tags dans la table pivot articles_tags
        if (!empty($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été créé !');
    }

    /**
     * 3. Afficher le formulaire d'édition avec les données existantes (Écran 5 pré-rempli)
     */
    public function edit(string $slug)
    {
        // On cherche l'article par son slug avec ses relations
        $article = Article::with('tags')->where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles-create', compact('article', 'categories', 'tags'));
    }

    /**
     * 4. Mettre à jour l'article édité en base de données
     */
    public function update(Request $request, string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // Le slug doit rester unique sauf pour l'article en cours de modification
            'slug' => 'required|string|max:100|unique:articles,slug,' . $article->id,
            'content' => 'required|string',
            'id_category' => 'required|exists:categories,id',
            'status' => 'required|in:DRAFT,PUBLISHED',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Mise à jour des champs
        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['slug']);
        $article->content = $validated['content'];
        $article->category_id = $validated['id_category'];

        // Si l'article passe de Brouillon à Publié, on met à jour la date de publication
        if ($validated['status'] === 'PUBLISHED' && $article->status !== 'PUBLISHED') {
            $article->published_at = now();
        } elseif ($validated['status'] === 'DRAFT') {
            $article->published_at = null;
        }
        
        $article->status = $validated['status'];
        $article->save();

        // Synchronisation des tags (retire les anciens non cochés, ajoute les nouveaux)
        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été modifié !');
    }

    /**
     * 5. Supprimer un article (Écran 6)
     */
    public function destroy(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // On le supprime (Laravel va gérer la suppression en cascade de la table pivot et des commentaires si paramétré)
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'L\'article a bien été supprimé !');
    }
}