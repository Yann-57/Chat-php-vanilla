<?php


abstract class Repository{
    private static $bdd;
    private static $dbname = 'chatSimple';
    private static $username = 'yann';
    private static $password = '';

    // INSTANCIE LA CONNEXION A LA BDD
    private static function setBdd(){
        self::$bdd = new PDO('mysql:host=localhost;dbname='. self::$dbname . ';charset=utf8',self::$username, self::$password);
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // RECUPERE LA CONNEXION A LA BDD
    protected function getBdd(){
        if(self::$bdd == null) self::setBdd();
        return self::$bdd;

    }

    // FUNCTION PERMETTANT DE RECUPERER TOUTES LES DONNEES DE NIMPORTE QUELLE TABLE ET DE LES RECUPERER SOUS FORMES D'OBJETS
    protected function getAll($table, $objet){
        $var = [];
        $req = $this->getBdd()->query('SELECT * FROM ' .$table .' ORDER BY id desc');
        

        $array = $req->fetchAll(PDO::FETCH_ASSOC);
        // CHAQUE ENTREE DU TABLEAU FETCHALL EST TRANSFORME EN OBJET ET AJOUTE DANS UNE VARIABLE var
        foreach($array as $_ => $data){
            $var[] = new $objet($data);
        }
        return $var;
    }

    // FUNCTION PERMETTANT DE RECUPERER DES DONNEES D'UNE TABLE SELON UN ID DEFINIS 
    protected function getById($id, $table, $objet){
        $req = $this->getBdd()->prepare('SELECT * FROM ' .$table .' WHERE id = :id');
        $req->execute(['id' => $id]);
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $var = new $objet($data);
        return $var;
    } 
}