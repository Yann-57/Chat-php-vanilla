<?php 
class User{
    private $id;
    private $username;
    private $password;
    private $email;
    private $avatar;


    // CONSTRUCTEUR
    public function __construct(array $data){
        $this->hydrate($data);
    }

    // HYDRATATION
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

     // SETTERS
     public function setId($id){
        $id = (int) $id;

        if($id > 0) $this->id = $id;
    }
    public function setUsername($username){
        if(is_string($username)) $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }

    public function setAvatar($avatar){
        $this->avatar = $avatar; 
    }
    
    // GETTERS
    public function id(){
        return $this->id;
    }

    public function username(){
        return $this->username;
    }

    public function password(){
        return $this->password;
    }

    public function email(){
        return $this->email;
    }

    public function avatar(){
        return $this->avatar;
    }
}
