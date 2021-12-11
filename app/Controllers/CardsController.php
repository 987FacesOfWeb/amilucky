<?php

    namespace App\Controllers;

    use App\Models\CardModel;


    //Cette classe gère l'affichage des dernières cartes ajoutées par les users
    class CardsController extends Controller{


        //Cherche toutes les cartes enregistrées dans la Bdd et les retourne à la vue
        public function index()
        {
            $card = new CardModel();
            $cards = $card->findAll();

            return $this->view('cards.index', compact('cards'));
        }

    }