@extends('layouts.app')

@section('content')

    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 4px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
        }
        .btn-submit {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-cancel {
            color: #4b5563;
            text-decoration: none;
        }
    </style>

    <div class="form-container">
        <h1>{{ isset($category) ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}</h1>

        <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
            @csrf
            
            @if (isset($category))
                @method('PUT')
            @endif

            {{-- Champ Nom --}}
            <div class="form-group">
                <label for="name">Nom de la catégorie *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control" 
                    value="{{ old('name', $category->name ?? '') }}" 
                    required
                >
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Champ Slug (Optionnel) --}}
            <div class="form-group">
                <label for="slug">Slug (optionnel)</label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    class="form-control" 
                    value="{{ old('slug', $category->slug ?? '') }}"
                    placeholder="Laissez vide pour le générer automatiquement"
                >
                @error('slug')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Annuler</a>
                <button type="submit" class="btn-submit">
                    {{ isset($category) ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
            </div>
        </form>
    </div>

@endsection