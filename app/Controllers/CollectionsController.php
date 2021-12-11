<?php

    namespace App\Controllers;

    use App\Models\ApiMagicModel;
    use App\Models\ApiPokeModel;
    use App\Models\CardModel;
    use App\Models\Collections_CardsModel;
    use App\Models\CollectionsModel;


    //Cette classe gère les actions liées aux collections
    class CollectionsController extends Controller
    {

        //Envoie à la vue les collections possédées par le user
        public function index()
        {
            if ($_SESSION['auth'] === null) {
                header('Location: /');
            }

            $collections = new CollectionsModel();
            $collectionPoke = $collections->findBy(['game_id' => 1]);
            $collectionMagic = $collections->findBy(['game_id' => 2]);


            return $this->view('collections.index', compact('collectionPoke'), compact('collectionMagic'));
        }


        //Envoie à la vue les cartes liées à la collection
        public function manage(int $id)
        {
            $collections = new CollectionsModel();
            $collection = $collections->findBy(['id' => $id]);

            $collectionName = $collection[0]->name;
            $cards = $collections->findCardsByCollection($collectionName);

            return $this->view('collections.manage', compact('collection'), compact('cards'));
        }


        //Envoie à la vue la carte à afficher (voir plus sous la carte)
        public function showCard()
        {
            $bddCards = new CardModel();
            $collectionModel = new CollectionsModel();

            $imgToSearch = $_POST['cardImg'];
            $collectionId = $_POST['nameCollection'];
            $collection = $collectionModel->getByName($collectionId)[0]->game_id;

            $cardInBdd = $bddCards->findCardByImg($imgToSearch);
            $card_id = $cardInBdd->card_id;


            if($collection == 1) {

                $apiPokeModel = new ApiPokeModel();
                $cardForView = $apiPokeModel->getCardById($card_id);
                return $this->view('collections.showCard', compact('cardForView'), compact('collection'));

            }

            if($collection == 2) {

                $apiMagicModel = new ApiMagicModel();
                $cardForView = $apiMagicModel->getCardMagicById($card_id);
                return $this->view('collections.showCard', compact('cardForView'), compact('collection'));

            }

        }


        //Envoie à la vue la création de la nouvelle collection
        public function addNewCollection()
        {
            if ($_SESSION['auth'] === null) {
                header('Location: /');
            }

            return $this->view('collections.newCollection');
        }


        //Envoie au modèle la nouvelle collection à créer et renvoie la vue de la confirmation de création
        public function addNewCollectionPost()
        {
            $collectionModel = new CollectionsModel();
            $user_id = $_SESSION['auth']['id'];
            $newCollection = trim($_POST['newCollection']);
            $game_id = (int)$_POST['game'];


            $collectionModel->createNewCollection($newCollection,$user_id, $game_id);
            $lastRecord = $collectionModel->getLastRecordCollection();


            return $this->view('collections.newCollectionPost',compact('lastRecord'), compact('newCollection'));

        }


        //Envoie au modèle le nouveau nom de la collection puis renvoie la vue des collections
        public function updateCollectionName(int $id)
        {
            $collections = new CollectionsModel();
            $newName = $_POST['newCollectionName'];

            $collections->updateNameCollection($id, $newName);

            header('Location: /collections');
        }


        //Renvoie à la vue les cartes de la collections
        public function modify(int $id)
        {
            $collections = new CollectionsModel();
            $collection = $collections->findBy(['id' => $id]);

            $collectionName = $collection[0]->name;
            $cards = $collections->findCardsByCollection($collectionName);

            return $this->view('collections.modify', compact('collection'), compact('cards'));
        }


        //Envoie à la vue la collection à supprimer
        public function deleteCollection(int $id)
        {
            $collections = new CollectionsModel();
            $collection = $collections->findBy(['id' => $id]);

            return $this->view('collections.deleteCollection',compact('collection'));
        }


        //Envoie au modèle l'id de la collection à supprimer puis retourne la vue de confirmation
        public function deleteCollectionPost()
        {
            $collection_id = $_POST['id_collection'];

            $collectionModel = new CollectionsModel();
            $collectionCardsModel = new Collections_CardsModel();

            $collectionModel->delete($collection_id);
            $collectionCardsModel->deleteCollectionCards($collection_id);

            return $this->view('collections.deleteCollectionPost');
        }


        //Envoie au modèle l'id de la carte à supprimer (selon le user et la collection) puis renvoie sur la page de gestion des collections
        public function deleteCard(int $id)
        {

            $collection_id = (int) $_POST['collection_id'];
            $user_id = (int) $_POST['user_id'];
            $card_id = (int) $_POST['card_id'];

            $collection = new CollectionsModel();
            $collection_card = new Collections_CardsModel();

            $idCollections_cards = $collection->findIdCollections_cards($card_id,$collection_id, $user_id);
            $collection_card->deleteCardFromCollection((int)$idCollections_cards->id);

            header('Location: /modify/'.$collection_id);

        }
    }