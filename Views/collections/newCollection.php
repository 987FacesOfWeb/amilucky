<h1 class="title is-2">Créer ta nouvelle collection de cartes</h1>

<section class="section">
    <form method="post" action="/addSuccess">
        <label class="label" for="newCollection">Nom de la collection</label>
        <input class="input" name="newCollection" type="text" placeholder="Nom de votre collection">

        <div class="control mt-5">
            <label class="radio">
                <input type="radio" name="game" value="1" required>
               Collection Pokémon
            </label>
            <label class="radio">
                <input type="radio" name="game" value="2" required>
                Collection Magic the Gathering
            </label>
        </div>
        <button class="button button is-success mt-5" type="submit">Créer la collection</button>
        <a class="button button is-link mt-5 ml-5" href="/collections">Retour</a>
    </form>
</section>