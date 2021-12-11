<?php
if(empty($_SESSION['auth']) || $params['collection'][0]->user_id != $_SESSION['auth']['id']) {
    header('Location: /home');
}
?>

<h1 class="title is-3">ICI ON CONFIRME QU'ON VEUT SUPPRIMER</h1>

<div class="box">
    <form method="post" action="/deleteSuccess">
        <p class="title is-5">Vous êtes sur le point de supprimer la collection "<?= $params['collection'][0]->name ?>"
        <br>
         Voulez-vous confirmer la suppression ?</p>
        <button class="button button is-danger mt-5 mr-5" type="submit">Confirmer</button>
        <input hidden name="id_collection" value="<?= $params['collection'][0]->id?>">
        <a class="button button is-link mt-5" href="/collections">Retour</a>
    </form>
</div>
