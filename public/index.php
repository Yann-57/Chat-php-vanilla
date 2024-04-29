<?php
define('BASE_DIR','../');
include BASE_DIR.'app/Autoloader.php';
Autoloader::register();

 
// ON RECUPERE LA VARIABLE REQUEST_URI DE LA SUPERGLOABLE $_SERVER CETTE VARIABLE CONTIENT LE CONTENU DE L'URL QUI SE TROUVE APRES LE VIRTUAL HOST
$router = new Router($_SERVER['REQUEST_URI']);
$router->execute();



