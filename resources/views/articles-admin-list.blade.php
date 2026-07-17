HTML
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
         <a href="{{ route('admin.articles.create') }}" class="btn-creat">Nouvel article</a>
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
                    <td>{{ $article->category->name }}</td>
                    {{-- Correction ici : On compare avec les majuscules PUBLISHED --}}
                    @if ($article->status === 'PUBLISHED')
                        <td><span class="status-badge published">Publié</span></td>
                    @else
                        <td><span class="status-badge draft">Brouillon</span></td>
                    @endif
                    <td>{{ $article->created_at->format('d/m/Y') }}</td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.articles.edit', $article->slug) }}" class="btn btn-edit">✏️</a>
                        
                        <form action="{{ route('admin.articles.destroy', $article->slug) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">❌</button>
                        </form>
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-view">➔</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        {{ $articles->links() }}
    </div> 

@endsection