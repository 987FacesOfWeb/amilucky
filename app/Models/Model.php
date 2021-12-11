<?php

    namespace App\Models;

    use Database\Db;


    //Model maître depuis lequel les autres modèles vont être étendus
    abstract class Model extends Db{


        private $db;
        protected $table;


        //Trouve toutes les données de la table
        public function findAll() {
            $request = $this->request('SELECT * FROM ' . $this->table);
            return $request->fetchAll();
        }


        //Trouve les données dans la table selon critères dans la Bdd
        public function findBy(array $params) {

            $fields = [];
            $values = [];

            foreach ($params as $field => $value) {

                $fields[] = "$field = ?";
                $values[] = $value;

            }

            $list_field = implode(' AND ', $fields);

            return $this->request('SELECT * FROM '. $this->table. ' WHERE '. $list_field, $values)->fetchAll();
        }


        //Créer un élément à partir dans la Bdd
        public function create() {

            $fields = [];
            $spliters = [];
            $values = [];

            //Boucle pour éclater l'array
            foreach ($this as $field => $value) {

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


        //Met à jour les information dans la Bdd
        public function update() {

            $fields = [];
            $values = [];

            //Boucle pour éclater l'array
            foreach ($this as $field => $value) {

                if($value !== null && $field != 'db' && $field != 'table') {
                    $fields[] = "$field = ?";
                    $values[] = $value;
                }
            }

            $values[] = $this->id;
            //Transforme array "fields" en chaîne de caractères
            $list_field = implode(', ', $fields);

            //Execute la requête
            return $this->request('UPDATE '.$this->table.' SET '. $list_field. ' WHERE id = ?', $values);
        }


        //Supprime un élément dans la Bdd
        public function delete(int $id) {

            return $this->request('DELETE FROM '.$this->table.' WHERE id = ?', [$id]);

        }


        //Hydrate les données
        public function hydrate($data): self {

            foreach ($data as $key => $val) {

                //Récupère le nom du Setter correspondant à la clé ($key)
                $setter = 'set'.ucfirst($key);

                //Vérifie si le setter existe
                if(method_exists($this, $setter)) {

                    //Appel le setter
                    $this->$setter($val);
                }
            }
            return $this;
        }


        //Effectue une requête préparée si il y a des paramètres, sinon effectue une requête simple
        public function request(string $sql, array $params = null) {

            $this->db = Db::getInstance();

            if($params !== null) {

                $request = $this->db->prepare($sql);
                $request->execute($params);
                return $request;

            }else {

                return $this->db->query($sql);
            }
        }
    }
