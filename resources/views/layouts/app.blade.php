<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWWM Blog</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; }
        
        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between; /* Espace logo et liens */
            align-items: center;
            padding: 20px 50px;
            border-bottom: 2px solid #000; /* Ligne sous la nav */
        }
        .logo-placeholder {
            width: 50px;
            height: 50px;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }
        .nav-links { 
            display: flex; 
            align-items: center;
            gap: 20px; 
        }
        .auth-link { 
            text-decoration: none; 
            color: #000; 
            font-weight: bold;
        }
        .user-greeting {
            font-weight: bold;
        }

        /* Bouton de déconnexion */
        .btn-logout {
            background: transparent;
            border: 2px solid #000;
            padding: 6px 12px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .btn-logout:hover {
            background: #000;
            color: #fff;
        }

        /* Contenu */
        main { padding: 40px 50px; }

        /* ==========================================
           STYLE DES BADGES DE STATUT
        ========================================== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Espace entre le point et le texte */
            padding: 4px 12px;
            border-radius: 9999px; /* Forme de pilule */
            font-size: 0.85rem;
            font-weight: bold;
        }

        /* Style pour "Publié" */
        .status-badge.published {
            background-color: #dcfce7;
            color: #15803d;
        }
        .status-badge.published::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #16a34a;
            border-radius: 50%;
        }

        /* Style pour "Brouillon" */
        .status-badge.draft {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        .status-badge.draft::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #9ca3af;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('articles.index') }}" class="logo-placeholder">X</a>
        
        <div class="nav-links">
            @auth
                <!-- Si l'utilisateur est connecté -->
                <span class="user-greeting">Bonjour, {{ Auth::user()->first_name }} !</span>

                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Se déconnecter</button>
                </form>
            @endauth

            @guest
                <!-- Si l'utilisateur n'est PAS connecté -->
                <a href="{{ route('login') }}" class="auth-link">Se connecter</a>
                <a href="{{ route('register') }}" class="auth-link">S'inscrire</a>
            @endguest
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>