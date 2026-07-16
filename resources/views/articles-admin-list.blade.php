@extends('layouts.app')

@section('content')

    <style>
        .pagination-container svg {
            width: 20px !important;
            height: 20px !important;
            display: inline-block !important;
        }
        .pagination-container {
            margin-top: 20px;
        }
    </style>

    <div class="auth-bar">
        <span>Dashboard admin</span>
        <a href="#" class="auth-link">Déconnexion</a>
    </div>
    
    <div class="admin-header">
         <h1>Articles</h1>  
         <a href="#" class="btn-creat">Nouvel article</a>
    </div>

    <table>   
        <thead>
            <tr>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>Catégorie : {{$article->category->name}}</td>
                    @if ($article->status === 'published')
                        <td>Statut : Publié</td>
                    @else
                        <td>Statut : Brouillon</td>
                    @endif
                    <td>{{$article->created_at->format('d/m/Y')}}</td>
                    <td class="actions-cell">✏️ ❌ ➔</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $articles->links() }}
    </div> 

@endsection