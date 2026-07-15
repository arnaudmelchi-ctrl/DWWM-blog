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

        <style>
    /* ... le reste de votre CSS ... */

    
</style>
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