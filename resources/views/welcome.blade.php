{{-- @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>
        @endauth
    </nav>
@endif --}}

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des congés et absences</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        body {
            background-color: rgba(247, 250, 255, 255);
            /* Arrière-plan bleu très clair */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Désactive le défilement */
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* Hauteur totale de la fenêtre */
        }

        .navbar {
            background-color: rgba(56, 136, 253, 255);
            /* Bleu vif pour la barre de navigation */
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 255) !important;
            /* Texte blanc */
        }

        .welcome-section {
            flex: 1;
            /* Prend tout l'espace disponible */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: rgba(255, 255, 255, 255);
            /* Arrière-plan blanc */
            padding: 20px;
        }

        .welcome-content {
            max-width: 800px;
        }

        .welcome-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .quick-links {
            padding: 50px 0;
            background-color: rgba(247, 250, 255, 255);
            /* Arrière-plan bleu très clair */
            text-align: center;
        }

        .btn-primary {
            background-color: rgba(56, 136, 253, 255);
            /* Bleu vif pour les boutons */
            border: none;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: rgba(40, 110, 220, 255);
            /* Bleu légèrement plus foncé au survol */
        }

        .footer {
            background-color: rgba(56, 136, 253, 255);
            /* Bleu vif pour le pied de page */
            color: rgba(255, 255, 255, 255);
            /* Texte blanc */
            text-align: center;
            padding: 10px 0;
            position: fixed;
            /* Footer fixé en bas */
            width: 100%;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <!-- En-tête -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/e-sica.png') }}" alt="Logo" style="height: 40px;">
                e-SICA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <!-- Liens pour les utilisateurs connectés -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
                        </li>
                    @else
                        <!-- Liens pour les utilisateurs non connectés -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section de bienvenue -->
    <section class="welcome-section">
        <div class="welcome-content">
            {{-- <img src="{{ asset('assets/images/illustration.png') }}" alt="Illustration"> --}}
            <h1>Bienvenue sur l'application de gestion des congés</h1>
            <p class="lead">Gérez vos demandes de congés et d'absences en toute simplicité.</p>
        </div>
    </section>

    <!-- Liens rapides -->


    <!-- Pied de page -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Gestion des congés. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
