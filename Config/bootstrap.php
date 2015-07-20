<?php

require 'App.php';
require_once 'Loader.php';

App::run();

spl_autoload_extensions('.php, .class.php, .lib.php');

function loadController($class)
{
    if (file_exists(
        ROOT . DS . 'app' 
        . DS . 'Controllers' . DS . $class . '.php'
    )
    ) {
        $classFile = ROOT . DS . 'app' 
                . DS . 'Controllers' 
                . DS . $class . '.php';
        
        return include $classFile;
    }
}

function loadConfig($class)
{
    if (file_exists(
        ROOT . DS . 'Config' . DS . $class . '.php'
    )
    ) {
        $classFile = ROOT . DS . 'Config' . DS . $class . '.php';        
        return include $classFile;
    }
}


function loadModel($class)
{
    $className = ucwords($class). '.php';
    
    if (file_exists(
        ROOT . DS . 'app' 
        . DS . 'Models' . DS . $className
    )
    ) {
        $classFile = ROOT . DS . 'app' 
                . DS . 'Models' 
                . DS . $className;
        
        return include $classFile;
    }
}

spl_autoload_register('loadConfig');
spl_autoload_register('loadController');
spl_autoload_register('loadModel');

$loader = new Loader($_GET);
