<?php

require_once 'Loader.php';

function __autoload($class) 
{
    if(file_exists(ROOT . DS . 'app' . DS . 'Controller' . DS . $class . '.php')){
        include ROOT . DS . 'app' . DS . 'Controller' . DS . $class . '.php';
    } else {
        
    }
}

$loader = new Loader($_GET);
