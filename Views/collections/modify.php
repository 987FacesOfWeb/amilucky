<?php
if(empty($_SESSION['auth']) || $params['collection'][0]->user_id != $_SESSION['auth']['id']) {
    header('Location: /home');
}

?>


<h1 class="title is-3 has-text-centered">Modifie ta collection : "<?= $params['collection'][0]->name?>"</h1>

<div class="box" style="max-width: 50%; margin: 0 auto; text-align: center">
    <h2 class="subtitle is-5">Panel de contrôle</h2>
    <form method="post" action="/collections/<?= $params['collection'][0]->id ?>">
        <label for="newCollectionName" class="label">Nouveau nom de la collection</label>
        <input class="input mb-3" name="newCollectionName" id="newCollectionName" type="text">
        <button class="button button is-warning mb-5" type="submit" >Modifier le nom de la collection</button>
    </form>
    <a class="button button is-success" href="/addCard/<?= $params['collection'][0]->id?>" >Ajouter une carte à la collection</a>
</div>

<div class="is-flex is-flex-wrap-wrap is-justify-content-center" style="margin-top: 15px">
    <?php foreach ($otherParams['cards'] as $card): ?>
        <div class="card container" style="margin: 10px; max-width: 50%">
            <header class="card-header">
                <p class="card-header-title">
                    <?= $card->cardname.' No '.$card->nbrcard ?>
                </p>
            </header>
            <div class="card-content" style="text-align: center">
                <div class="content">
                    <img src="<?= $card->image ?>">
                    <br>
                    <br>
                    <?= 'Cette carte appartient au set: '. $card->setname ?>
                    <br>
                    <br>
                    <?= 'Cette carte est une carte ' ?>
                    <div class="tag is-warning is-light is-medium">
                        <?= $card->rarity ?>
                    </div>
                    <br>
                    <br>
                    <?= 'Le prix moyen de cette carte est de '.$card->price. ' Euro' ?>
                </div>
            </div>
            <footer class="card-footer" style="max-width: 40%; text-align: center; margin: 0 auto">
                    <a class="card-footer-item">
                        <form method="POST" action="/modify/<?= $params['collection'][0]->id  ?>">
                            <input hidden name="collection_id" value="<?=$params['collection'][0]->id?>">
                            <input hidden name="card_id" value="<?=$card->card_id?>">
                            <input hidden name="user_id" value="<?=$_SESSION['auth']['id']?>">
                            <button class="button button is-danger" type="submit">Supprimer</button>
                        </form>
                    </a>
            </footer>
        </div>
        <br>
        <br>
    <?php endforeach;?>
</div>
<div class="box has-text-centered">
    <a class="button button is-link mt-5" href="/collections">Retour aux collections</a>
</div>
