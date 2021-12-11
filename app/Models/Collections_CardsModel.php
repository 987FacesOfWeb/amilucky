<?php

    namespace App\Models;


    //Cette classe gère les requêtes liées à la table "collections_cards"
    class Collections_CardsModel extends Model {


        protected $id;
        protected $collection_id;
        protected $card_id;
        protected $user_id;


        //Indique la table Bdd liée au modèle dans le constructeur
        public function __construct()
        {
            $this->table = "collections_cards";
        }


        //Supprime la carte de la collection, selon son id
        public function deleteCardFromCollection(int $id_collection)
        {
            return $this->request("DELETE  FROM {$this->table} WHERE id = ?",[$id_collection]);
        }


        //Met à jour la collection de carte dans la Bdd, selon l'id de collection, de la carte et du user
        public function updateCollectionCards(int $collection_id, string $card_id, int $user_id)
        {
            return $this->request("INSERT INTO {$this->table} (collection_id, card_id, user_id) VALUES ($collection_id, $card_id, $user_id)");
        }


        //Supprime une collection de la base de donnée, selon son id
        public function deleteCollectionCards(int $collection_id)
        {
            return $this->request("DELETE FROM {$this->table} WHERE collection_id = ?",[$collection_id]);
        }
    }
