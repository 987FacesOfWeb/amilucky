<?php

    namespace App\Controllers;

    use App\Models\UsersModel;
    use App\Tools\FormValidator;


    //Cette classe gère les actions liées aux utilisateurs
    class UsersController extends Controller {


        //Envoie à la vue "Accueil"
        public function home()
        {
            $this->view('users.home');
        }


        //Envoie à la vue "login"
        public function login()
        {
            $this->view('users.login');
        }


        //Contrôle si l'utilisateur existe dans la Bdd, envoie les erreurs si les accès
        // ne sont pas bons, envoie sur l'accueil personnalisé si l'utilisateur existe
        public function loginPost()
        {
            $validator = new FormValidator($_POST);
            $errors = $validator->validateLogin([ //Envoie les inputs vers fonction de contrôle
                'username' => ['required'],
                'password' => ['required']
            ]);


            if($errors) {

                $_SESSION['errors'][] = $errors;
                header('Location: /login');
                exit();
            }

            $userModel = new UsersModel();
            $userArray = $userModel->findOneByUsername(strip_tags($_POST['username']));

            $user = $userModel->hydrate($userArray);

            if(password_verify($_POST['password'], $user->getPassword())) {

                $user->setSession();                //Demarre la session du user
                header('Location: /home');

            }else {

                $errors = [
                    'messageError' => ['Votre mot de passe et/ou votre username est incorrect']
                ];
                $_SESSION['errors'][] = $errors;

                header('Location: /login');
            }
        }


        //Kill la session du user
        public function logout()
        {
            session_destroy();
            header('Location: /home');
        }


        //Envoie vers la vue "s'inscrire"
        public function register()
        {
            $this->view('users.register');
        }


        //Contrôle si les champs sont bien remplis, gère les erreurs, contrôle si
        //le user existe déjà dans la Bdd, puis enregistre le nouvel utilisateur
        public function registerPost()
        {
            $validator = new FormValidator($_POST);
            $errors = $validator->validateLogin([  //Envoie les inputs vers fonction de contrôle
                'Nom' => ['required'],
                'Prénom' => ['required'],
                'Pseudo' => ['required'],
                'Email' => ['required'],
                'Password' => ['required'],
                'PasswordRepeat' => ['required']
            ]);


            if($errors) {

                $_SESSION['errors'][] = $errors;
                header('Location: /register');

                exit();
            }

            //Contrôle si les deux password entrés correspondent
            if($_POST['Password'] != $_POST['PasswordRepeat']) {

                $_SESSION['errorRepeat'][] = 'Les mots de passe ne correspondent pas';
                header('Location: /register');
                exit();
            }

                $user = new UsersModel();
                $allUsers = $user->findAll();

                $fname = strip_tags($_POST['Nom']);
                $lname = strip_tags($_POST['Prénom']);
                $username = strip_tags($_POST['Pseudo']);
                $email = strip_tags($_POST['Email']);
                $pwd = password_hash($_POST['Password'], PASSWORD_DEFAULT);


                //Si la page est rechargée, ne doit pas créer deux fois le user
                foreach ($allUsers as $singleUser) {
                    if($singleUser->email == $email || $singleUser->username == $username){
                        $_SESSION['errorsRegister'][] = 'Le pseudo ou l\'adresse email existe déjà';
                    }
                }

                //Créé le user dans la bdd
                if(empty($_SESSION['errorsRegister'])) {

                    $user->setFname($fname);
                    $user->setLname($lname);
                    $user->setEmail($email);
                    $user->setPassword($pwd);
                    $user->setUsername($username);
                    $user->create($user);

                    $this->view('users.registerPost');
                }

                if(!empty($_SESSION['errorsRegister'])) {

                    $this->view('users.register');
                }
        }
    }