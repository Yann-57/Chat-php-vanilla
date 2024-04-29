<?php
class ChatRepository extends Repository
{

    public function rooms()
    {
        return $this->getAll('room', 'Room');
    }

    public function roomById(int $id){
        $room = $this->getById($id, 'room', 'Room');
        return $room;
    }

    public function messagesByIdRoom(int $id){
        $req = $this->getBdd()->prepare('SELECT message.id, username, avatar, content, date_posted FROM message JOIN users ON message.id_user = users.id WHERE id_room = :id ORDER BY message.id ASC');
        $req->execute(['id' => $id]);
        $var = [];
        $array = $req->fetchAll(PDO::FETCH_ASSOC);
        // RECUPERATION DES DONNEES SOUS FORME DE TABLEAU D'OBJETS
        foreach($array as $_ => $data){
            $var[] = new Message($data);
        }
        return $var;

    }

    public function sendMessage(array $array){
        $array['content'] = htmlentities($array['content']);
        $req = $this->getBdd()->prepare('INSERT INTO message (content, date_posted, id_user, id_room) VALUES (:content, NOW(), :id_user, :id_room)');
        $req->execute($array);
        return $req;
    }

    public function createRoom($name){
        $req = $this->getBdd()->prepare('INSERT INTO room (name) VALUES (:name);');
        $req->execute(['name' => $name]);
        return $this->getBdd()->lastInsertId();
    }
}