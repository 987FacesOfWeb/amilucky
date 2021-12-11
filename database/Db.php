<?php

    namespace Database;

    use PDO;
    use PDOException;


    //Cette classe gère la connexion à la base de données
    class Db extends PDO{

        //Infos de connexion
        private static $instance;
        private const DBHOST = 'localhost';
        private const DBUSER = 'root';
        private const DBPASS = '';
        private const DBNAME = 'amilucky';


        //Construction de la connexion
        public function __construct() {

            //DSN de connexion
            $_dsn = 'mysql:dbname=' .self::DBNAME . ';host' . self::DBHOST;

            //Appel du constructeur de la classe PDO
            try {
                parent::__construct($_dsn, self::DBUSER, self::DBPASS);

                $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch (PDOException $e) {

                die($e->getMessage());
            }
        }

        //Instance de connexion
        public static function getInstance():self {

            if(self::$instance === null) {

                self::$instance = new self();
            }
            return self::$instance;
        }
    }
