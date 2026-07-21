<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Vue publique : Liste des catégories pour les visiteurs.
     */
    public function index(): View 
    {
        $categories = Category::all();

        return view('categories-list', [
            'categories' => $categories
        ]);
    }

    /**
     * Back-Office : Liste des catégories pour l'admin.
     */
    public function adminIndex(): View
    {
        // Récupération classique recommandée par ta prof
        $categories = Category::all();

        return view('categories-admin-list', [
            'categories' => $categories
        ]);
    }

    /**
     * Back-Office : Formulaire de création.
     */
    public function create(): View
    {
        return view('categories-create');
    }

    /**
     * Back-Office : Action de création.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie a été créée avec succès !');
    }

    /**
     * Back-Office : Formulaire d'édition.
     */
    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);

        return view('categories-create', [
            'category' => $category
        ]);
    }

    /**
     * Back-Office : Action de modification.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $id,
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie a été modifiée avec succès !');
    }

/**
     * Back-Office : Action de suppression.
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        // 1. Vérification : est-ce que la catégorie contient des articles ?
        if ($category->articles()->exists()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des articles reliés !');
        }

        // 2. Si aucun article n'est relié, on supprime
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie a bien été supprimée !');
    }
}