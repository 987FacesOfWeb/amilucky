<?php

    use Router\Router;
    require "../vendor/autoload.php";

    define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
    define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

    $router = new Router($_SERVER['REQUEST_URI']);

    //Route en GET

    $router->get('/', 'App\Controllers\UsersController@home');
    $router->get('/home', 'App\Controllers\UsersController@home');
    $router->get('/login', 'App\Controllers\UsersController@login');
    $router->get('/logout', 'App\Controllers\UsersController@logout');
    $router->get('/register', 'App\Controllers\UsersController@register');
    $router->get('/cards', 'App\Controllers\CardsController@index');
    $router->get('/collections', 'App\Controllers\CollectionsController@index');
    $router->get('/collections/:id', 'App\Controllers\CollectionsController@manage');
    $router->get('/newCollection', 'App\Controllers\CollectionsController@addNewCollection');
    $router->get('/modify/:id','App\Controllers\CollectionsController@modify');
    $router->get('/delete/:id', 'App\Controllers\CollectionsController@deleteCollection');
    $router->get('/addCard/:collection_id', 'App\Controllers\Collections_CardsController@index');

    //Routes en POST

    $router->post('/login', 'App\Controllers\UsersController@loginPost');
    $router->post('/registered', 'App\Controllers\UsersController@registerPost');
    $router->post('/showCard/:name', 'App\Controllers\CollectionsController@showCard');
    $router->post('/deleteSuccess','App\Controllers\CollectionsController@deleteCollectionPost' );
    $router->post('/addSuccess', 'App\Controllers\CollectionsController@addNewCollectionPost');
    $router->post('/modify/:id', 'App\Controllers\CollectionsController@deleteCard');
    $router->post('/collections/:id', 'App\Controllers\CollectionsController@updateCollectionName');
    $router->post('/addCard/addtocollection', 'App\Controllers\Collections_CardsController@addCardsBdd');
    $router->post('/addCard/searchCard', 'App\Controllers\Collections_CardsController@searchCard');


    //Lance l'app

    $router->run();


