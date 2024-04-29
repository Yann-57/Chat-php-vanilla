<?php 
class Router
{
    public CONST DEFAUT_CONTROLLER = 'home';
    public CONST DEFAUT_CONTROLLER_ACTION = 'index';

    private $controller;
    private $action;
    private $param;

    public function __construct(string $request_uri)
    {
        // PERMET D'INTERPRETER LES DONNEES DE L'URL INDEPENDAMMENT 
        $request_uri = explode('/', trim($request_uri, '/'));

        // CHAQUE DONNEE SELON SON ORDRE EST ASSOCIEE A UN TYPE PRECIS D'EVENEMENT
        $this->controller = !empty($request_uri[0]) ? $request_uri[0] : self::DEFAUT_CONTROLLER;

        $this->action = $request_uri[1] ?? SELF::DEFAUT_CONTROLLER_ACTION;
        
        $this->param = $request_uri[2] ?? null;
        session_start();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParam()
    {
        return $this->param;
    }
    public function execute()
    {
   
    // ON RECUPERE LE CONTROLLEUR DANS L'URL
    try{ 
    $controllerName = ucfirst($this->getController());
    $controllerName .= 'Controller';

    // ON INSTANCIE LE CONTROLLEUR
    if(class_exists($controllerName))
    {
        $controller = new $controllerName();
    }   
    else
    {   
        throw new Exception("Le fichier $controllerName n'existe pas", 404);
    }

    // ON IDENTIFIE L'ACTION (2EME PARAMETRE DE L'URL)
    $action = $this->getAction();


    // ON EXECUTE L'ACTION
    if(method_exists($controller, $action)){
        
        // LE PARAMETRE EST ENVOYER EN ARGUMENT POUR L'ACTION A REALISER
        $controller->$action($this->getParam());
    }else{
        throw new Exception("L'action $action du controller $controllerName n'existe pas", 404);
    }

// SYSTEME DE GESTION DES ERREURS VIA LE CONTROLLEUR "ERRORCONTROLLER"
}catch(Exception $e){
            $this->controller = 'error';
            $this->action = 'show';
            $this->param = $e;
            $this->execute();
        }
    }
}