@extends('layouts.app')

@section('content')
<style>
    /* Styles intégrés pour un rendu moderne et propre sans dépendre de Tailwind */
    .form-container {
        max-width: 48rem;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .back-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }
    .back-link:hover {
        color: #1d4ed8;
    }
    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-label {
        display: block;
        color: #374151;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        background-color: #fff;
        color: #111827;
        font-size: 1rem;
        box-sizing: border-box;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    .form-help {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    .radio-group {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        margin-top: 0.5rem;
    }
    .radio-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #374151;
    }
    .radio-input {
        margin-right: 0.5rem;
        width: 1.25rem;
        height: 1.25rem;
        accent-color: #2563eb;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        border-top: 1px solid #e5e7eb;
        padding-top: 1rem;
        margin-top: 1.5rem;
    }
    .btn {
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
        text-decoration: none;
        font-size: 0.95rem;
    }
    .btn-cancel {
        background-color: #f3f4f6;
        color: #374151;
        border: none;
    }
    .btn-cancel:hover {
        background-color: #e5e7eb;
    }
    .btn-submit {
        background-color: #111827;
        color: #ffffff;
        border: none;
    }
    .btn-submit:hover {
        background-color: #1f2937;
    }
    kbd {
        background-color: #f3f4f6;
        padding: 0.125rem 0.25rem;
        border-radius: 0.25rem;
        border: 1px solid #e5e7eb;
        font-size: 0.75rem;
    }
</style>
<p style="background: #fee2e2; color: #991b1b; padding: 0.5rem; border-radius: 0.25rem;">
    Le statut actuel en BDD est : <strong>"{{ isset($article) ? $article->status : 'Aucun (Création)' }}"</strong>
</p>
<div class="form-container">
    
    <!-- Bouton Retour à la liste -->
    <div>
        <a href="{{ route('admin.articles.index') }}" class="back-link">
            ← Retour à la liste
        </a>
    </div>

    <!-- Titre dynamique selon le contexte -->
    <h1 class="form-title">
        {{ isset($article) ? 'Modifier l\'article' : 'Créer un nouvel article' }}
    </h1>

    <!-- Formulaire -->
    <form action="{{ isset($article) ? route('admin.articles.update', $article->slug) : route('admin.articles.store') }}" method="POST">
        @csrf
        @if(isset($article))
            @method('PUT')
        @endif

        <!-- Champ Titre -->
        <div class="form-group">
            <label for="title" class="form-label">Titre *</label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $article->title ?? '') }}"
                   class="form-input" required>
        </div>

        <!-- Champ Slug -->
        <div class="form-group">
            <label for="slug" class="form-label">Slug (URL de l'article) *</label>
            <input type="text" name="slug" id="slug" 
                   value="{{ old('slug', $article->slug ?? '') }}"
                   class="form-input" required>
        </div>

        <!-- Choix de la Catégorie -->
        <div class="form-group">
            <label for="id_category" class="form-label">Catégorie *</label>
            <select name="id_category" id="id_category" class="form-select" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ (old('id_category', $article->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Choix des Tags -->
        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <select name="tags[]" id="tags" class="form-select" style="height: 8rem;" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" 
                        {{ (collect(old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : []))->contains($tag->id)) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            <p class="form-help">Maintenez la touche <kbd>Ctrl</kbd> (Windows) ou <kbd>Cmd</kbd> (Mac) pour sélectionner plusieurs tags.</p>
        </div>

        <!-- Contenu de l'article -->
        <div class="form-group">
            <label for="content" class="form-label">Contenu *</label>
            <textarea name="content" id="content" rows="8" class="form-textarea" required>{{ old('content', $article->content ?? '') }}</textarea>
        </div>

        <!-- Statut de l'article (CORRIGÉ EN MINUSCULES) -->
        <div class="form-group">
            <span class="form-label">Statut *</span>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="status" value="draft" class="radio-input"
                        {{ old('status', isset($article) ? $article->status : 'draft') === 'draft' ? 'checked' : '' }}>
                    <span>Brouillon</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="status" value="published" class="radio-input"
                        {{ old('status', isset($article) ? $article->status : '') === 'published' ? 'checked' : '' }}>
                    <span>Publié</span>
                </label>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="form-actions">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-cancel">
                Annuler
            </a>
            <button type="submit" class="btn btn-submit">
                {{ isset($article) ? 'Enregistrer les modifications' : 'Enregistrer l\'article' }}
            </button>
        </div>
    </form>
</div>
@endsection