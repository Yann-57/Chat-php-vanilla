<?php

class HomeController extends Controller{
    
    private $repository;
    private $errorMsg;
    public function index()
    {
        if(isset($_SESSION['currentUser'])) LoginRepository::disconnect();
        $this->render(BASE_DIR . 'templates/home/index.php');
    }
    public function login(){
        
        $this->repository = new LoginRepository();
        $users = $this->repository->getUsers();

        // ON VERIFIE LE TABLEAU POST QUI SE TROUVE DANS LA METHODE request()
        
        if(isset($this->request()['user'])){
            $currentUser = $this->request()['user'];
            
            foreach($users as $key => $user){
                // ON COMPARE LES DONNEES DU TABLEAU USER ENVOYER DANS LE $_POST A TRAVERS LA METHODE MERE "request" AUX DONNEES DES USERS RECUPEREES EN BDD
                if($user->username() == $currentUser['username'] && password_verify($currentUser['password'], $user->password())){
                    // ON CONNECTE L'UTILISATEUR SI SON ID ET MDP CORRESPONDENT A UN DE NOS USERS
                    $this->repository->connectUser($user);
                }
                
            }
            $this->errorMsg = 'Mauvais identifiants';
            $this->render(BASE_DIR . 'templates/home/index.php', ['errorMsg' => $this->errorMsg]);

            } 
        }
            
    
    public function createUser(){
        $this->repository = new LoginRepository();
        if(isset($this->request()['createUser'])){
            $newUser = ($this->request()['createUser']);
            // ON VERIFIE LE FORMAT DU FICHIER D'AVATAR
            $avatar = $this->repository->checkFile($_FILES['avatar']);
            

            // ON AJOUTE LE FICHIER AUX TABLEAU POST CORRESPONDANT AU NOUVEL UTILISATEUR SI CELUI CI A REMPLIS LES CONDITIONS D'ACCEPTATION
            $newUser['avatar'] = $avatar ? $avatar['file'] : '../public/medias/upload/roger.jpeg';
            $this->repository->createUser($newUser);
        }
    }

}