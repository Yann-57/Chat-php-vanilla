<?php
class Autoloader {

    static function loading($className)
    {

        // CES CONDITIONS FONT REFERENCES A TOUT NOS REPERTOIRES SUSCEPTIBLES D'ACCEUILLIR DES CLASSES
        if(file_exists(BASE_DIR . 'app/'.$className.'.php'))
            require BASE_DIR . 'app/'.$className.'.php';

        if(file_exists(BASE_DIR . 'src/Controllers/'.$className.'.php'))
            require BASE_DIR . 'src/Controllers/'.$className.'.php';

        if(file_exists(BASE_DIR . 'src/Repositories/'.$className.'.php'))
            require BASE_DIR . 'src/Repositories/'.$className.'.php';
    }


    // PERMET D'APPELER LA FONCTION LOADING CI DESSUS DES LORS QUE L'ON FAIT APPEL A UNE CLASSE QUE CE SOIT POUR INSTANCIER UN OBJET OU FAIRE APPEL A SES METHODES STATIQUES
    static function register()
    {
        spl_autoload_register(array(__CLASS__,'loading'));    
    }

}
