<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
     

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
            <div class="article-card">

                <div class="article-header">
                    <span class="article-tags">[ {{ $article->category->name }} ] [ Tag 1 ]</span>
                    <span class="article-date">{{ $article->created_at->format('d M. Y') }}</span>
                </div>

                <h2>{{ $article->title }}</h2>

                <p class="article-excerpt">{{ $article->content }}</p>

                <div class="article-footer">
                    <a href="#" class="read-more">Lire -></a>
                </div>

            </div>
        @endforeach
    </div>

    <div class="pagination-container">
        <button class="btn-pagination">- Précédent</button>
        <span class="page-info">Page 1/4</span>
        <button class="btn-pagination">Suivant -</button>
    </div>
    @endsection('content')
</body>
</html>