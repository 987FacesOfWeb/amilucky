<h1 class="title is-2">Recherche dans le set</h1>

<section class="section">
    <form method="post" action="/addCard/addtocollection" class="is-flex is-flex-wrap-wrap is-justify-content-center">

    <?php if($otherParams['collection'][0]->game_id == 1): ?>

        <?php foreach ($params['cardsFromSetId'] as $card):?>

             <div class="card container"  style="max-width: 40%; margin: 15px">
                <header class="card-header">
                    <p class="card-header-title">
                        <?= $card->getName().' No '.$card->getNumber() ?>
                    </p>
                </header>
                <div class="card-content" style="text-align: center">
                    <div class="content">
                        <img src="<?= $card->getImages()->getSmall() ?>">
                        <br>
                        <br>
                        <?= 'Cette carte appartient au set: '. $card->getSet()->getSeries() ?>
                        <br>
                        <br>
                        <?= 'Cette carte est une carte ' ?>
                        <div class="tag is-warning is-light is-medium">
                            <?= $card->getRarity() ?>
                        </div>
                        <br>
                        <br>
                        <?php if($card->getCardMarket() == null): ?>
                            <?= 'Le prix moyen de cette carte est indéfinis' ?>
                            <?php else:?>
                                <?= 'Le prix moyen de cette carte est de '.$card->getCardMarket()->getPrices()->getTrendPrice(). ' Euro'?>
                        <?php endif;?>
                    </div>
                </div>
                <footer class="card-footer has-text-centered">
                    <p class="notification is-success" style="margin: 5px;width: 100%">
                        Ajouter cette carte à ma collection
                        <input type="checkbox" class="checkbox" name="<?=$card->getName()?>" style="margin: 5px" value="<?=$card->getId()?>">
                        <input hidden name="collection_id" value="<?=$otherParams['collection'][0]->id?>">
                    </p>
                </footer>
            </div>
        <?php endforeach;?>

    <?php endif; ?>

    <?php if($otherParams['collection'][0]->game_id == 2): ?>

        <?php foreach ($params['allcardsFromSet'] as $card):?>

            <div class="card container"  style="max-width: 40%; margin: 15px">
                <header class="card-header">
                    <p class="card-header-title">
                        <?= $card->name.' No '.$card->number ?>
                    </p>
                </header>
                <div class="card-content" style="text-align: center">
                    <div class="content">
                        <?php if(empty($card->imageUrl)):?>
                        <img src="NO IMAGE">
                        <?php else: ?>
                            <img src="<?= $card->imageUrl ?>">
                        <?php endif; ?>
                        <br>
                        <br>
                        <?= 'Cette carte appartient au set: '. $card->setName ?>
                        <br>
                        <br>
                        <?= 'Cette carte est une carte ' ?>
                        <div class="tag is-warning is-light is-medium">
                            <?= $card->rarity ?>
                        </div>
                    </div>
                </div>
                <footer class="card-footer has-text-centered">
                    <p class="notification is-success" style="margin: 5px;width: 100%">
                        Ajouter cette carte à ma collection
                        <input type="checkbox" class="checkbox" name="<?=$card->name?>" style="margin: 5px" value="<?=$card->id?>">
                        <input hidden name="collection_id" value="<?=$otherParams['collection'][0]->id?>">
                    </p>
                </footer>
            </div>
        <?php endforeach;?>

    <?php endif; ?>
        <div class="box has-text-centered" style="width: 80%; margin-top: 20px">
            <button class="button button is-warning" type="submit">Ajouter les cartes à ma collection</button>
            <a class="button button is-link ml-3" href="/collections">Retour</a>
        </div>
    </form>
</section>
