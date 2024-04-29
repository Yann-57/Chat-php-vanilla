<?php 
class Room{
    private $id;
    private $name;
  
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
    public function setName($name){
        if(is_string($name)) $this->name = $name;
    }
    
    // GETTERS
    public function id(){
        return $this->id;
    }

    public function name(){
        return $this->name;
    }    
}