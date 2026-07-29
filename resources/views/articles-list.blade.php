@extends('layouts.app')

@section('content')
    <h1>Articles</h1>

    <div class="filters-section">
        <span class="filters-title">Filtres :</span>

        <form method="GET" action="{{ route('articles.index') }}" style="display: inline-flex; gap: 10px;">
            
            <!-- Select des Catégories -->
            <select name="category" class="filter-select" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Select des Tags -->
            <select name="tag" class="filter-select" onchange="this.form.submit()">
                <option value="">Tous les tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>

            <!-- Bouton pour Réinitialiser si un filtre est actif -->
            @if(request('category') || request('tag'))
                <a href="{{ route('articles.index') }}" style="text-decoration: none; color: #dc2626; font-size: 0.85rem; align-self: center;">
                    ✖ Réinitialiser
                </a>
            @endif

        </form>
    </div>

    <div class="articles-container">
        @foreach ($articles as $article)
            <x-article-card :article="$article" />  
        @endforeach
    </div>

    <style>
        /* Taille des icônes SVG de la pagination */
        .pagination-container svg {
            width: 20px !important;
            height: 20px !important;
            display: inline-block !important;
        }
        
        /* Masque le texte d'information de Tailwind (ex: "Showing 1 to 2 of 10 results") */
        .pagination-container p.text-sm {
            display: none !important;
        }
    </style>

    <div class="pagination-container" style="margin-top: 30px;">
        {{ $articles->links('pagination::tailwind') }}
    </div>
@endsection