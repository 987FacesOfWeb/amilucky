<?php

    namespace App\Models;


    //Cette classe gère toutes les requêtes liées au cartes
    class CardModel extends Model {


        protected $id;
        protected $cardname;
        protected $setname;
        protected $rarity;
        protected $image;
        protected $nbrcard;
        protected $price;
        protected $card_id;


        //Indique la table Bdd liée au modèle dans le constructeur
        public function __construct()
        {
            $this->table = 'cards';
        }


        //Ajoute une carte dans la base de donnée depuis un tableau de champs et de valeurs
        public function addCardsToBdd($datas)
        {
            $fields = [];
            $spliters = [];
            $values = [];

            //Boucle pour éclater l'array
            foreach ($datas as $field => $value) {

                if($value !== null && $field != 'db' && $field != 'table') {
                    $fields[] = $field;
                    $spliters[] = '?';
                    $values[] = $value;
                }
            }

            //Transforme array "fields" en chaîne de caractères
            $list_field = implode(', ', $fields);
            $list_splitter = implode(', ', $spliters);

            //Execute la requête
            return $this->request('INSERT INTO  '.$this->table.' ('. $list_field.') VALUES('.$list_splitter.')',$values);

        }


        //Récupère la dernière carte enregistrée dans la Bdd
        public function getLastRecord()
        {
            return $this->request("SELECT * FROM {$this->table} ORDER BY ID DESC LIMIT 1")->fetch();
        }


        //Récupère une carte dans la Bdd, selon son Id
        public function findByCardId(string $id)
        {
            return $this->request("SELECT * FROM {$this->table} WHERE card_id = ?",[$id])->fetch();
        }


        //Récupère une carte dans la Bdd, selon son url d'image
        public function findCardByImg(string $url)
        {
            return $this->request("SELECT * FROM {$this->table} WHERE image = ?",[$url])->fetch();
        }


        //Getter et Setter
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
        public function getCardname()
        {
            return $this->cardname;
        }

        /**
         * @param mixed $cardname
         */
        public function setCardname($cardname): void
        {
            $this->cardname = $cardname;
        }

        /**
         * @return mixed
         */
        public function getSetname()
        {
            return $this->setname;
        }

        /**
         * @param mixed $setname
         */
        public function setSetname($setname): void
        {
            $this->setname = $setname;
        }

        /**
         * @return mixed
         */
        public function getRarity()
        {
            return $this->rarity;
        }

        /**
         * @param mixed $rarity
         */
        public function setRarity($rarity): void
        {
            $this->rarity = $rarity;
        }

        /**
         * @return mixed
         */
        public function getImage()
        {
            return $this->image;
        }

        /**
         * @param mixed $image
         */
        public function setImage($image): void
        {
            $this->image = $image;
        }

        /**
         * @return mixed
         */
        public function getNbrcard()
        {
            return $this->nbrcard;
        }

        /**
         * @param mixed $nbrcard
         */
        public function setNbrcard($nbrcard): void
        {
            $this->nbrcard = $nbrcard;
        }

        /**
         * @return mixed
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * @param mixed $price
         */
        public function setPrice($price): void
        {
            $this->price = $price;
        }

        /**
         * @return mixed
         */
        public function getCardId()
        {
            return $this->card_id;
        }

        /**
         * @param mixed $card_id
         */
        public function setCardId($card_id): void
        {
            $this->card_id = $card_id;
        }

    }
