<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   @extends('layouts.app')      
   @section('content')

    <div class="auth-bar">
        
        <span>
            Dashboard admin 
        </span>
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
</thead>
<tbody>
    <h1>Articles List !</h1>

    @foreach ($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>Catégorie :{{$article->category->name}}</td>
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
        <button class="btn-pagination">- Précédent</button>
        <span class="page-info">Page 1/2</span>
        <button class="btn-pagination">Suivant -</button>
    </div> 
    @endsection('content')
</body>
</html>