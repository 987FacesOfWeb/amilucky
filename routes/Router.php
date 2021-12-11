<?php

    namespace Router;


    //Cette classe gère le routeur
    class Router {

        public $url;
        public $routes = [];


        //Nettoie l'url
        public function __construct($url)
        {
            $this->url = trim($url, '/');
        }


        //Gère les routes en action Get
        public function get($path, $action)
        {
            $this->routes['GET'][] = new Route($path, $action);
        }


        //Gère les actions en Post
        public function post($path, $action)
        {
            $this->routes['POST'][] = new Route($path, $action);
        }


        //Lance l'app si la route existe, sinon, renvoie à l'accueil
        public function run()
        {
            session_start();
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if($route->matches($this->url)) {
                    return $route->execute();
                }
            }
            return header('Location: /', 404);
        }
    }