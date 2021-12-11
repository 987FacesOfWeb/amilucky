<?php if (isset($_SESSION['errorsRegister'])): ?>

        <div class="notification is-danger">
            <?php foreach ($_SESSION['errorsRegister'] as $error): ?>
                <li> <?= $error ?> </li>
            <?php endforeach; ?>
        </div>

<?php endif; ?>

<?php session_destroy(); ?>


<section class="section">
    <div class="box">
        <h1 class="title is-1">Merci pour ton inscription</h1>
        <a class="button button is-success" href="/login">Se connecter</a>
        <a class="button button is-link" href="/home">Retour à l'accueil</a>
    </div>
</section>



