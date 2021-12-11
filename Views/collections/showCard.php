<?php $card = $params['cardForView'];

    if($otherParams['collection'] == 1) : ?>

     <div class="card container" style="margin: 10px; max-width: 50%">
        <header class="card-header">
            <p class="card-header-title">
                <?= $card->getName().' No '.$card->getNumber() ?>
            </p>
        </header>
        <div class="card-content" style="text-align: center">
            <div class="content">
                <img src="<?= $card->getImages()->getLarge() ?>">
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
        <footer class="card-footer">
            <a class="button button is-link m-3" href="/collections">Retour</a>
        </footer>
    </div>

    <?php endif; ?>

    <?php if($otherParams['collection'] == 2) : ?>

        <div class="card container" style="margin: 10px; max-width: 50%">
            <header class="card-header">
                <p class="card-header-title">
                    <?= $card->name.' No '.$card->number ?>
                </p>
            </header>
            <div class="card-content" style="text-align: center">
                <div class="content">
                    <img src="<?= $card->imageUrl ?>">
                    <br>
                    <br>
                    <?= 'Cette carte appartient au set: '. $card->setName?>
                    <br>
                    <br>
                    <?= 'Cette carte est une carte ' ?>
                    <div class="tag is-warning is-light is-medium">
                        <?= $card->rarity ?>
                    </div>
                    <br>
                </div>
            </div>
            <footer class="card-footer">
                <a class="button button is-link m-3" href="/collections">Retour</a>
            </footer>
        </div>

    <?php endif; ?>

