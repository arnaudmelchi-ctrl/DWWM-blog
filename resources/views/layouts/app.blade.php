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
        }
        .nav-links { display: flex; gap: 20px; }
        .auth-link { text-decoration: none; color: #000; }

        /* Contenu */
        main { padding: 40px 50px; }

        /* ==========================================
           STYLE DES BADGES DE STATUT (NOUVEAU)
        ========================================== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px; /* Espace entre le point et le texte */
            padding: 4px 12px;
            border-radius: 9999px; /* Donne une forme de pilule bien arrondie */
            font-size: 0.85rem;
            font-weight: bold;
        }

        /* Style pour "Publié" */
        .status-badge.published {
            background-color: #dcfce7; /* Fond vert clair */
            color: #15803d; /* Texte vert foncé */
        }
        /* Le petit point vert */
        .status-badge.published::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #16a34a; /* Couleur du point vert */
            border-radius: 50%;
        }

        /* Style pour "Brouillon" */
        .status-badge.draft {
            background-color: #f3f4f6; /* Fond gris clair */
            color: #4b5563; /* Texte gris foncé */
        }
        /* Le petit point gris */
        .status-badge.draft::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #9ca3af; /* Couleur du point gris */
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-placeholder">X</div>
        <div class="nav-links">
            <a href="#" class="auth-link">Se connecter</a>
            <a href="#" class="auth-link">S'inscrire</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>