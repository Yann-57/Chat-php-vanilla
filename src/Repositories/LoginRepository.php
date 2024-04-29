<?php 
class LoginRepository extends Repository{
    public function getUsers(){
        return $this->getAll('users', 'User');
    }

    public function createUser(array $newUser){

        $newUser['username'] = htmlentities($newUser['username']);
        $newUser['password'] = password_hash($newUser['password'], PASSWORD_DEFAULT);
        $newUser['email'] = htmlentities($newUser['email']);


        $req = $this->getBdd()->prepare('INSERT INTO users (username, password, email, avatar)
        VALUES (:username, :password, :email, :avatar)');
        $req->execute($newUser);

        $id = $this->getBdd()->lastInsertId(); 
        $currentUser = $this->getById($id, 'users', 'User');
        $this->connectUser($currentUser);
    }

    public function checkFile(array $file){
        
        // VERIFIE SI LE FICHIER A BIEN ETE AJOUTE SANS ERREUR
        if(isset($file) && $file["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $file["name"];
            $filetype = $file["type"];
            $filesize = $file["size"];

            // VERIFIE L'EXTENSION DU FICHIER ET SI ELLE SE TROUVE PARMIS NOS EXTENSIONS AUTORISEES
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) return;
            // "Erreur : Veuillez sélectionner un format de fichier valide."

            // VERIFIE LA TAILLE DU FICHIER
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) return;
            // "Error: La taille du fichier est supérieure à la limite autorisée."

            // VERIFIE LE TYPE DU FICHIER ET SI IL SE TROUVE PARMIS NOS TYPES AUTORISES
            if(in_array($filetype, $allowed)){
                // VERIFIE SI LE FICHIER EXISTE DANS NOTRE REPERTOIRE 'upload' AVANT DE LE TELECHARGER
                if(file_exists("/medias/upload/" . $file["name"])){
                        $unique = uniqid('', true);
                        return ['file' => "/medias/upload/" . $unique .'.' . $ext];
                    
                } else{
                    move_uploaded_file($file["tmp_name"], "medias/upload/" . $file["name"]);
                    echo "Votre fichier a été téléchargé avec succès.";
                    return ['file' => "/medias/upload/" . $file["name"]];
                } 
            } else{
                return;
                // "Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else{
            return;
            // "Error: " . $file['error']
        }
    }


    public function connectUser(object $user){
        $_SESSION['currentUser'] = $user;
        header('Location: /chat');
        exit;
    }
    
    static function disconnect(){
        unset($_SESSION['currentUser']);
        session_destroy();
        header('Location: /home'); exit;
    }

    static function isLoggedIn(){
        if(isset($_SESSION['currentUser'])) return true;
    }




}
?>