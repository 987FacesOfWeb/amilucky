<?php

    namespace App\Controllers;


    use App\Models\ApiMagicModel;
    use App\Models\ApiPokeModel;
    use App\Models\CardModel;
    use App\Models\Collections_CardsModel;
    use App\Models\CollectionsModel;


    //Cette classe gère les collections de cartes
    class Collections_CardsController extends Controller {


        //Envoie à la vue la liste des sets correspondant au jeu choisis (Pokémon ou Magic)
        public function index(int $collection_id)
        {
            $collections = new CollectionsModel();
            $collection = $collections->findBy(['id' => $collection_id]);

            if($collection[0]->game_id == 1) {
                $apiModel = new ApiPokeModel();
                $setsIds = $apiModel->getAllSets();

                return $this->view('Collections_Cards.index', compact('collection'),compact('setsIds'));

            }else {
                $apiMagicModel = new ApiMagicModel();
                $setsMagicNames = $apiMagicModel->getSetsNamesCodes();

                return $this->view('Collections_Cards.index', compact('collection'),compact('setsMagicNames'));
            }
        }


        //Envoie à la vue la liste des cartes correspondant aux sets ou au nom entré par le user (premier set = valeur par défaut)
        public function searchCard()
        {
            $apiModel = new ApiPokeModel();
            $apiMagicModel = new ApiMagicModel();
            $collections = new CollectionsModel();
            $collection = $collections->findBy(['id' => $_POST['collectionId']]);

            if(empty($_SESSION['auth']) ||$_POST['userId'] != $_SESSION['auth']['id']) {

                header('Location: /home');
            }


            if($collection[0]->game_id == 1) {

                if(!empty($_POST['nameToSearch'])) {

                    $cardsFromName = $apiModel->getCardByName($_POST['nameToSearch']);

                    return $this->view('Collections_Cards.searchByName', compact('cardsFromName'), compact('collection'));
                }
                else {

                    $cardsFromSetId = $apiModel->getCardsFromSetId($_POST['listeSetsIds']);

                    return $this->view('Collections_Cards.searchBySet', compact('cardsFromSetId'), compact('collection'));
                }
            }


            if($collection[0]->game_id == 2) {

                if(!empty($_POST['nameToSearch'])) {

                    $cardsFromNameMagic = $apiMagicModel->getCardMagicFromName($_POST['nameToSearch']);

                    return $this->view('Collections_Cards.searchByName', compact('cardsFromNameMagic'), compact('collection'));
                }
                else {

                    $allcardsFromSet = $apiMagicModel->getCardsFromSetCodeMagic($_POST['listeSetsIds']);

                    return $this->view('Collections_Cards.searchBySet', compact('allcardsFromSet'), compact('collection'));
                }
            }
        }


        //Recherche si la/les carte existe déjà dans la Bdd, l'ajoute le cas échéant, puis met à jour la collection du user
        public function addCardsBdd()
        {
            $arrayOfCards = [];
            $pokeModel = new ApiPokeModel();
            $magicModel = new ApiMagicModel();
            $collections = new CollectionsModel();

            $collection = $collections->findBy(['id' => $_POST['collection_id']]);
            $idOfCollection = (int)$_POST['collection_id'];
            $userId = (int)$_SESSION['auth']['id'];


            foreach ($_POST as $card){

                if($card != $_POST['collection_id']){
                    array_push($arrayOfCards, $card);
                }
            }

            foreach ($arrayOfCards as $cardToAdd) {

                if(!$this->checkIfCardExistInBdd($cardToAdd)) { //Contrôle si la carte existe dans la Bdd

                    if($collection[0]->game_id == 1) {

                        $this->createCardPoke($cardToAdd); //Ajoute la/les carte (pokémon) à la bdd
                    }

                    if($collection[0]->game_id == 2) {

                        $this->createCardMagic($cardToAdd); //Ajoute la/les carte (magic) à la bdd
                    }

                }
            }

            $this->updateCollection($arrayOfCards, $idOfCollection, $userId); //Met à jour la collection du user

            //Récupère la liste des sets pour que le user puisse continuer sa recherche de carte
            if($collection[0]->game_id == 1) {

                $setsIds = $pokeModel->getAllSets();

                return $this->view('Collections_Cards.index', compact('collection'), compact('setsIds'));
            }

            if($collection[0]->game_id == 2) {

                $setsMagicNames = $magicModel->getSetsNamesCodes();

                return $this->view('Collections_Cards.index', compact('collection'), compact('setsMagicNames'));
            }

        }


        //Récupère les infos utiles de la carte (pokémon) sélectionnée par le user pour les stocker dans la Bdd
        public function createCardPoke(string $cardId)
        {
            $pokeModel = new ApiPokeModel();
            $cardModel = new CardModel();

            $add = $pokeModel->getCardById($cardId);

            $finalName = $add->getName();
            $finalSetName = $add->getSet()->getSeries();
            $finalRarity = $add->getRarity();
            $finalImg = $add->getImages()->getSmall();
            $finalNbr = $add->getNumber();
            if($add->getCardMarket() == null){
                $finalPrice = 'non définis';
            }
            else{
                $finalPrice = $add->getCardMarket()->getPrices()->getTrendPrice();
            }

            $finalId = $cardId;

            $cardFinal = [
                'cardname' => $finalName,
                'setname' => $finalSetName,
                'rarity' => $finalRarity,
                'image' => $finalImg,
                'nbrcard' => $finalNbr,
                'price' => $finalPrice,
                'card_id' => $finalId
            ];

            $cardModel->addCardsToBdd($cardFinal); //Renvoie la carte pour l'enregistrer en Bdd
        }


        //Récupère les infos utiles de la carte (magic) sélectionnée par le user pour les stocker dans la Bdd
        public function createCardMagic(string $idMagicCard)
        {
            $magicModel = new ApiMagicModel();
            $cardModel = new CardModel();

            $add = $magicModel->getCardMagicById($idMagicCard);

            $finalName = $add->name;
            $finalSetName = $add->setName;
            $finalRarity = $add->rarity;
            $finalImg = $add->imageUrl;
            $finalNbr = $add->number;
            $price = 0;
            $finalId = $idMagicCard;

            $cardFinal = [
                'cardname' => $finalName,
                'setname' => $finalSetName,
                'rarity' => $finalRarity,
                'image' => $finalImg,
                'nbrcard' => $finalNbr,
                'price' => $price,
                'card_id' => $finalId
            ];

            $cardModel->addCardsToBdd($cardFinal); //Renvoie la carte pour l'enregistrer en Bdd
        }


        //Met à jour la collection du user, fait le lien entre la/les cartes et la collection du user
        public function updateCollection(array $data, int $collectionId, int $userId)
        {
            $cardModel = new CardModel();
            $arrayOfCardsIds = [];

            foreach ($data as $cardsToLink) {

                $temp = $cardModel->findByCardId($cardsToLink)->id;

                array_push($arrayOfCardsIds, $temp);
            }

            foreach ($arrayOfCardsIds as $cardToUpdate){

                $collection = new Collections_CardsModel();
                $collection->updateCollectionCards($collectionId,$cardToUpdate,$userId);
            }
        }


        //Contrôle si la carte existe déjà en Bdd
        public function checkIfCardExistInBdd(string $cardId)
        {
            $cardModel = new CardModel();
            $cardsInDb = $cardModel->findAll();

            foreach ($cardsInDb as $cardBdd) {

                if($cardBdd->card_id === $cardId){
                    return true;
                }
            }
        }
    }
