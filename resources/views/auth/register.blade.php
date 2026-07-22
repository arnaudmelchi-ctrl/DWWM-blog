@extends('layouts.app') 

@section('content')
<style>
    .form-container {
        max-width: 400px;
        margin: 40px auto;
        padding: 30px;
        border: 2px solid #000;
    }
    .form-title {
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-control {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #000;
        box-sizing: border-box;
    }
    .btn-submit {
        background: #000;
        color: #fff;
        border: none;
        padding: 10px 15px;
        width: 100%;
        cursor: pointer;
        font-weight: bold;
        margin-top: 10px;
    }
    .btn-submit:hover {
        background: #333;
    }
    .error-msg {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 4px;
    }
</style>

<div class="form-container">
    <h2 class="form-title">Créer un compte</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Prénom -->
        <div class="form-group">
            <label for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
            @error('first_name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nom -->
        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
            @error('last_name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn-submit">S'inscrire</button>
    </form>
</div>
@endsection