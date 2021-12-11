
<section class="section" style="margin: 0 auto; text-align: center">
    <p class="container" style="text-align: center">
    <h1 class="title is-1">Les collections de <?= ucfirst($_SESSION['auth']['username']) ?></h1>
    <h2 class="subtitle is-3" style="margin-bottom: 80px">Ici tu peux gérer tes collections</h2>

    <div class="container mb-5">
        <a class="button button is-success" href="/newCollection" style="text-align: center; margin: 10px auto">Créer une nouvelle collection</a>
    </div>

    <article class="panel is-info" style="max-width: 80%; text-align: center; margin: 20px auto">
        <p class="panel-heading">
            Gestion de collections Pokémon
        </p>
        <?php foreach ($params['collectionPoke'] as $param): ?>
            <?php if($param->user_id === $_SESSION['auth']['id']): ?>
                <div class="panel-block" style="display: flex; justify-content: center;">
                    <p class="panel-block" style="font-size: 16px">
                        <strong><?= $param->name ?> </strong>
                        <a class="button button is-success is-light" href="/collections/<?= $param->id  ?>" style="margin-left: 15px" >Voir</a>
                        <a class="button button is-warning is-light" style="margin-left: 15px" href="/modify/<?= $param->id ?>" >Modifier</a>
                        <a class="button button is-danger is-light" style="margin-left: 15px" href="/delete/<?= $param->id?>" >Supprimer</a>
                    </p>
                </div>

            <?php endif; ?>
        <?php endforeach ?>
    </article>

    <article class="panel is-dark" style="max-width: 80%; text-align: center; margin: 50px auto">
        <p class="panel-heading">
            Gestion de collections Magic the Gathering
        </p>
        <?php foreach ($otherParams['collectionMagic'] as $param): ?>
            <?php if($param->user_id === $_SESSION['auth']['id']): ?>
                <div class="panel-block" style="display: flex; justify-content: center;">
                    <p class="panel-block" style="font-size: 16px">
                        <strong><?= $param->name ?> </strong>
                        <a class="button button is-success is-light" href="/collections/<?= $param->id  ?>" style="margin-left: 15px" >Voir</a>
                        <a class="button button is-warning is-light" style="margin-left: 15px" href="/modify/<?= $param->id ?>" >Modifier</a>
                        <a class="button button is-danger is-light" style="margin-left: 15px" href="/delete/<?= $param->id?>" >Supprimer</a>
                    </p>
                </div>

            <?php endif; ?>
        <?php endforeach ?>
    </article>
</section>


