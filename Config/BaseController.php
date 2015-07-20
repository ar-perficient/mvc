<?php

class BaseController
{
    public function __construct() 
    {
        
    }
    
    protected function loadView($controller, $action, $data = '')
    {
        return App::getView($controller, $action, $data);
    }
    
    protected function loadModel($name)
    {
        return App::getModel($name);
    }
    
    protected function loadPlugin($name)
    {
        echo 'hi there';
    }
    
    protected function loadHelper($name)
    {
        echo 'hi there';
    }
    
    protected function redirect($location)
    {
        echo 'hi there';
    }
    
    protected function setTemplate($templateFile, $data = '')
    {
        
    }
}