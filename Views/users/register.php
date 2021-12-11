<?php if(!empty($_SESSION['auth'])) {
    header('Location: /home');
} ?>

<?php if(isset($_SESSION['errors'])): ?>

    <?php foreach ($_SESSION['errors'] as $errorsArray): ?>

        <?php foreach ($errorsArray as $errors): ?>
            <div class="notification is-danger">
                <?php foreach ($errors as $error): ?>
                    <li> <?= $error ?> </li>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>

    <?php endforeach; ?>

    <?php session_destroy(); ?>

<?php endif; ?>

<?php if (isset($_SESSION['errorsRegister'])): ?>

    <div class="notification is-danger">
        <?php foreach ($_SESSION['errorsRegister'] as $error): ?>
            <li> <?= $error ?> </li>
        <?php endforeach; ?>
    </div>

    <?php session_destroy(); ?>

<?php endif; ?>

<?php if(isset($_SESSION['errorRepeat'])): ?>

    <?php foreach ($_SESSION['errorRepeat'] as $errorP): ?>
        <div class="notification is-danger">
            <li> <?= $errorP ?> </li>
        </div>
    <?php endforeach; ?>

    <?php session_destroy(); ?>

<?php endif; ?>


<h1 class="title is-1">Inscrivez-vous</h1>

<section class="section">
    <div class="box">
        <form method="POST" action="/registered" id="formRegister">
            <div class="field">
                <label class="label" for="Nom">Nom</label>
                <div class="control">
                    <input name="Nom" class="input" type="text" placeholder="Votre nom...">
                </div>
                <p id="fnameTxt-err" class="registerErr"></p>
            </div>
            <div class="field">
                <label class="label" for="Prénom">Prénom</label>
                <div class="control">
                    <input name="Prénom" class="input" type="text" placeholder="Votre prénom...">
                </div>
                <p id="lnameTxt-err" class="registerErr"></p>
            </div>
            <div class="field">
                <label class="label" for="Pseudo">Pseudo</label>
                <div class="control">
                    <input name="Pseudo" class="input" type="text" placeholder="Votre pseudo...">
                </div>
                <p id="usernameTxt-err" class="registerErr"></p>
            </div>
            <div class="field">
                <label for="Email" class="label">Adresse email</label>
                <div class="control">
                    <input class="input" type="email" name="Email" placeholder="Votre adresse e-mail">
                </div>
                <p id="emailTxt-err" class="registerErr"></p>
            </div>
            <div class="field">
                <label for="Password" class="label">Mot de passe</label>
                <div class="control">
                    <input class="input" type="password" name="Password">
                </div>
                <p id="pwdTxt-err" class="registerErr"></p>
            </div>
            <div class="field">
                <label for="PasswordRepeat" class="label">Répétez votre mot de passe</label>
                <div class="control">
                    <input class="input" type="password" name="PasswordRepeat">
                </div>
                <p id="pwdcheckTxt-err" class="registerErr"></p>
            </div>
            <p id="success"></p>
            <div class="control">
                <button type="submit" class="button is-primary mt-3">S'inscrire</button>
            </div>
        </form>
    </div>
</section>