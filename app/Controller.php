<?php

abstract class Controller
{
    private $request;

    public function __construct()
    {
        // DES LORS QUE L'ON INSTANCIER UN OBJET CONTROLLER LES SUPER GLOABLES $_POST ET $_GET  SONT REUNIES DANS UN TABLEAU
        $this->request = array_merge($_GET, $_POST);
    }

    public abstract function index();

    public function request()
    {
        return $this->request;
    }

    // FONCTION PERMETTANT D'APPELER UNE VUE 
    public function render(string $filename, array $data = [])
    {
        $vue = new View($filename);
        $vue->render($data);
    }
}