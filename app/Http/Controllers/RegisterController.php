<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Affiche la vue du formulaire d'inscription
    public function create()
    {
        return view('auth.register');
    }

    // Traite la soumission du formulaire
    public function store(Request $request)
    {
        // 1. Validation des champs reçus
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            // Messages d'erreur en français
            'name.required'     => 'Le nom est obligatoire.',
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'L\'adresse email doit être valide.',
            'email.unique'      => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'      => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'=> 'Les deux mots de passe ne correspondent pas.',
        ]);

        // 2. Création de l'utilisateur
        // (Comme tu as 'password' => 'hashed' dans tes casts du modèle, Hash::make() est géré par Laravel)
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ]);

        // 3. Connexion de l'utilisateur
        Auth::login($user);

        // 4. Redirection vers la liste des articles
        return redirect()->route('articles.index')->with('success', 'Bienvenue ! Votre compte a été créé.');
    }
}