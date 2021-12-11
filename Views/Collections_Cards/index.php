<?php
if(empty($_SESSION['auth']) || $params['collection'][0]->user_id != $_SESSION['auth']['id']){
    header('Location: /home');
}
?>
<h1 class="title is-2">Ajouter une carte à " <?= $params['collection'][0]->name?>"</h1>
<h2 class="subtitle is_5">
    Entrez le nom de votre carte ou choisissez dans la liste le nom du Set dont elle provient
</h2>

<section class="section">
    <form method="post" action="/addCard/searchCard">
        <label class="label" for="nameToSearch">Entrez le nom de la carte</label>
        <input class="input" type="text" name="nameToSearch" id="nameToSearch">
        <label class="label" for="listSetsIds">Liste des Sets</label>
        <select class="select" name="listeSetsIds" id="listSetsIds">
            <?php if($params['collection'][0]->game_id == 1): ?>
            <?php foreach ($otherParams['setsIds'] as $name) : ?>
            <option>
                <?= $name ?>
            </option>
            <?php endforeach; ?>
            <?php endif;?>

            <?php if($params['collection'][0]->game_id == 2): ?>
                <?php foreach ($otherParams['setsMagicNames'] as $name) : ?>
                    <option>
                        <?= $name ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <br>
        <input hidden name="userId" value="<?= $params['collection'][0]->user_id?>">
        <input hidden name="collectionId" value="<?=$params['collection'][0]->id?>">
        <button class="button button is-success mt-5" type="submit">Suivant</button>
        <a class="button button is-link mt-5 ml-5" href="/collections">Retour aux collections</a>
    </form>
</section>

