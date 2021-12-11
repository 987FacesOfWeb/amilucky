<?php if(!empty($_SESSION['auth'])) {
    header('Location: /home');
}
?>

<?php if (isset($_SESSION['errors'])): ?>

    <?php foreach ($_SESSION['errors'] as $errorsArray): ?>

        <?php foreach ($errorsArray as $errors): ?>
            <div class="notification is-danger">
                <?php foreach ($errors as $error): ?>
                    <li> <?= $error ?> </li>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    <?php endforeach; ?>

<?php endif; ?>

<?php session_destroy(); ?>

<h1 class="title is-1">Connectez-vous</h1>

<section class="section">
    <div class="box">
        <form method="POST" action="/login" class="form">
            <div class="field">
                <label class="label" for="username">Pseudo</label>
                <div class="control">
                    <input name="username" class="input" type="text" placeholder="Votre pseudo...">
                </div>
            </div>
            <div class="field">
                <label for="password" class="label">Mot de passe</label>
                <div class="control">
                    <input class="input" type="password" name="password">
                </div>
            </div>
            <div class="control">
                <button type="submit" class="button is-primary">Se connecter</button>
            </div>
        </form>
    </div>
</section>
