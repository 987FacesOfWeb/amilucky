<?php
    if(empty($_SESSION['auth']) || $params['collection'][0]->user_id != $_SESSION['auth']['id']) {
        header('Location: /home');
    }

?>

<h1 class="title is-3 has-text-centered">Ta collection : "<?= $params['collection'][0]->name?>"</h1>

<div class="is-flex is-flex-wrap-wrap is-justify-content-center">
    <?php foreach ($otherParams['cards'] as $card): ?>
    <div class="card container" style="margin: 10px; max-width: 40%">
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
        <footer class="card-footer has-text-centered">
            <form class="m-2" method="post" action="/showCard/<?= $card->cardname?>">
                <button class="card-footer-item button button is-success" type="submit">Voir plus</button>
                <input hidden name="cardImg" value="<?=$card->image?>">
                <input hidden name="nameCollection" value="<?= $params['collection'][0]->name ?>">
            </form>
        </footer>
    </div>
    <br>
    <br>
    <?php endforeach;?>
</div>
<a class="button button is-link mt-5" href="/collections">Retour aux collection</a>





