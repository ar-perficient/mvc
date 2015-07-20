<?php

class App
{
    
    private static $_modelDir;
    private static $_controllerDir;
    private static $_viewDir;


    public static function run()
    {
        self::$_modelDir = ROOT . DS . 'app' 
                . DS . 'Models'. DS;
        self::$_controllerDir = ROOT . DS . 'app' 
                . DS . 'Controllers'. DS;
        self::$_viewDir = ROOT . DS . 'app' 
                . DS . 'Views'. DS;
    }

    public static function getModel($class)
    {
        $className = ucwords($class). 'Model.php';
        $class = ucwords($class).'Model';
        
        if (file_exists(self::$_modelDir . $className)) {
            return new $class;
        } 
    }
    
    public static function getDirectoryPath($name)
    {
        $name = ucwords($name);
        
        switch ($name)
        {
            case 'Controllers':
                return self::$_controllerDir;
                break;
            case 'Models':
                return self::$_modelDir;
                break;
            case 'Views':
                self::$_viewDir;
                break;
        }
    }
}