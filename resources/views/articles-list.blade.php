@extends('layouts.app')

@section('content')
    <h1>Articles</h1>

    <div class="filters-section">
        <span class="filters-title">Filtres :</span>
        <select class="filter-select">
            <option>Toutes les catégories</option>
        </select>
        <select class="filter-select">
            <option>Tous les tags</option>
        </select>
    </div>

    <div class="articles-container">
        @foreach ($articles as $article)
          <x-article-card :article="$article" />  
        @endforeach
    </div>

    <style>
        /* Cible absolument tous les SVG de la pagination */
        .pagination-container svg,
        nav svg,
        .flex svg {
            width: 20px !important;
            height: 20px !important;
            display: inline-block !important;
            max-width: 20px !important;
            max-height: 20px !important;
        }
        
        /* Cache le gros texte encombrant de Tailwind si besoin */
        nav p.text-sm {
            display: none !important;
        }
    </style>

    <div class="pagination-container">
        {{ $articles->links() }}
    </div>
@endsection