<?php


// Definir uma URL BASE
define('BASE_URL','http://localhost/sistema-LivrariaBooksAndFun/public/');


// Configuração da Data Base

define('DB_HOST', 'smpsistema.com.br');
define('DB_NAME', 'u283879542_booksandfun');
define('DB_USER', 'u283879542_booksandfun');
define('DB_PASS', '@Booksandfun01');


// Configuração do Email
define('EMAIL_HOST','smtp.hostinger.com');
define('EMAIL_PORT','465');
define('EMAIL_USER','ti26@smpsistema.com.br');
define('EMAIL_PASS','Senac@ti26');


// Sistema de autoload das class
spl_autoload_register(function ($class){
    
    if(file_exists('../app/controllers/' .$class. '.php')){
         require_once('../app/controllers/'.$class.'.php');
    }

    if(file_exists('../app/models/' .$class.'.php')){
        // var_dump($class);
        require_once('../app/models/'.$class.'.php');
    }

    if(file_exists('../rotas/'.$class.'.php')){
        require_once('../rotas/'.$class.'.php');
        //var_dump($class);
    }

});