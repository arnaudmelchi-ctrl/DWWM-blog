@extends('layouts.app')

@section('content')
    <h1>Détails de l'article</h1>
    <div class="article-detail">
        <h2>{{ $article->title }}</h2>
        
        <p class="text-muted">
            <strong>Publié par :</strong> {{ $article->user->name ?? 'Auteur inconnu' }}
        </p>

        <p>{{ $article->content }}</p>
        <p><strong>Catégorie :</strong> {{ $article->category->name ?? 'Sans catégorie' }}</p>
        
        <p><strong>Tags :</strong> 
            @if($article->tags && $article->tags->count() > 0)
                @foreach ($article->tags as $tag)
                    {{ $tag->name }}@if (!$loop->last), @endif
                @endforeach
            @else
                Aucun tag
            @endif
        </p>
    </div>
@endsection