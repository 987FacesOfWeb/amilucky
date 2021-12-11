<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Am I Lucky</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a href="/" class="mr-5 ml-3">
                <img src="../public/images/amilucky_logo.png" width="150" height="100">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/home">
                    Accueil
                </a>

                <a class="navbar-item" href="/cards">
                    Dernières cartes ajoutées
                </a>
            </div>
            <div class="navbar-end">
                <?php
                if(isset($_SESSION['auth']) && !empty($_SESSION['auth']['username'])): ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="/collections">
                            <strong>Mes collections</strong>
                        </a>
                        <a class="button is-warning" href="/logout">
                            Se déconnecter
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="/register">
                            <strong>S'inscrire</strong>
                        </a>
                        <a class="button is-warning" href="/login">
                            Se connecter
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section class="section">
        <?=$content ?>
    </section>

    <footer class="footer is-dark">
        <div class="content is-flex is-flex-wrap-wrap is-justify-content-center">
            <div class="has-text-centered mb-4" style="width: 100%">
                <a href="/">
                    <img src="../public/images/amilucky_logo_court.png" width="280" >
                </a>
            </div>
            <a class="button is-dark mr-5" href="/">Accueil</a>
            <a class="button is-dark mb-5" href="/cards">Dernières cartes ajoutées</a>
        </div>
        <div class="content is-small has-text-centered">
            <p>
                Made With Love by Julien Ramirez - Tous droits réservés ©987FacesOfWeb 2021
            </p>
        </div>
    </footer>
</body>
</html>
