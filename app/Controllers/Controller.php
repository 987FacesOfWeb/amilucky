<?php

    namespace App\Controllers;


    //Controller maître depuis lequel les autres modèles vont être étendus
    abstract class Controller {


        //Constructeur du modèle pour démarrer la session
        public function __construct()
        {
            if(session_status() === PHP_SESSION_NONE) {

                session_start();
            }
        }

        //Fonction permettant de créer le chemin pour les vues et d'injecter le contenu de la page dans la page de layout
        protected function view($path, array $params = null, array $otherParams = null)
        {
            ob_start();

            $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
            require VIEWS . $path . '.php';

            $content = ob_get_clean();
            require VIEWS . 'layout.php';
        }

    }
