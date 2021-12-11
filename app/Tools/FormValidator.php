<?php

    namespace App\Tools;


    //Cette classe gère les inputs user
    class FormValidator {


        private $data;
        private $errors;


        //Donne les inputs au constructeur
        public function __construct(array $data)
        {
            $this->data = $data;
        }


        //Boucle sur les données selon les rules afin d'appeler la fonction liée à la rule
        public function validateLogin(array $rules): ?array
        {

            foreach ($rules as $name => $rulesArray) {

                if(array_key_exists($name, $this->data)) {

                    foreach ($rulesArray as $rule) {

                        switch ($rule) {
                            case 'required':
                                $this->required($name, $this->data[$name]);
                                break;

                            case substr($rule, 0, 3) === 'min':
                                $this->min($name, $this->data[$name], $rule);
                                break;
                        }

                    }

                }

            }
            return $this->getErrors();
        }


        //Gère les erreurs liées aux champs non remplis
        private function required(string $name, string  $value)
        {
            $value = trim($value);

            if(!isset($value) || is_null($value) || empty($value)) {
                $this->errors[$name][] = "{$name} est requis";
            }
        }


        //Gère les erreurs liées aux champs dont les caractère minimum ne sont pas remplis
        private function min(string $name, string $value, string $rule)
        {
            preg_match_all('/(\d+)/', $rule, $matches);

            $limit = (int) $matches[0][0];

            if(strlen($value) < $limit) {
                $this->errors[$name][] = "{$name} doit comprendre un minimum de {$limit} caractères";
            }
        }


        //Retourne les erreurs
        private function getErrors(): ?array
        {
            return $this->errors;
        }


    }
