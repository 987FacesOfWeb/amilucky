<?php

    namespace App\Models;


    //Cette classe gère les requêtes liées aux utilisateurs
    class UsersModel extends Model {


        protected $id;
        protected $username;
        protected $email;
        protected $password;
        protected $fname;


        //Indique la table Bdd liée au modèle dans le constructeur
        public function __construct()
        {
            $this->table = 'users';
        }


        //Crée la session user
        public function setSession() {

            $_SESSION['auth'] = [
                'id' =>  $this->id,
                'username' => $this->username
            ];
        }


        //Récupère le dernier enregistrement de la table dans la Bdd
        public function getLastRecordUser()
        {
            return $this->request("SELECT * FROM {$this->table} ORDER BY ID DESC LIMIT 1")->fetch();
        }


        //Récupère un user selon son username
        public function findOneByUsername(string $username)
        {
            return $this->request("SELECT * FROM {$this->table} WHERE username = ?", [$username])->fetch();
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
        public function getFname()
        {
            return $this->fname;
        }

        /**
         * @param mixed $fname
         */
        public function setFname($fname): void
        {
            $this->fname = $fname;
        }

        /**
         * @return mixed
         */
        public function getLname()
        {
            return $this->lname;
        }

        /**
         * @param mixed $lname
         */
        public function setLname($lname): void
        {
            $this->lname = $lname;
        }
        protected  $lname;

        /**
         * @return mixed
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * @param mixed $username
         */
        public function setUsername($username): void
        {
            $this->username = $username;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email): void
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password): void
        {
            $this->password = $password;
        }

    }
