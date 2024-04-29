<?php 
class Message implements \JsonSerializable{
    
    private $id;
    private $username;
    private $avatar;
    private $content;
    private $date_posted;


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
        $this->id = $id;
    }

     public function setUsername($username){
      
        $this->username = $username;
    }
    public function setAvatar($avatar){ 
       $this->avatar = $avatar;
    }
    public function setContent($content){
        if(is_string($content)) $this->content = $content;
    }
    
    public function setDate_posted($date_posted){
        $this->date_posted = $date_posted;
    }
    
    // GETTERS
    public function getId(){
        return $this->id;
    }

    public function username(){
        return $this->username;
    }
    
    public function avatar(){
        return $this->avatar;
    }

    public function content(){
        return $this->content;
    }

    public function date_posted(){
        return $this->date_posted;
    }

    public function getUsername(){
        return $this->username;
    }


    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}