<h1 class="title is-2">Les dernières cartes ajoutées</h1>

<section class="section">
    <div class="is-flex is-flex-wrap-wrap">

        <?php  foreach ($params['cards'] as $card): ?>
            <div class="card container"  style="max-width: 40%; margin: 15px">
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
                        <div class="tag is-link">
                            <?= $card->rarity ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>