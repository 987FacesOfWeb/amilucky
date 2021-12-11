<?php

    namespace App\Models;


    //Cette classe gère les requêtes liées aux collections
    class CollectionsModel extends Model {

        protected $id;
        protected $name;
        protected $user_id;


        //Indique la table Bdd liée au modèle dans le constructeur
        public function __construct()
        {
            $this->table = 'collections';
        }


        //Récupère les cartes liées à la collection, selon son nom dans la Bdd
        public function findCardsByCollection(string $name)
        {
            return $this->request("SELECT * FROM cards JOIN collections_cards ON cards.id = collections_cards.card_id JOIN collections ON collections_cards.collection_id = collections.id WHERE collections.name = ?", [$name])->fetchAll();
        }


        //Récupère l'id "Collection_cards" selon l'id de la carte, de la collection et du user dans la Bdd
        public function findIdCollections_cards(int $card_id, $collection_id, $user_id)
        {
            return $this->request("SELECT collections_cards.id FROM cards JOIN collections_cards ON cards.id = collections_cards.card_id JOIN collections ON collections_cards.collection_id = collections.id WHERE collections.id = {$collection_id} && collections_cards.user_id = {$user_id} && collections_cards.card_id = {$card_id}")->fetch();
        }


        //Met à jour le nom de la collection dans la Bdd
        public function updateNameCollection(int $collection_id, string $newName)
        {
           return $this->request("UPDATE {$this->table} SET name = ? WHERE id = ?",[$newName, $collection_id]);
        }


        //Créé la nouvelle colleciton dans la Bdd
        public function createNewCollection(string $collection_name, int $user_id, int $game_id)
        {
            return $this->request("INSERT INTO {$this->table} (name, user_id, game_id) VALUES ('{$collection_name}', $user_id, $game_id)");
        }


        //Récupère le dernier enregistrement de la table dans la Bdd
        public function getLastRecordCollection()
        {
            return $this->request("SELECT * FROM {$this->table} ORDER BY ID DESC LIMIT 1")->fetch();
        }


        //Récupère la collection dans la Bdd, selon son nom
        public function getByName(string $name)
        {
            return $this->request("SELECT * FROM {$this->table} WHERE name = ?", [$name])->fetchAll();
        }


        //Getter et setter

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id): void
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name): void
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getUserId()
        {
            return $this->user_id;
        }

        /**
         * @param mixed $user_id
         */
        public function setUserId($user_id): void
        {
            $this->user_id = $user_id;
        }

    }
