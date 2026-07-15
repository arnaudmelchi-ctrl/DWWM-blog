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

    <div class="pagination-container">
        <button class="btn-pagination">- Précédent</button>
        <span class="page-info">Page 1/4</span>
        <button class="btn-pagination">Suivant -</button>
    </div>
@endsection