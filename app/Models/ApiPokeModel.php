<?php

    namespace App\Models;

    use Pokemon\Pokemon;
    Pokemon::Options(['verify' => true]);
    Pokemon::ApiKey('a443f213-cce8-48d6-8b47-2663cfbf772d'); //Clé Api


    //Cette classe gère les requêtes vers l'api Pokémon
    class ApiPokeModel extends Model {


        //Récupère tous les nom de sets Pokémon
        public function getAllSets()
        {
            $arrayOfSetsIds = [];
            $allSets = Pokemon::Set()->all();

            foreach ($allSets as $ids) {

                array_push($arrayOfSetsIds, $ids->getId());
            }

            return $arrayOfSetsIds;
        }


        //Récupère toutes les cartes Pokémon liées à un set
        public function getCardsFromSetId(string $setId)
        {
            $arrayOfCardsNames=[];
            $allFromSet = Pokemon::Card()->where(['set.id'=>$setId])->all();

            foreach ($allFromSet as $names) {

                array_push($arrayOfCardsNames, $names);
            }

            return $arrayOfCardsNames;
        }


        //Récupère les cartes Pokémon contenant le mot entré dans l'input user
        public function getCardByName(string $name)
        {
            $cards = Pokemon::Card()->where(['name' => $name.'*'])->all();
            return $cards;
        }


        //Récupère une carte Pokémon selon son Id
        public function getCardById(string $id)
        {
            $card = Pokemon::Card()->find($id);
            return $card;
        }

    }
