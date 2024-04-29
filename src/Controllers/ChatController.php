<?php 
class ChatController extends Controller{
    private $repository;

    public function index()
    {
        // VERIFIE SI UN UTILISATEUR EST BIEN CONNECTE
        if(LoginRepository::isLoggedIn()){

            $this->repository = new ChatRepository();

            // PERMET DE RECUPERER TOUT LES SALONS SOUS FORME DE TABLEAU D'OBJETS
            $rooms = $this->repository->rooms();

            // ON AFFICHE LA VUE SOUHAITEE QUI AFFICHE TOUT NOS SALONS
            $this->render(BASE_DIR .'templates/chat/dashboard.php', ['rooms' => $rooms]);
        }else 
            header('Location: /home');
    }

    public function room(int $idRoom){
        if(LoginRepository::isLoggedIn()){

            $this->repository = new ChatRepository();

            $this->request()['id_room'] = $idRoom;

            $rooms = $this->repository->rooms();
            $currentRoom = $this->repository->roomById($idRoom);
            $messages = $this->repository->messagesByIdRoom($idRoom);

            $this->render(BASE_DIR .'templates/chat/room.php', ['currentRoom' => $currentRoom, 'rooms' => $rooms, 'messages' => $messages]);
            }

        else
         header('Location: /home');
      
    }

    public function send(int $id_room){
        $this->repository = new ChatRepository();
        if(isset($this->request()['send']) && (!empty($this->request()['send']['content']))){

            $message = $this->request()['send'];
            $message['id_user'] = $_SESSION['currentUser']->id();
            $message['id_room'] = $id_room;
            
            $this->repository->sendMessage($message);   
            }   
            $messages = $this->repository->messagesByIdRoom($id_room);
            echo json_encode($messages);
    }

    public function newRoom(){
        if(isset($this->request()['roomName'])){
            $this->repository = new ChatRepository();
            $roomName = $this->request()['roomName'];
            $newRoomId = $this->repository->createRoom($roomName);
            header('Location: /chat/room/'.$newRoomId);
    }}
}