<?php
    namespace App\Models;


    use mtgsdk\Card;
    use mtgsdk\Set;

    //Cette classe gère les requêtes vers l'api Magic
    class ApiMagicModel {


        //Récupère tous les codes des sets de carte Magic (nom d'extension)
        public function getSetsNamesCodes()
        {
            $allsets = Set::all();
            $arrayOfNamesSets = [];

            foreach ($allsets as $setCode) {

                array_push($arrayOfNamesSets, $setCode->code);
            }

            return $arrayOfNamesSets;
        }


        //Récupère un code de set Magic selon son nom
        public function getCodeSetMagic(string $setname)
        {
            $setToFind = Set::where(['name' => $setname])->all();
            $codeOfSet = $setToFind[0]->code;

            return $codeOfSet;
        }


        //Récupère les cartes Magic liées au set selon son code
        public function getCardsFromSetCodeMagic($code)
        {
            $allCardsFromSet = Card::where(['set' => $code])->all();

            return $allCardsFromSet;
        }


        //Récupère toutes les cartes Magic contenant le mot entré dans la barre de recherche
        public function getCardMagicFromName(string $name)
        {
            $cardsFromName = Card::where(['name' => $name])->all();

            return $cardsFromName;
        }


        //Récupère une carte Magic selon son id
        public function getCardMagicById(string $id)
        {
           $card = Card::find($id);

           return $card;
        }

    }
