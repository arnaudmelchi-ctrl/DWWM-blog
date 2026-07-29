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
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }
    .checkbox-group label {
        font-weight: normal;
        cursor: pointer;
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
    .auth-link {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9rem;
    }
    .auth-link a {
        color: #000;
        font-weight: bold;
    }
</style>

<div class="form-container">
    <h2 class="form-title">Se connecter</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
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

        <!-- Se souvenir de moi -->
        <div class="checkbox-group">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-submit">Se connecter</button>

        <div class="auth-link">
            Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
        </div>
    </form>
</div>
@endsection