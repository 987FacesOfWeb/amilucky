<?php

    namespace Router;


    //Cette classe gère les routes
    class Route {


        public $path;
        public $action;
        public $matches;


        //Nettoie le path
        public function __construct($path, $action)
        {
            $this->path = trim($path, '/');
            $this->action = $action;
        }


        //Recherche une correspondance dans le path
        public function matches($url) :bool
        {
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
            $pathToMatch = "#^$path$#";

            if(preg_match($pathToMatch, $url, $matches)) {

                $this->matches = $matches;

                return true;
            }else {

                return false;
            }
        }


        //Execute le path, selon le controller et la méthode, avec ou sans paramètres
        public function execute()
        {
            $params = explode('@', $this->action);
            $controller = new $params[0];
            $method = $params[1];

            return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
        }
    }
