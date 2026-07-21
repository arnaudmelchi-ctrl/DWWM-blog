@extends('layouts.app')

@section('content')

    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-create {
            background-color: #000;
            color: #fff;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        th {
            background-color: #f9fafb;
        }
        .actions-cell {
            display: flex;
            gap: 8px;
        }
        .btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-edit { background-color: #fef08a; }
        .btn-delete { background-color: #fecaca; }
        .badge-count {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .alert-success {
            background-color: #dcfce7;
            color: #15803d;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>

    {{-- Message flash de succès --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-header">
        <h1>Administration des Catégories</h1>  
        <a href="{{ route('admin.categories.create') }}" class="btn-create">+ Nouvelle catégorie</a>
    </div>

    <table>   
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre d'articles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>
                        <span class="badge-count">
                            {{-- Méthode recommandée par ta prof : --}}
                            {{ $category->articles->count() }} {{ Str::plural('article', $category->articles->count()) }}
                        </span>
                    </td>
                    <td class="actions-cell">
                        {{-- Modifier --}}
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit" title="Modifier">✏️</a>
                        
                        {{-- Supprimer --}}
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">❌</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #6b7280; padding: 20px;">
                        Aucune catégorie trouvée.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection