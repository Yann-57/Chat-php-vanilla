<?php

class View
{
    private $file;
    private $title;

    public function __construct(string $file)
    {
        $this->file = $file;
    
    }

    public function render($data)
    {
        // VARIABLE CONTENANT LA PARTIE DE LA VUE SPECIFIQUE SOUHAITEE AINSI QUE L'EXTRACTION DES DONNEES VOULU SOUS FORME DE VARIABLES
        $body = $this->renderFile($this->file, $data);

        // VARIABLE CONTENANT LA MEMOIRE TAMPON DU TEMPLATE DE BASE DE NOTRE APPLICATION AINSI QUE L'EXTRACTION DES DONNEES RELATIVES AUX TITRE ET AU BODY
        $view = $this->renderFile('../templates/template.php', array('title' => $this->title, 'body' => $body));

        // ON APPELLE LA VUE ENTIERE
        echo $view;
    }

    public function renderFile($file, $data){
        if(file_exists($file)){
            extract($data);   
            ob_start();

            // ON INCLUT LE FICHIER VUE SOUHAITE ET ON RETOURNE TOUT CE QUI A ETE STOCKER EN MEMOIRE TAMPON
            require $file;
            return ob_get_clean();
            }
    }

}